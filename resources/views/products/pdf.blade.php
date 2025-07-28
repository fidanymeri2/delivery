<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Statistics PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .filter-info {
            margin-bottom: 20px;
        }
        .filter-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>{{ __('product.product_statistics') }}</h2>

    <!-- Filter information -->
    <div class="filter-info">
        <p><strong>{{ __('product.start_date') }}:</strong> {{ $filters['start_date'] ?? __('product.not_specified') }}</p>
        <p><strong>{{ __('product.end_date') }}:</strong> {{ $filters['end_date'] ?? __('product.not_specified') }}</p>
        <p><strong>{{ __('product.category') }}:</strong> {{ $filters['category_id'] ? $categories->firstWhere('id', $filters['category_id'])->name : __('product.all_categories') }}</p>
        <p><strong>{{ __('product.payment_method') }}:</strong> 
            @if($filters['payment_method'] == 'paypal')
                {{ __('product.paypal') }}
            @elseif($filters['payment_method'] == 'credit_card')
                {{ __('product.credit_card') }}
            @elseif($filters['payment_method'] == 'cash')
                {{ __('product.cash') }}
            @else
                {{ __('product.all_payment_methods') }}
            @endif
        </p>
        <p><strong>{{ __('product.stat_type') }}:</strong> 
            {{ $filters['stat_type'] == 'best_selling' ? __('product.best_selling') : __('product.least_selling') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ __('product.product_name') }}</th>
                <th>{{ __('product.category') }}</th>
                <th>{{ __('product.total_sold') }}</th>
                <th>{{ __('product.total_revenue') }} (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bestSellingProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->total_quantity }}</td>
                    <td>{{ number_format($product->total_revenue, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
