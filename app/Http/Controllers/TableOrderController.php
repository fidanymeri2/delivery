<?php

namespace App\Http\Controllers;

use App\Models\TableOrder;
use App\Models\TableOrderItem;
use App\Models\RestaurantTable;
use App\Models\Waiter;
use App\Models\Product;
use Illuminate\Http\Request;

class TableOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = TableOrder::with(['table', 'waiter', 'items.product'])->orderBy('created_at', 'desc')->paginate(15);
        return view('table-orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = RestaurantTable::where('status', 'available')->with('category')->get();
        $waiters = Waiter::all();
        return view('table-orders.create', compact('tables', 'waiters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'waiter_id' => 'required|exists:waiters,id',
            'notes' => 'nullable|string',
        ]);

        $order = TableOrder::create($request->all());

        // Update table status to occupied
        $order->table->update(['status' => 'occupied']);

        return redirect()->route('table-orders.show', $order)
            ->with('success', 'Table order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TableOrder $tableOrder)
    {
        $tableOrder->load(['table.category', 'waiter', 'items.product']);
        $products = Product::with('category')->get();
        return view('table-orders.show', compact('tableOrder', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TableOrder $tableOrder)
    {
        $tables = RestaurantTable::with('category')->get();
        $waiters = Waiter::all();
        return view('table-orders.edit', compact('tableOrder', 'tables', 'waiters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TableOrder $tableOrder)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'waiter_id' => 'required|exists:waiters,id',
            'status' => 'required|in:open,closed,cancelled',
            'payment_status' => 'required|in:pending,paid,partial',
            'payment_method' => 'nullable|in:cash,card,bank_transfer',
            'notes' => 'nullable|string',
        ]);

        $tableOrder->update($request->all());

        return redirect()->route('table-orders.index')
            ->with('success', 'Table order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TableOrder $tableOrder)
    {
        $tableOrder->delete();

        return redirect()->route('table-orders.index')
            ->with('success', 'Table order deleted successfully.');
    }

    // Additional methods for adding/updating/removing items
    public function addItem(Request $request, TableOrder $tableOrder)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'special_instructions' => 'nullable|string',
        ]);

        $totalPrice = $request->quantity * $request->unit_price;

        $item = $tableOrder->items()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,
            'special_instructions' => $request->special_instructions,
        ]);

        // Update order total
        $tableOrder->update(['total_amount' => $tableOrder->calculateTotal()]);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function updateItem(Request $request, TableOrder $tableOrder, TableOrderItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'special_instructions' => 'nullable|string',
        ]);

        $totalPrice = $request->quantity * $request->unit_price;

        $item->update([
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,
            'special_instructions' => $request->special_instructions,
        ]);

        // Update order total
        $tableOrder->update(['total_amount' => $tableOrder->calculateTotal()]);

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function removeItem(TableOrder $tableOrder, TableOrderItem $item)
    {
        $item->delete();

        // Update order total
        $tableOrder->update(['total_amount' => $tableOrder->calculateTotal()]);

        return redirect()->back()->with('success', 'Item removed successfully.');
    }

    public function closeOrder(TableOrder $tableOrder)
    {
        $tableOrder->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        // Update table status to available
        $tableOrder->table->update(['status' => 'available']);

        return redirect()->route('table-orders.index')
            ->with('success', 'Table order closed successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $orders = TableOrder::with(['table.category', 'waiter', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function apiShow(TableOrder $order)
    {
        return response()->json([
            'success' => true,
            'data' => $order->load(['table.category', 'waiter', 'items.product'])
        ]);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'waiter_id' => 'required|exists:waiters,id',
            'notes' => 'nullable|string',
        ]);

        $order = TableOrder::create($request->all());

        // Update table status to occupied
        $order->table->update(['status' => 'occupied']);

        return response()->json([
            'success' => true,
            'message' => 'Table order created successfully',
            'data' => $order->load(['table.category', 'waiter'])
        ], 201);
    }

    public function apiUpdate(Request $request, TableOrder $order)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'waiter_id' => 'required|exists:waiters,id',
            'status' => 'required|in:open,closed,cancelled',
            'payment_status' => 'required|in:pending,paid,partial',
            'payment_method' => 'nullable|in:cash,card,bank_transfer',
            'notes' => 'nullable|string',
        ]);

        $order->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Table order updated successfully',
            'data' => $order->load(['table.category', 'waiter'])
        ]);
    }

    public function apiDestroy(TableOrder $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Table order deleted successfully'
        ]);
    }

    public function apiCloseOrder(TableOrder $order)
    {
        $order->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        // Update table status to available
        $order->table->update(['status' => 'available']);

        return response()->json([
            'success' => true,
            'message' => 'Table order closed successfully',
            'data' => $order->load(['table.category', 'waiter'])
        ]);
    }

    public function apiCancelOrder(TableOrder $order)
    {
        $order->update([
            'status' => 'cancelled',
            'closed_at' => now(),
        ]);

        // Update table status to available
        $order->table->update(['status' => 'available']);

        return response()->json([
            'success' => true,
            'message' => 'Table order cancelled successfully',
            'data' => $order->load(['table.category', 'waiter'])
        ]);
    }

    public function apiAddItem(Request $request, TableOrder $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'special_instructions' => 'nullable|string',
        ]);

        $totalPrice = $request->quantity * $request->unit_price;

        $item = $order->items()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,
            'special_instructions' => $request->special_instructions,
        ]);

        // Update order total
        $order->update(['total_amount' => $order->calculateTotal()]);

        return response()->json([
            'success' => true,
            'message' => 'Item added successfully',
            'data' => $item->load('product')
        ], 201);
    }

    public function apiUpdateItem(Request $request, TableOrder $order, TableOrderItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'special_instructions' => 'nullable|string',
        ]);

        $totalPrice = $request->quantity * $request->unit_price;

        $item->update([
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,
            'special_instructions' => $request->special_instructions,
        ]);

        // Update order total
        $order->update(['total_amount' => $order->calculateTotal()]);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully',
            'data' => $item->load('product')
        ]);
    }

    public function apiRemoveItem(TableOrder $order, TableOrderItem $item)
    {
        $item->delete();

        // Update order total
        $order->update(['total_amount' => $order->calculateTotal()]);

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function getWaiterOrders($waiterId)
    {
        $orders = TableOrder::where('waiter_id', $waiterId)
            ->with(['table.category', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function getWaiterActiveOrders($waiterId)
    {
        $orders = TableOrder::where('waiter_id', $waiterId)
            ->where('status', 'open')
            ->with(['table.category', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    // Additional utility methods for Angular frontend
    public function getDashboardStats()
    {
        $stats = [
            'total_orders' => TableOrder::count(),
            'active_orders' => TableOrder::where('status', 'open')->count(),
            'closed_orders' => TableOrder::where('status', 'closed')->count(),
            'total_revenue' => TableOrder::where('status', 'closed')->sum('total_amount'),
            'today_orders' => TableOrder::whereDate('created_at', today())->count(),
            'today_revenue' => TableOrder::whereDate('created_at', today())
                ->where('status', 'closed')
                ->sum('total_amount'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    public function getProducts()
    {
        $products = Product::with('category')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function getWaiters()
    {
        $waiters = Waiter::orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $waiters
        ]);
    }
}
