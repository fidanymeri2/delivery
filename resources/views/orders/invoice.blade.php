<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermal Print Invoice</title>
    <style>
        body {
margin: 0 20px;
padding: 0;
            font-size: 10px;
            width: 80mm;
            font-family: 'Times New Roman', serif;
        }

        .ticket {
            width: 100%;
            max-width: 80mm;
            margin: 0 auto;
        }

        .centered {
            text-align: center;
            margin-bottom: 5px;
        }
        .ordertotal{
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-top: 5px;
        }

        th, td {
            padding: 2px;
            border: 1px solid black;
            text-align: left;
        }

        th.quantity, td.quantity {
            width: 20%;
        }

        th.description, td.description {
            width: 60%;
        }

        th.price, td.price {
            width: 20%;
        }

        @media print {
body {
padding:0px; 15px;
                width: 80mm;
                height: auto;
            }

            .hidden-print {
                display: none;
            }

            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
ul{
List-style:none;margin:0;padding:0 5px;
}
    </style>
</head>
<body> 
<?php $logo = App\Models\Message::where('category',"LOGO")->first(); ?>
<div class="ticket">
        <p class="centered">
<img src="/public/storage/{{ $logo->description }}" width="120" /><br/>
            #{{ $order->order_code }}
            <br>For: {{ $order->firstName }} {{ $order->lastName }}
            <br>Phone: {{ $order->phone_number }}
            <br>Location: {{ $order->location }}
            <br>Postal Code: {{ $order->postal_code }}
            <br>Payment Method: {{ $order->status_of_payment }}
            <br>Description: {{ $order->description }}
        </p>
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
      
    </ul>
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
$feMax =0;
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

        <p class="centered">Thanks for your purchase!
            <br>YUMIIS.de</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
    document.getElementById('btnPrint').addEventListener('click', function(e) {
        e.preventDefault();
        window.print();
    });
    </script>
</body>
</html>
