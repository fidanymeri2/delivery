<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TableOrder;
use App\Models\TableOrderItem;
use App\Models\RestaurantTable;
use App\Models\Waiter;
use App\Services\StockManagementService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Authenticate waiter with PIN code
     */
    public function authenticateWaiter(Request $request): JsonResponse
    {
        // Debug logging
        \Log::info('Authentication attempt', [
            'pin_code' => $request->input('pin_code'),
            'all_data' => $request->all()
        ]);

        $request->validate([
            'pin_code' => 'required|string|size:4'
        ]);

        $pinCode = $request->input('pin_code');
        
        // Debug: Check if waiter exists
        $waiter = Waiter::where('pin_code', $pinCode)->first();
        
        \Log::info('Waiter lookup result', [
            'pin_code' => $pinCode,
            'waiter_found' => $waiter ? true : false,
            'waiter_data' => $waiter ? $waiter->toArray() : null
        ]);
        
        if (!$waiter) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid PIN code'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'waiter' => [
                'id' => $waiter->id,
                'name' => $waiter->name,
                'pin_code' => $waiter->pin_code
            ]
        ]);
    }

    /**
     * Process order
     */
    public function processOrder(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id',
            'waiter_id' => 'required|integer|exists:waiters,id',
            'payment_method' => 'required|string|in:cash,bank_transfer',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Validate stock availability before processing
            $stockErrors = [];
            foreach ($request->input('items') as $item) {
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
                'restaurant_table_id' => $request->input('table_id'),
                'waiter_id' => $request->input('waiter_id'),
                'payment_method' => $request->input('payment_method'),
                'total_amount' => $request->input('total_amount'),
                'status' => 'closed',
                'payment_status' => 'paid',
                'paid_amount' => $request->input('total_amount'),
                'notes' => $request->input('notes'),
                'closed_at' => now()
            ]);

            // Create table order items and deduct stock
            foreach ($request->input('items') as $item) {
                $product = Product::find($item['product_id']);
                
                TableOrderItem::create([
                    'table_order_id' => $tableOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                    'status' => 'completed'
                ]);

                // Deduct stock if product requires stock tracking
                if ($product && $product->requires_stock) {
                    $this->stockService->removeStock($product, $item['quantity'], [
                        'table_order_id' => $tableOrder->id,
                        'notes' => "POS Order #{$tableOrder->id} - {$product->name}"
                    ]);
                }
            }

            // Update table status to available
            $table = RestaurantTable::find($request->input('table_id'));
            if ($table) {
                $table->update(['status' => 'available']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $tableOrder->id,
                'total_amount' => $tableOrder->total_amount,
                'payment_method' => $tableOrder->payment_method,
                'message' => 'Order processed successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all waiters (for admin purposes)
     */
    public function getWaiters(): JsonResponse
    {
        $waiters = Waiter::select('id', 'name', 'pin_code')->get();
        
        return response()->json([
            'success' => true,
            'waiters' => $waiters
        ]);
    }

    /**
     * Start a new table session
     */
    public function startTableSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id',
            'waiter_id' => 'required|integer|exists:waiters,id'
        ]);

        $tableId = $request->input('table_id');
        $waiterId = $request->input('waiter_id');

        // Check if table is available
        $table = \App\Models\RestaurantTable::find($tableId);
        if (!$table || $table->status !== 'available') {
            return response()->json([
                'success' => false,
                'message' => 'Table is not available'
            ], 400);
        }

        // Create session key for this table
        $sessionKey = "table_order_{$tableId}";
        
        // Initialize session data
        $sessionData = [
            'table_id' => $tableId,
            'waiter_id' => $waiterId,
            'items' => [],
            'total_amount' => 0,
            'created_at' => now()->toISOString(),
            'table_number' => $table->table_number,
            'waiter_name' => \App\Models\Waiter::find($waiterId)->name
        ];

        // Store in session
        session([$sessionKey => $sessionData]);

        // Update table status to occupied
        $table->update(['status' => 'occupied']);

        return response()->json([
            'success' => true,
            'session_key' => $sessionKey,
            'session_data' => $sessionData,
            'message' => 'Table session started successfully'
        ]);
    }

    /**
     * Add item to table session
     */
    public function addItemToSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $tableId = $request->input('table_id');
        $sessionKey = "table_order_{$tableId}";
        
        // Get current session data
        $sessionData = session($sessionKey);
        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'No active session for this table'
            ], 400);
        }

        // Create new item
        $newItem = [
            'id' => uniqid(), // Temporary ID for session
            'product_id' => $request->input('product_id'),
            'product_name' => \App\Models\Product::find($request->input('product_id'))->name,
            'quantity' => $request->input('quantity'),
            'unit_price' => $request->input('unit_price'),
            'total_price' => $request->input('quantity') * $request->input('unit_price'),
            'notes' => $request->input('notes'),
            'added_at' => now()->toISOString()
        ];

        // Add to session items
        $sessionData['items'][] = $newItem;
        $sessionData['total_amount'] = collect($sessionData['items'])->sum('total_price');

        // Update session
        session([$sessionKey => $sessionData]);

        return response()->json([
            'success' => true,
            'session_data' => $sessionData,
            'message' => 'Item added to session successfully'
        ]);
    }

    /**
     * Get current table session
     */
    public function getTableSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id'
        ]);

        $tableId = $request->input('table_id');
        $sessionKey = "table_order_{$tableId}";
        
        $sessionData = session($sessionKey);
        
        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'No active session for this table'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'session_data' => $sessionData
        ]);
    }

    /**
     * Remove item from session
     */
    public function removeItemFromSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id',
            'item_id' => 'required|string'
        ]);

        $tableId = $request->input('table_id');
        $itemId = $request->input('item_id');
        $sessionKey = "table_order_{$tableId}";
        
        $sessionData = session($sessionKey);
        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'No active session for this table'
            ], 400);
        }

        // Remove item by temporary ID
        $sessionData['items'] = collect($sessionData['items'])
            ->filter(function($item) use ($itemId) {
                return $item['id'] !== $itemId;
            })
            ->values()
            ->toArray();

        $sessionData['total_amount'] = collect($sessionData['items'])->sum('total_price');

        // Update session
        session([$sessionKey => $sessionData]);

        return response()->json([
            'success' => true,
            'session_data' => $sessionData,
            'message' => 'Item removed from session successfully'
        ]);
    }

    /**
     * Finalize table session and create order
     */
    public function finalizeTableSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id',
            'payment_method' => 'required|string|in:cash,bank_transfer',
            'notes' => 'nullable|string'
        ]);

        $tableId = $request->input('table_id');
        $sessionKey = "table_order_{$tableId}";
        
        $sessionData = session($sessionKey);
        if (!$sessionData || empty($sessionData['items'])) {
            return response()->json([
                'success' => false,
                'message' => 'No active session or no items to process'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Validate stock availability before processing
            $stockErrors = [];
            foreach ($sessionData['items'] as $item) {
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
                'restaurant_table_id' => $tableId,
                'waiter_id' => $sessionData['waiter_id'],
                'payment_method' => $request->input('payment_method'),
                'total_amount' => $sessionData['total_amount'],
                'status' => 'closed',
                'payment_status' => 'paid',
                'paid_amount' => $sessionData['total_amount'],
                'notes' => $request->input('notes'),
                'closed_at' => now()
            ]);

            // Create table order items and deduct stock
            foreach ($sessionData['items'] as $item) {
                $product = Product::find($item['product_id']);
                
                TableOrderItem::create([
                    'table_order_id' => $tableOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total_price'],
                    'status' => 'completed'
                ]);

                // Deduct stock if product requires stock tracking
                if ($product && $product->requires_stock) {
                    $this->stockService->removeStock($product, $item['quantity'], [
                        'table_order_id' => $tableOrder->id,
                        'notes' => "POS Session Order #{$tableOrder->id} - {$product->name}"
                    ]);
                }
            }

            // Update table status to available
            $table = RestaurantTable::find($tableId);
            if ($table) {
                $table->update(['status' => 'available']);
            }

            // Clear session
            session()->forget($sessionKey);

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $tableOrder->id,
                'total_amount' => $tableOrder->total_amount,
                'payment_method' => $tableOrder->payment_method,
                'message' => 'Table session finalized successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to finalize session: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel table session
     */
    public function cancelTableSession(Request $request): JsonResponse
    {
        $request->validate([
            'table_id' => 'required|integer|exists:restaurant_tables,id'
        ]);

        $tableId = $request->input('table_id');
        $sessionKey = "table_order_{$tableId}";
        
        $sessionData = session($sessionKey);
        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'No active session for this table'
            ], 400);
        }

        // Update table status to available
        $table = \App\Models\RestaurantTable::find($tableId);
        if ($table) {
            $table->update(['status' => 'available']);
        }

        // Clear session
        session()->forget($sessionKey);

        return response()->json([
            'success' => true,
            'message' => 'Table session cancelled successfully'
        ]);
    }
} 