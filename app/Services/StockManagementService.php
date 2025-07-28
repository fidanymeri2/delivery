<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\StockAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StockManagementService
{
    /**
     * Add stock to a product
     */
    public function addStock(Product $product, int $quantity, array $data = [])
    {
        return $this->processStockTransaction($product, $quantity, 'purchase', $data);
    }

    /**
     * Remove stock from a product (sale, damage, etc.)
     */
    public function removeStock(Product $product, int $quantity, array $data = [])
    {
        return $this->processStockTransaction($product, -$quantity, 'sale', $data);
    }

    /**
     * Adjust stock manually
     */
    public function adjustStock(Product $product, int $quantity, array $data = [])
    {
        $transactionType = $quantity > 0 ? 'adjustment' : 'adjustment';
        return $this->processStockTransaction($product, $quantity, $transactionType, $data);
    }

    /**
     * Process stock transaction
     */
    private function processStockTransaction(Product $product, int $quantity, string $type, array $data = [])
    {
        if (!$product->requires_stock) {
            Log::info('Stock transaction attempted on product without stock tracking', [
                'product_id' => $product->id,
                'product_name' => $product->name
            ]);
            return false;
        }

        DB::beginTransaction();

        try {
            $quantityBefore = $product->current_stock;
            $quantityAfter = $quantityBefore + $quantity;

            // Prevent negative stock unless it's an adjustment
            if ($quantityAfter < 0 && $type !== 'adjustment') {
                throw new \Exception("Insufficient stock. Available: {$quantityBefore}, Requested: " . abs($quantity));
            }

            // Update product stock
            $product->update([
                'current_stock' => $quantityAfter,
                'last_stock_update' => now()
            ]);

            // Create stock transaction record
            $transaction = StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'order_id' => $data['order_id'] ?? null,
                'table_order_id' => $data['table_order_id'] ?? null,
                'transaction_type' => $type,
                'quantity' => $quantity,
                'quantity_before' => $quantityBefore,
                'quantity_after' => $quantityAfter,
                'unit_cost' => $data['unit_cost'] ?? null,
                'total_cost' => $data['total_cost'] ?? null,
                'reference_number' => $data['reference_number'] ?? null,
                'supplier_name' => $data['supplier_name'] ?? null,
                'notes' => $data['notes'] ?? null,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            // Check for stock alerts
            $this->checkStockAlerts($product, $quantityBefore, $quantityAfter);

            DB::commit();

            Log::info('Stock transaction processed successfully', [
                'product_id' => $product->id,
                'transaction_id' => $transaction->id,
                'type' => $type,
                'quantity' => $quantity,
                'before' => $quantityBefore,
                'after' => $quantityAfter
            ]);

            return $transaction;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Stock transaction failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Check and create stock alerts
     */
    private function checkStockAlerts(Product $product, int $quantityBefore, int $quantityAfter)
    {
        // Check for out of stock alert
        if ($quantityAfter <= 0 && $quantityBefore > 0) {
            $this->createStockAlert($product, 'out_of_stock', 'critical', 
                "Product {$product->name} is now out of stock", 
                "Stock level dropped from {$quantityBefore} to {$quantityAfter}");
        }

        // Check for low stock alert
        if ($product->low_stock_alert && $product->min_stock_level > 0) {
            if ($quantityAfter <= $product->min_stock_level && $quantityBefore > $product->min_stock_level) {
                $priority = $quantityAfter == 0 ? 'critical' : 'high';
                $this->createStockAlert($product, 'low_stock', $priority,
                    "Low stock alert for {$product->name}",
                    "Stock level ({$quantityAfter}) is at or below minimum threshold ({$product->min_stock_level})");
            }
        }

        // Check for overstock alert
        if ($product->max_stock_level && $quantityAfter > $product->max_stock_level && $quantityBefore <= $product->max_stock_level) {
            $this->createStockAlert($product, 'overstock', 'medium',
                "Overstock alert for {$product->name}",
                "Stock level ({$quantityAfter}) exceeds maximum threshold ({$product->max_stock_level})");
        }
    }

    /**
     * Create stock alert
     */
    private function createStockAlert(Product $product, string $type, string $priority, string $title, string $message)
    {
        // Check if there's already an active alert of this type
        $existingAlert = StockAlert::where('product_id', $product->id)
            ->where('alert_type', $type)
            ->where('status', 'active')
            ->first();

        if ($existingAlert) {
            // Update existing alert
            $existingAlert->update([
                'current_stock' => $product->current_stock,
                'message' => $message,
                'priority' => $priority
            ]);
        } else {
            // Create new alert
            StockAlert::create([
                'product_id' => $product->id,
                'alert_type' => $type,
                'title' => $title,
                'message' => $message,
                'current_stock' => $product->current_stock,
                'threshold_stock' => $type === 'low_stock' ? $product->min_stock_level : 
                                   ($type === 'overstock' ? $product->max_stock_level : 0),
                'priority' => $priority,
                'status' => 'active'
            ]);
        }
    }

    /**
     * Get stock summary for dashboard
     */
    public function getStockSummary()
    {
        $products = Product::where('requires_stock', true)->get();

        return [
            'total_products' => $products->count(),
            'out_of_stock' => $products->where('current_stock', 0)->count(),
            'low_stock' => $products->filter(fn($p) => $p->isLowStock())->count(),
            'overstock' => $products->filter(fn($p) => $p->isOverstock())->count(),
            'normal_stock' => $products->filter(fn($p) => $p->getStockStatus() === 'normal')->count(),
            'total_stock_value' => $products->sum(function($product) {
                $avgPrice = $product->sizes->avg('price') ?? 0;
                return $product->current_stock * $avgPrice;
            })
        ];
    }

    /**
     * Get low stock products
     */
    public function getLowStockProducts()
    {
        return Product::where('requires_stock', true)
            ->where('low_stock_alert', true)
            ->where('current_stock', '<=', DB::raw('min_stock_level'))
            ->with('category')
            ->get();
    }

    /**
     * Get out of stock products
     */
    public function getOutOfStockProducts()
    {
        return Product::where('requires_stock', true)
            ->where('current_stock', 0)
            ->with('category')
            ->get();
    }

    /**
     * Bulk stock update
     */
    public function bulkStockUpdate(array $updates)
    {
        $results = [];
        
        foreach ($updates as $productId => $data) {
            try {
                $product = Product::findOrFail($productId);
                $result = $this->adjustStock($product, $data['quantity'], $data);
                $results[$productId] = ['success' => true, 'transaction' => $result];
            } catch (\Exception $e) {
                $results[$productId] = ['success' => false, 'error' => $e->getMessage()];
            }
        }

        return $results;
    }
} 