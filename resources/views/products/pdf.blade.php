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
    <h2>Product Statistics</h2>

    <!-- Filter information -->
    <div class="filter-info">
        <p><strong>Start Date:</strong> {{ $filters['start_date'] ?? 'Not Specified' }}</p>
        <p><strong>End Date:</strong> {{ $filters['end_date'] ?? 'Not Specified' }}</p>
        <p><strong>Category:</strong> {{ $filters['category_id'] ? $categories->firstWhere('id', $filters['category_id'])->name : 'All Categories' }}</p>
        <p><strong>Payment Method:</strong> 
            @if($filters['payment_method'] == 'paypal')
                PayPal
            @elseif($filters['payment_method'] == 'credit_card')
                Credit Card
            @elseif($filters['payment_method'] == 'cash')
                Cash
            @else
                All Payment Methods
            @endif
        </p>
        <p><strong>Stat Type:</strong> 
            {{ $filters['stat_type'] == 'best_selling' ? 'Best Selling' : 'Least Selling' }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Total Sold</th>
                <th>Total Revenue (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bestSellingProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->total_quantity }}</td>
                    <td>{{ number_format($product->total_revenue, 2) }}</td> <!-- Display revenue -->

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
