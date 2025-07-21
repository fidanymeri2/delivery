<!DOCTYPE html>
<html>
<head>
    <title>Daily Orders - {{ $date }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f2f2f2;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #800000; 
        }

        th {
            background-color: #800000; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child {
            border-bottom: 3px solid #800000;
        }

        .timestamp {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #666;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px;
        }
    </style>
</head>
<body>
    <img src="assets/yumiis-logo.png" alt="Company Logo" class="logo">

    <h1>Orders for {{ $date }}</h1>

    <p class="timestamp">Report generated on: {{ now()->timezone('Europe/Berlin')->format('Y-m-d H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Order Code</th>
                <th>Waiter</th>
                <th>Items</th>
                <th>Status</th>
                <th>Tip</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
@php 
$total = 0;
$tipTotal = 0;
@endphp
            @forelse ($orders as $order)
@php
$subtotal = $order->items->sum('price_sell') + $order->itemOptions->sum('price_sell');
$tip = $order->tip;
if($order->shipping_status != 'canceled'){
$total += $subtotal;
$tipTotal += $tip;

}
@endphp
            <tr>
                <td>{{ $order->order_code }}</td>
                <td>{{ $order->waiter->name }}</td>
                <td>
{{ count($order->items) }}
</td>
    <td>
                            @if($order->shipping_status == 'new') New
                            @elseif($order->shipping_status == 'delivered') On the way
                            @elseif($order->shipping_status == 'complete') Delivered
                            @elseif($order->shipping_status == 'canceled') Canceled
                            @else Unknown
                            @endif
                        </td>
                        
                <td>{{ number_format($tip, 2) }} €</td>
                <td>{{ number_format($subtotal, 2) }} €</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No orders found.</td>
            </tr>
            @endforelse
</tbody><tfoot>
    <tr>
<td colspan="4"></td>
<td>{{ number_format($tipTotal, 2) }} €</td>
<td>{{ number_format($total, 2) }} €</td>
    </tr>
</tfoot>
    </table>
</body>
</html>
