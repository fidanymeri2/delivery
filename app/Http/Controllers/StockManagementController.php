<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\StockAlert;
use App\Services\StockManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockManagementController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display stock management dashboard
     */
    public function index()
    {
        $summary = $this->stockService->getStockSummary();
        $lowStockProducts = $this->stockService->getLowStockProducts();
        $outOfStockProducts = $this->stockService->getOutOfStockProducts();
        $recentTransactions = StockTransaction::with(['product', 'user'])
            ->latest()
            ->take(10)
            ->get();
        $activeAlerts = StockAlert::with(['product'])
            ->where('status', 'active')
            ->latest()
            ->take(10)
            ->get();

        return view('stock-management.index', compact(
            'summary',
            'lowStockProducts',
            'outOfStockProducts',
            'recentTransactions',
            'activeAlerts'
        ));
    }

    /**
     * Display stock transactions
     */
    public function transactions(Request $request)
    {
        $query = StockTransaction::with(['product', 'user', 'order', 'tableOrder']);

        // Apply filters
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->paginate(20);
        $products = Product::where('requires_stock', true)->get();

        return view('stock-management.transactions', compact('transactions', 'products'));
    }

    /**
     * Display stock alerts
     */
    public function alerts(Request $request)
    {
        $query = StockAlert::with(['product', 'user']);

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('alert_type')) {
            $query->where('alert_type', $request->alert_type);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $alerts = $query->latest()->paginate(20);
        $products = Product::where('requires_stock', true)->get();

        // Calculate alert statistics
        $stats = [
            'critical' => StockAlert::where('priority', 'critical')->where('status', '!=', 'resolved')->count(),
            'high' => StockAlert::where('priority', 'high')->where('status', '!=', 'resolved')->count(),
            'medium' => StockAlert::where('priority', 'medium')->where('status', '!=', 'resolved')->count(),
            'resolved' => StockAlert::where('status', 'resolved')->count(),
        ];

        return view('stock-management.alerts', compact('alerts', 'products', 'stats'));
    }

    /**
     * Display product stock details
     */
    public function productStock(Product $product)
    {
        $recentTransactions = $product->stockTransactions()
            ->with(['user', 'order', 'tableOrder'])
            ->latest()
            ->take(10)
            ->get();

        $activeAlerts = $product->stockAlerts()
            ->with('user')
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        // Calculate stock value
        $stockValue = $product->current_stock * ($product->price ?? 0);

        return view('stock-management.product-stock', compact('product', 'recentTransactions', 'activeAlerts', 'stockValue'));
    }

    /**
     * Show stock adjustment form
     */
    public function adjustStock(Product $product)
    {
        return view('stock-management.adjust-stock', compact('product'));
    }

    /**
     * Show product selection for stock adjustment
     */
    public function selectProductForAdjustment(Request $request)
    {
        $tab = $request->get('tab', 'stock-needed');
        
        if ($tab === 'no-stock-needed') {
            $products = Product::where('requires_stock', false)
                ->with('category')
                ->orderBy('name')
                ->get();
        } else {
            $products = Product::where('requires_stock', true)
                ->with('category')
                ->orderBy('name')
                ->get();
        }

        return view('stock-management.select-product', compact('products', 'tab'));
    }

    /**
     * Process stock adjustment
     */
    public function processStockAdjustment(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'transaction_type' => 'required|in:purchase,sale,adjustment,return,damage,transfer,initial,correction',
            'notes' => 'nullable|string|max:500',
            'unit_cost' => 'nullable|numeric|min:0',
            'reference_number' => 'nullable|string|max:100',
            'supplier_name' => 'nullable|string|max:100'
        ]);

        try {
            $data = [
                'notes' => $request->notes,
                'unit_cost' => $request->unit_cost,
                'reference_number' => $request->reference_number,
                'supplier_name' => $request->supplier_name
            ];

            if ($request->transaction_type === 'purchase') {
                $transaction = $this->stockService->addStock($product, $request->quantity, $data);
            } elseif ($request->transaction_type === 'sale') {
                $transaction = $this->stockService->removeStock($product, $request->quantity, $data);
            } else {
                $transaction = $this->stockService->adjustStock($product, $request->quantity, $data);
            }

            return redirect()->route('stock-management.product-stock', $product)
                ->with('success', 'Stock adjusted successfully');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Bulk stock update
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.product_id' => 'required|exists:products,id',
            'updates.*.quantity' => 'required|integer',
            'updates.*.notes' => 'nullable|string'
        ]);

        $updates = [];
        foreach ($request->updates as $update) {
            $updates[$update['product_id']] = [
                'quantity' => $update['quantity'],
                'notes' => $update['notes'] ?? 'Bulk update'
            ];
        }

        $results = $this->stockService->bulkStockUpdate($updates);

        $successCount = count(array_filter($results, fn($r) => $results['success']));
        $errorCount = count($results) - $successCount;

        return back()->with('success', "Bulk update completed: {$successCount} successful, {$errorCount} failed");
    }

    /**
     * Acknowledge stock alert
     */
    public function acknowledgeAlert(StockAlert $alert)
    {
        $alert->acknowledge();
        return back()->with('success', 'Alert acknowledged successfully');
    }

    /**
     * Resolve stock alert
     */
    public function resolveAlert(StockAlert $alert)
    {
        $alert->resolve();
        return back()->with('success', 'Alert resolved successfully');
    }

    /**
     * Get stock summary for API
     */
    public function getStockSummary()
    {
        $summary = $this->stockService->getStockSummary();
        return response()->json($summary);
    }

    /**
     * Get low stock products for API
     */
    public function getLowStockProducts()
    {
        $products = $this->stockService->getLowStockProducts();
        return response()->json($products);
    }

    /**
     * Get out of stock products for API
     */
    public function getOutOfStockProducts()
    {
        $products = $this->stockService->getOutOfStockProducts();
        return response()->json($products);
    }

    /**
     * Disable stock tracking for a product
     */
    public function disableStockTracking(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            // Update product to disable stock tracking
            $product->update([
                'requires_stock' => false,
                'current_stock' => 0,
                'min_stock_level' => 0,
                'max_stock_level' => null,
                'stock_unit' => null,
                'low_stock_alert' => false
            ]);

            // Create a transaction record for this action
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'transaction_type' => 'disable_tracking',
                'quantity' => 0,
                'quantity_before' => $product->getOriginal('current_stock'),
                'quantity_after' => 0,
                'notes' => 'Stock tracking disabled - Product no longer requires inventory management',
                'unit_cost' => 0,
                'total_cost' => 0
            ]);

            DB::commit();

            return redirect()->route('stock-management.select-product', ['tab' => 'no-stock-needed'])
                ->with('success', "Stock tracking has been disabled for '{$product->name}'. This product will no longer appear in stock management.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to disable stock tracking. Please try again.');
        }
    }

    /**
     * Enable stock tracking for a product
     */
    public function enableStockTracking(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            // Update product to enable stock tracking
            $product->update([
                'requires_stock' => true,
                'current_stock' => 0,
                'min_stock_level' => 5,
                'max_stock_level' => 100,
                'stock_unit' => 'copë',
                'low_stock_alert' => true
            ]);

            // Create a transaction record for this action
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'transaction_type' => 'enable_tracking',
                'quantity' => 0,
                'quantity_before' => 0,
                'quantity_after' => 0,
                'notes' => 'Stock tracking enabled - Product now requires inventory management',
                'unit_cost' => 0,
                'total_cost' => 0
            ]);

            DB::commit();

            return redirect()->route('stock-management.select-product', ['tab' => 'stock-needed'])
                ->with('success', "Stock tracking has been enabled for '{$product->name}'. You can now manage its inventory.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to enable stock tracking. Please try again.');
        }
    }

    /**
     * Export stock report
     */
    public function exportStockReport(Request $request)
    {
        $query = Product::where('requires_stock', true)
            ->with(['category', 'sizes']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'out_of_stock':
                    $query->where('current_stock', 0);
                    break;
                case 'low_stock':
                    $query->where('current_stock', '<=', DB::raw('min_stock_level'))
                          ->where('current_stock', '>', 0);
                    break;
                case 'normal':
                    $query->where('current_stock', '>', DB::raw('min_stock_level'));
                    break;
            }
        }

        $products = $query->get();

        // Generate CSV or PDF report
        if ($request->format === 'csv') {
            return $this->exportToCsv($products);
        } else {
            return $this->exportToPdf($products);
        }
    }

    private function exportToCsv($products)
    {
        $filename = 'stock_report_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Product ID', 'Product Name', 'Category', 'Current Stock', 
                'Min Stock Level', 'Max Stock Level', 'Stock Unit', 'Stock Status'
            ]);

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->category->name,
                    $product->current_stock,
                    $product->min_stock_level,
                    $product->max_stock_level,
                    $product->stock_unit,
                    $product->getStockStatusLabel()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportToPdf($products)
    {
        $pdf = \PDF::loadView('stock-management.report-pdf', compact('products'));
        return $pdf->download('stock_report_' . date('Y-m-d_H-i-s') . '.pdf');
    }
} 