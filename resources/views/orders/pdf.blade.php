<!-- resources/views/orders/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2854C5;
            color: white;
        }
        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>{{ __('delivery_stats.title') }}</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('delivery_stats.order_id') }}</th>
                <th>{{ __('delivery_stats.delivery_user') }}</th>
                <th>{{ __('delivery_stats.status') }}</th>
                <th>{{ __('delivery_stats.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredOrders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ optional($order->deliveryUser)->name ?? __('delivery_stats.not_assigned') }}</td>
                    <td>{{ $order->shipping_status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
