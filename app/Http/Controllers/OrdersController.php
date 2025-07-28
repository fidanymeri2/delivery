<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemOption;
use App\Models\Product;
use App\Models\Waiter;
use App\Models\User;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\StockManagementService;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index(Request $request)
    {
        $status = $request->input('status');
        $status_of_payment = $request->input('status_of_payment');
        $shipping_status = $request->input('shipping_status', 'new'); // Default to 'new' if not provided
    
        $ordersQuery = Order::withoutTrashed() // Exclude soft-deleted records
            ->orderBy('created_at', 'desc');
    
        if ($status) {
            $ordersQuery->where('status', $status);
        }
    
        if ($status_of_payment) {
            $ordersQuery->where('status_of_payment', $status_of_payment);
        }
    
        $ordersQuery->where('shipping_status', $shipping_status);
    
        $orders = $ordersQuery->paginate(10)->withQueryString();
    
        return view('orders.index', compact('orders', 'shipping_status'));
    }
    
    
    
    
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'shippingFee' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'paymentMethod' => 'required|string|in:bank,cash,pickup',
            'paymentTip' => 'nullable|numeric|min:0',
            'paypalId' => 'nullable|string|max:255',
            'cart' => 'required|array|min:1',
            'cart.*.product_id' => 'required|integer|exists:products,id',
            'cart.*.product_info.qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Validate stock availability before processing
            $stockErrors = [];
            foreach ($request->cart as $cart) {
                $cart = (object) $cart;
                $product_info = (object) $cart->product_info;
                $product = Product::find($cart->product_id);
                
                if ($product && $product->requires_stock) {
                    if (!$product->canSell($product_info->qty)) {
                        $stockErrors[] = "Insufficient stock for {$product->name}. Available: {$product->current_stock} {$product->stock_unit}";
                    }
                }
            }

            if (!empty($stockErrors)) {
                return response()->json([
                    'IsSuccess' => false,
                    'message' => 'Stock validation failed',
                    'errors' => $stockErrors
                ], 400);
            }

            $waiterId = $request->waiterId;
            
            if($waiterId != 1)
            {
                $waiter = Waiter::where('pin_code',$waiterId)->first();
                $waiterId = 1;
                if($waiter)
                {
                    $waiterId = $waiter->id; 
                } else {
                    return response()->json(["IsWaiter"=>true]);
                }
            }
            
            $order = Order::create([
                "firstName"    => $request->firstName,
                "lastName"    => $request->lastName,
                "waiterId"    => $waiterId,
                "order_code" => $this->generateShortCode(),
                "tip" => $request->paymentTip ? $request->paymentTip : 0,
                "phone_number" => $request->contactNumber,
                "location" => $request->location,
                "postal_code" => $request->shippingFee,
                "email" => $request->email,
                "description" => $request->description,
                "status_of_payment" => $request->paymentMethod,
                "paypal_id" => $request->paypalId,
                "status" => $request->paymentMethod == 'bank' ? 'paid' : 'unpaid'
            ]);
            
            foreach($request->cart as $cart)
            {
                $cart = (object) $cart;
                $product_info = (object) $cart->product_info;
                $product = Product::find($cart->product_id);
        
                $item = OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $cart->product_id,
                    "selectedLabel" => isset($product_info->selectedLabel) ? $product_info->selectedLabel : null,
                    "special_instruction" => $product_info->special_instructions ?? null,
                    "menu" =>  isset($product_info->menu) ? json_encode($product_info->menu) : null,
                    "optionals" => isset($product_info->optionOptionals)  ? json_encode($product_info->optionOptionals) : null,
                    "price_sell" => $product_info->price,
                    "quantity" => $product_info->qty,
                ]);

                // Deduct stock if product requires stock tracking
                if ($product && $product->requires_stock) {
                    $this->stockService->removeStock($product, $product_info->qty, [
                        'order_id' => $order->id,
                        'notes' => "Delivery Order #{$order->id} - {$product->name}"
                    ]);
                }

                $options = collect($product_info->options)
                    ->map(function ($item) {
                    $filteredSubItems = collect($item['items'])->filter(function ($subItem) {
                return isset($subItem['checked']) && $subItem['checked'] === true;
                    });
                $item['items'] = $filteredSubItems->values();
                return $item;
                })
                ->filter(function ($item) {
                return $item['items']->isNotEmpty();
                });
                foreach($options as $option)
                {

                    foreach($option['items'] as $itemoption)
                    {
                    $itemoption = (object)$itemoption;
                    $option = OrderItemOption::create([
                    "order_item_id" => $item->id,
                    "option_id" => $itemoption->id,
                    "price_sell" => $itemoption->price,
                    "quantity" => $itemoption->qty,
                    ]);
                    }
                }
                
            }
            
            DB::commit();
            return response()->json(["IsSuccess"=>true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'IsSuccess' => false,
                'message' => 'Failed to process order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $order = Order::with(['items'])->find($id);
        
        foreach($order->items as $item)
        {
            $item->options = OrderItemOption::select("order_item_options.*","extra_products.name as name")->join("extra_products","extra_products.id","=","order_item_options.option_id")
                ->where("order_item_id",$item->id)->get();
        }
    
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }
    
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
$statusHistories =  OrderStatusHistory::where('order_id',$id)->orderBy('created_at','desc')->get();
        return view('orders.edit', compact('order','statusHistories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'email' => 'required|email',
            'status_of_payment' => 'required|in:bank,cash,pickup',
            'status' => 'required|in:paid,unpaid',
        ]);
    
        $order = Order::findOrFail($id);
        $order->update($request->all());
    
        return redirect()->back()
        ->with('success', 'Order updated successfully.');
    }
    
    

   // delete method
   public function destroy(Order $order)
   {
       $order->deleted_by = auth()->user()->id;
       $order->save();
   
       $order->delete();
   
       return redirect()->back()->with('success', 'Order deleted successfully.');
   }
   
   
       public function trashedOrders()
       {
       $orders = Order::onlyTrashed()->get();
   
       return view('orders.trash', compact('orders'));
       }
   
       public function restore($id)
       {
       $order = Order::onlyTrashed()->findOrFail($id);
       $order->restore();
   
       return redirect()->back()->with('success', 'Order restored successfully.');
       }
   
       public function forceDelete($id)
       {
       $order = Order::onlyTrashed()->findOrFail($id);
       $order->forceDelete();
   
       return redirect()->back()->with('success', 'Order permanently deleted.');
       }
    

    public function create()
    {
        return view('orders.create');
    }
    public function generateShortCode($length = 6)
    {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }


    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'email' => 'required|email',
            'status_of_payment' => 'required|in:bank,cash,pickup',
            'status' => 'required|in:paid,unpaid',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')
                         ->with('success', 'Order created successfully.');
    }

    
    public function invoice($id)
    {
         $order = Order::with(['items'])->find($id);
        
        foreach($order->items as $item)
        {
            $item->options = OrderItemOption::select("order_item_options.*","extra_products.name as name")->join("extra_products","extra_products.id","=","order_item_options.option_id")
                ->where("order_item_id",$item->id)->get();
        }

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        return view('orders.invoice', compact('order'));
    }

    public function generateDailyOrdersPdf()
    {
        $date = now()->format('Y-m-d');
        $orders = Order::whereDate('created_at', $date)
->with(['items','itemOptions'])
                        ->get();
        foreach($orders as $order)
        {
            $order->waiter = Waiter::withTrashed()->where('id',$order->waiterId)->first();
        }

        if ($orders->isEmpty()) {
                return redirect()->route('orders.index')->with('error', 'No orders found for today');

        }
    
        $pdf = Pdf::loadView('pdf.daily_orders', compact('orders', 'date'));
        return $pdf->stream();
        //return $pdf->download('daily_orders_' . $date . '.pdf');
    }
    
    public function generateDateRangePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $waiterId = $request->input('waiterId');
        
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                        ->with(['items', 'itemOptions']);
$group = "";
if($waiterId != "all")
{
$group = explode("-",$waiterId);

$orders = isset($group[0]) ? $group[0] == 'w' ? $orders->where('waiterId',$group[1]) : $orders->where('taken_by',$group[1]) : $orders;

} 
$orders = $orders->get();
        
        foreach($orders as $order)
        {
if($waiterId != "all")
{
$order->waiter = $group[0] == 'w' ? Waiter::withTrashed()->where('id',$order->waiterId)->first() : User::withTrashed()->where('id',$order->taken_by)->first() ;
}else{
$order->waiter = Waiter::withTrashed()->where('id',$order->waiterId)->first();

}
        }
        // 
        // Check if orders exist
        if ($orders->isEmpty()) {
                return redirect()->route('orders.index')->with('error', 'No orders found for today');
        }
    
        $pdf = Pdf::loadView('pdf.date_range_orders', compact('orders', 'startDate', 'endDate','group'));
        return $pdf->download('orders_' . $startDate . '_to_' . $endDate . '.pdf');
    }


 
    public function updateShippingStatus(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'shipping_status' => 'required|in:new,delivered,complete,canceled',
        ]);
    
        // Find the order
        $order = Order::findOrFail($id);
        $newStatus = $request->shipping_status;
    
        // Update the shipping status
        $order->shipping_status = $newStatus;
        $order->save(); // Save the changes
    
        // Log the status change
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => $newStatus,
            'changed_by' => auth()->user()->id, // Store the user who made the update
        ]);
    
        // Redirect with success message
        return redirect()->route('orders.edit',$order->id)
                         ->with('success', 'Shipping status updated successfully.');
    }

     
