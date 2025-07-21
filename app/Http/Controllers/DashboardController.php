<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ExtraCategory;
use App\Models\ExtraProduct;
use App\Models\Order;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalExtrasCategory = ExtraCategory::count();
        $totalExtrasProduct = ExtraProduct::count();
        $totalOrders = Order::count();

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

        return view('dashboard', compact(
            'totalProducts',
            'totalExtrasCategory',
            'totalExtrasProduct',
            'totalCategories',
            'totalUsers',
            'totalOrders',
            'topSellingProducts',
            'shippingStatusStats',
            'paymentStatusStats'
        ));
    }
}
