<x-app-layout>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f9fafb;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    font-size: 1.5rem;
    color: #2854C5;
    margin: 1rem;
}

a {
    text-decoration: none;
    color: #2854C5;
}

a:hover {
    text-decoration: underline;
}

.container {
    max-width: 1200px;
    margin: auto;
    padding: 1rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #2854C5;
    color: white;
}

th, td {
    padding: 0.75rem;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    text-transform: uppercase;
    font-weight: 600;
    font-size: 0.875rem;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

tbody tr:hover {
    background-color: #e6f7ff;
}

button, .btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

button:hover, .btn:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-pdf {
    background-color: #eb5e28;
}

.btn-pdf:hover {
    background-color: #99582a;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.form-grid-item {
    display: flex;
    flex-direction: column;
}

.form-grid-item label {
    margin-bottom: 5px;
}

.form-control {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }

    table {
        font-size: 0.875rem;
    }

    th, td {
        padding: 0.5rem;
    }

    .actions {
        flex-direction: column;
    }
}

    </style>
    <div class="container">
    <div class="settings">
        <x-button>
            <a href="{{ route('settings.index') }}" class="text-white no-underline hover:no-underline"><i class='fas fa-angle-left'></i> Settings</a>
        </x-button>
        </div>  

        <form action="{{ route('products.stats') }}" method="GET" class="form-grid">
            <div class="form-grid-item">
                <label for="start_date">{{ __('product.start_date') }}:</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="form-grid-item">
                <label for="end_date">{{ __('product.end_date') }}:</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div class="form-grid-item">
                <label for="category_id">{{ __('product.category') }}:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">{{ __('product.all_categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-grid-item">
                <label for="payment_method">{{ __('product.payment_method') }}:</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="">{{ __('product.all_payment_methods') }}</option>
                    <option value="paypal" {{ request('payment_method') == 'paypal' ? 'selected' : '' }}>{{ __('product.paypal') }}</option>
                    <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>{{ __('product.credit_card') }}</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>{{ __('product.cash') }}</option>
                </select>
            </div>
            <div class="form-grid-item">
                <label for="stat_type">{{ __('product.stat_type') }}:</label>
                <select name="stat_type" id="stat_type" class="form-control">
                    <option value="best_selling" {{ request('stat_type') == 'best_selling' ? 'selected' : '' }}>{{ __('product.best_selling') }}</option>
                    <option value="least_selling" {{ request('stat_type') == 'least_selling' ? 'selected' : '' }}>{{ __('product.least_selling') }}</option>
                </select>
            </div>
            <div class="form-grid-item">
                <div class="actions">
                    <button type="submit" class="btn btn-primary">{{ __('product.filter') }}</button>
                    <a href="{{ route('products.stats') }}" class="btn btn-danger">{{ __('product.reset') }}</a>
                    <a href="{{ route('orders.deliverystats') }}" class="btn btn-success">{{ __('product.delivery') }}</a>
                </div>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-2">
                <a href="{{ route('products.generate_pdf', request()->all()) }}" class="btn btn-pdf btn-block">{{ __('product.generate_pdf') }}</a>
            </div>
        </div>

        @if($bestSellingProducts->isEmpty())
            <p>{{ __('product.no_products_found') }}</p>
        @else
            <table class="table table-bordered">
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

            {{ $bestSellingProducts->links() }}
        @endif
    </div>
</x-app-layout>
