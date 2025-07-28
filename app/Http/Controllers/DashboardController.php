<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ExtraCategory;
use App\Models\ExtraProduct;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TableCategory;
use App\Models\RestaurantTable;
use App\Models\TableOrder;
use App\Models\Waiter;
use App\Models\StockTransaction;
use App\Models\StockAlert;
use App\Services\StockManagementService;

class DashboardController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalExtrasCategory = ExtraCategory::count();
        $totalExtrasProduct = ExtraProduct::count();
        $totalOrders = Order::count();
        
        // Table management statistics
        $totalTableCategories = TableCategory::count();
        $totalRestaurantTables = RestaurantTable::count();
        $totalTableOrders = TableOrder::count();
        $activeTableOrders = TableOrder::where('status', 'open')->count();
        
        // Waiter statistics
        $totalWaiters = Waiter::count();

        // Fetch the top 5 best-selling products
        $topSellingProducts = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.shipping_status', '!=', 'canceled') // Exclude canceled orders
        ->select('order_items.product_id')
        ->selectRaw('SUM(order_items.quantity) as total_quantity')
        ->groupBy('order_items.product_id')
        ->orderBy('total_quantity', 'desc')
        ->limit(5)
        ->with('product')
        ->get()
        ->map(function ($item) {
            return [
                'product' => $item->product,
                'total_quantity' => $item->total_quantity,
            ];
        });
    

        // Fetch statistics for shipping status
        $shippingStatusStats = Order::select('shipping_status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('shipping_status')
            ->pluck('count', 'shipping_status')
            ->toArray();

        // Fetch statistics for payment status
        $paymentStatusStats = Order::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Stock Management Statistics
        $stockSummary = $this->stockService->getStockSummary();
        $lowStockProducts = $this->stockService->getLowStockProducts()->take(5);
        $outOfStockProducts = $this->stockService->getOutOfStockProducts()->take(5);
        $recentStockTransactions = StockTransaction::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get();
        $activeStockAlerts = StockAlert::with(['product'])
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalExtrasCategory',
            'totalExtrasProduct',
            'totalCategories',
            'totalUsers',
            'totalOrders',
            'totalTableCategories',
            'totalRestaurantTables',
            'totalTableOrders',
            'activeTableOrders',
            'totalWaiters',
            'topSellingProducts',
            'shippingStatusStats',
            'paymentStatusStats',
            'stockSummary',
            'lowStockProducts',
            'outOfStockProducts',
            'recentStockTransactions',
            'activeStockAlerts'
        ));
    }
}
