<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use App\Models\TableCategory;
use App\Models\Product;
use App\Models\Category;
use App\Models\TableOrder;
use App\Models\TableOrderItem;
use App\Models\Waiter;
use App\Services\StockManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        // Get all categories and their tables
        $categories = TableCategory::with(['tables' => function($query) {
            $query->orderBy('sort_order');
        }])->where('status', 'active')->get();

        // Load positions separately for better control
        foreach ($categories as $category) {
            foreach ($category->tables as $table) {
                $table->positions = \App\Models\TablePosition::where('restaurant_table_id', $table->id)
                    ->where('table_category_id', $category->id)
                    ->where('is_active', true)
                    ->get();
            }
        }

        // Get products for the POS system
        $products = Product::with(['category', 'sizes'])
            ->orderBy('name')
            ->get();

        // Get product categories
        $productCategories = Category::orderBy('name')
            ->get();

        return view('demo.index', compact('categories', 'products', 'productCategories'));
    }

    public function getTableOrders($tableId)
    {
        $table = RestaurantTable::with(['orders' => function($query) {
            $query->where('status', 'open')->with('items.product');
        }])->findOrFail($tableId);

        return response()->json([
            'success' => true,
            'table' => $table,
            'orders' => $table->orders
        ]);
    }

    public function addItemToTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        // This is a demo, so we'll just return a success response
        // In a real implementation, you would create/update table orders
        
        return response()->json([
            'success' => true,
            'message' => 'Item added to table successfully',
            'data' => [
                'table_id' => $request->table_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'timestamp' => now()->toISOString()
            ]
        ]);
    }

    public function getTableAmountsBatch(Request $request)
    {
        $request->validate([
            'table_ids' => 'required|array',
            'table_ids.*' => 'integer|exists:restaurant_tables,id'
        ]);

        $tableAmounts = [];
        
        foreach ($request->table_ids as $tableId) {
            // Get the latest open order for this table
            $order = TableOrder::where('restaurant_table_id', $tableId)
                ->where('status', 'open')
                ->latest()
                ->first();
            
            $tableAmounts[$tableId] = $order ? $order->total_amount : 0;
        }

        return response()->json([
            'success' => true,
            'table_amounts' => $tableAmounts
        ]);
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'waiter_id' => 'required|exists:waiters,id',
            'payment_method' => 'required|in:cash,bank_transfer',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Validate stock availability before processing
            $stockErrors = [];
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                if ($product && $product->requires_stock) {
                    if (!$product->canSell($item['quantity'])) {
                        $stockErrors[] = "Insufficient stock for {$product->name}. Available: {$product->current_stock} {$product->stock_unit}";
                    }
                }
            }

            if (!empty($stockErrors)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock validation failed',
                    'errors' => $stockErrors
                ], 400);
            }

            // Create the table order
            $tableOrder = TableOrder::create([
                'restaurant_table_id' => $request->table_id,
                'waiter_id' => $request->waiter_id,
                'status' => 'closed',
                'payment_status' => 'paid',
                'payment_method' => $request->payment_method,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->total_amount,
                'notes' => $request->notes,
                'closed_at' => now(),
            ]);

            // Create order items and deduct stock
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                
                TableOrderItem::create([
                    'table_order_id' => $tableOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                    'status' => 'served',
                ]);

                // Deduct stock if product requires stock tracking
                if ($product && $product->requires_stock) {
                    $this->stockService->removeStock($product, $item['quantity'], [
                        'table_order_id' => $tableOrder->id,
                        'notes' => "Demo POS Order #{$tableOrder->id} - {$product->name}"
                    ]);
                }
            }

            // Update table status to available
            $table = RestaurantTable::find($request->table_id);
            $table->update(['status' => 'available']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order processed successfully',
                'order_id' => $tableOrder->id,
                'total_amount' => $tableOrder->total_amount,
                'payment_method' => $tableOrder->payment_method,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order: ' . $e->getMessage()
            ], 500);
        }
    }
}