public function newOrders(Request $request)
{
    $status = $request->input('status');
    $status_of_payment = $request->input('status_of_payment');
    $user = auth()->user();

    // Query for 'new' orders visible to all users
    $queryForNewOrders = Order::where('shipping_status', 'new')
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($status_of_payment, function ($query, $status_of_payment) {
            return $query->where('status_of_payment', $status_of_payment);
        });

    // Base query for other shipping statuses
    $queryForOtherOrders = Order::where('shipping_status', '!=', 'new');

    // Determine if the user is an admin
    $isAdmin = $user->role === 'admin';

    // For non-admin users, filter by the 'taken_by' field
    if (!$isAdmin && $user->role === 'delivery') {
        $queryForOtherOrders->where('taken_by', $user->id);
    }



    $deliveredOrders = (clone $queryForOtherOrders)->where('shipping_status', 'delivered')
        ->orderBy('created_at', 'desc')
        ->get();

    $completedOrders = (clone $queryForOtherOrders)->where('shipping_status', 'complete')->whereDate('updated_at', Carbon::today())
        ->orderBy('created_at', 'desc')
        ->get();

    $canceledOrders = (clone $queryForOtherOrders)->where('shipping_status', 'canceled')->whereDate('updated_at', Carbon::today())
        ->orderBy('created_at', 'desc')
        ->get();

    // Fetch delivery users
    $deliveryUsers = User::where('role', 'delivery')->get();

    return view('orders.neworders', compact( 'deliveredOrders', 'completedOrders', 'canceledOrders', 'deliveryUsers'));
}



