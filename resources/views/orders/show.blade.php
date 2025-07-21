<x-app-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 1rem;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin: 1rem 0;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2854C5;
            border-bottom: 2px solid #2854C5;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-body {
            font-size: 1rem;
            color: #333;
        }

        .card-body dl {
            margin: 0;
            padding: 0;
        }

        .card-body dt {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-body dd {
            margin: 0 0 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
.menu li{
    margin-left:12px;
    margin-top:10px;
}
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Order #{{ $order->order_code }} / @if($order->paypal_id) PayPal Id {{ $order->paypal_id }} @endif
            </div>
            <div class="card-body">
                <dl>
                    <dt>First Name:</dt>
                    <dd>{{ $order->firstName }}</dd>
                    <dt>Last Name:</dt>
                    <dd>{{ $order->lastName }}</dd>
                    <dt>Phone NR:</dt>
                    <dd>{{ $order->phone_number }}</dd>

                    <dt>Location:</dt>
                    <dd>{{ $order->location }}</dd>

                    <dt>Postal Code:</dt>
                    <dd>{{ $order->postal_code }}</dd>
                    
@if($order->lastName != 'local')

                    <dt>Reorder with Phone Number:</dt>
                    <dd>{{ \App\Models\Order::where('phone_number',$order->phone_number)->where('id','!=',$order->id)->count(); }}</dd>
                    <dt>Reorder with E-mail:</dt>
                    <dd>{{ \App\Models\Order::where('email',$order->email)->where('id','!=',$order->id)->count(); }}</dd>
@endif
                    <dt>Waiter</dt>
                    <dd>{{ \App\Models\Waiter::where('id',$order->waiterId)->withTrashed()->first()->name; }}</dd>
                    <dt>Email:</dt>
                    <dd>{{ $order->email }}</dd>
                    <dt>Status:</dt>
                    <dd>{{ $order->status_of_payment }}</dd>
                    
                    <dt>Description:</dt>
                    <dd>** {{ $order->description }}</dd>
                </dl>

                <div class="card-header">
                    Order Items
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $orderTotal = 0;
                        @endphp
                        @foreach($order->items as $item)
                            @php
                                $itemTotal = $item->price_sell * $item->quantity;
                                $optionTotal = 0;
                            @endphp
                            <tr>
                                <td>{{ $item->product->name }} {{ $item->selectedLabel }}</td>
                                <td>{{ number_format($item->price_sell, 2) }} €</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($itemTotal, 2) }} €</td>
                                <tr>
                                    @if($item->special_instruction) <td colspan="4">** {{ $item->special_instruction }}</td>@endif
                                    @foreach($item->options as $option)
                                    @php
                                        $optionTotal  += $option->quantity * $option->price_sell;
                                    @endphp
                                    <tr>
                                        <td style="font-size:11px;">{{ $option->name }}</td>
                                        <td style="font-size:11px;">{{ number_format($option->price_sell, 2) }} €</td>
                                        <td style="font-size:11px;">{{ $option->quantity }}</td>
                                        <td style="font-size:11px;">{{ number_format($option->quantity * $option->price_sell, 2) }} €</td>
                                    </tr>
                                    @endforeach
                                <tr>
<td colspan="4">
@php
$menu = $item->menu ? (object) json_decode($item->menu,true) : null;
$optionals = $item->optionals ? (object) json_decode($item->optionals,true) : null;
@endphp
@if($optionals)
<ul class="menu">

            @foreach($optionals as $option)
@php
$option = (object) $option;
@endphp
@if($option->checked)
<li><span>&#10003;</span>  {{ $option->name }}<li>@endif
            @endforeach
      
    </ul><hr/>
          @endif

<ul class="menu">
@if($menu)
            @foreach($menu->itemsTree as $item)
@php
$item = (object) $item;
@endphp 
@include('orders.menu', ['item' => $item])
            @endforeach
            @endif
    </ul>

@php
$feMax = 0;

$fee = \App\Models\ShippingFee::where('postal_code',$order->postal_code)->first();
if($fee)
{
    $feMax = $fee->fee;
}


@endphp
</td>
                                </tr>
                                    <tr>
                                        <td style="background:lightblue;" colspan=4>
                                            
                                            
                                         </td>
                                    </tr>
                                </tr>
                            </tr>
                            @php 
                                $orderTotal += $itemTotal + $optionTotal;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Order SubTotal:</strong></td>
                            <td><strong>{{ number_format($orderTotal, 2) }} €</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Tip:</strong></td>
                            <td><strong>{{ number_format($order->tip, 2) }} €</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Shipping Feee:</strong></td>
                            <td><strong>{{ number_format($feMax, 2) }} €</strong></td>
                        </tr>
                        
                         <tr>
                            <td colspan="3" style="text-align: right;"><strong>Order Total:</strong></td>
                            <td><strong>{{ number_format($orderTotal + $order->tip + $feMax, 2) }} €</strong></td>
                        </tr>
                        
                    </tbody>
                </table>

           
    <br/><br/>
                <div class="actions">
                <a href="javascript:history.back()" class="btn btn-info">
    Back to Orders
</a>

                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">
                        Edit Order
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