public function claimOrder($id)
{
    $order = Order::find($id);

    // Ensure the order is not already taken
    if (is_null($order->taken_by)) {
        $order->taken_by = auth()->user()->id;
        $order->save();

        return redirect()->back()->with('success', 'You have successfully taken this order for delivery.');
    }

    return redirect()->back()->with('error', 'This order has already been taken by another delivery person.');
}
public function updateDeliveryUser(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId);

    // Check if a delivery user was selected, if not, set it to null
    $order->taken_by = $request->input('delivery_user') ? $request->input('delivery_user') : null;

    $order->save();

    return redirect()->back()->with('success', 'Delivery user updated successfully');
}
public function deliveryStats(Request $request)
{
    $deliveryUser = $request->input('delivery_user');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    // Query for all delivery orders
    $query = Order::query()
        ->whereIn('shipping_status', ['delivered', 'in_transit', 'complete', 'canceled']) // Filter based on delivery statuses
        ->when($deliveryUser, function ($query, $deliveryUser) {
            return $query->where('taken_by', $deliveryUser);
        })
        ->when($startDate, function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        });

    // Fetch paginated results
    $filteredOrders = $query->orderBy('created_at', 'desc')
    ->paginate(10)
    ->withQueryString();

$deliveryUsers = User::where('role', 'delivery')->get();


    // Pass orders and delivery users to the view
    return view('orders.deliverystats', compact('filteredOrders', 'deliveryUsers'));
}
public function generatePDF(Request $request)
{
    $deliveryUser = $request->input('delivery_user');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query for filtered delivery orders
    $query = Order::query()
        ->whereIn('shipping_status', ['delivered', 'in_transit', 'complete', 'canceled']) // Filter based on delivery statuses
        ->when($deliveryUser, function ($query, $deliveryUser) {
            return $query->where('taken_by', $deliveryUser);
        })
        ->when($startDate, function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        });

    // Fetch filtered orders
    $filteredOrders = $query->orderBy('created_at', 'desc')->get();

    // Load view and pass filtered orders
    $pdf = Pdf::loadView('orders.pdf', compact('filteredOrders'));

    return $pdf->download('delivery_stats.pdf');
}


    
    public function newOrdersJSON(Request $request)
{

    $status = $request->input('status');
    $status_of_payment = $request->input('status_of_payment');
    $user = auth()->user();

    // Query for 'new' orders visible to all users
    $queryForNewOrders = Order::where('shipping_status', 'new')
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($status_of_payment, function ($query, $status_of_payment) {
            return $query->where('status_of_payment', $status_of_payment);
        });

    // Base query for other shipping statuses
    $queryForOtherOrders = Order::where('shipping_status', '!=', 'new');

    // Determine if the user is an admin
    $isAdmin = $user->role === 'admin';

    // For non-admin users, filter by the 'taken_by' field
    if (!$isAdmin && $user->role === 'delivery') {
        $queryForOtherOrders->where('taken_by', $user->id);
    }

    // Apply pagination and sorting for each type of order
    $newOrders = $queryForNewOrders->orderBy('created_at', 'desc')->with('takenByUser')
        ->get();
    return $newOrders;
}

public function sendEmail($id)
{
    // Find the order
    $order = Order::findOrFail($id);

    // Send the email if the email address exists
if ($order->email) {
$order->update(['confirm_email' => 1]);
        Mail::to($order->email)->send(new TestMail($order));
        return redirect()->back()->with('success', 'Email sent successfully.');
    }

    // Redirect back with an error message if no email is found
    return redirect()->back()->with('error', 'Email not found.');
}

}
