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
            max-width: 1200px;
            margin: auto;
            padding: 1rem;
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
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }

        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e6f7ff;
        }

        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e60000;
        }

        .actions a {
            margin-right: 0.5rem;
        }

        .actions form {
            display: inline;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 0.75rem;
            margin: 1rem 0;
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

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            text-decoration: none; 
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
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
    <h1>{{ __('delivery_stats.title') }}</h1>

    <!-- Filter form -->
    <form action="{{ route('orders.deliverystats') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="delivery_user">{{ __('delivery_stats.filter_by_delivery_user') }}</label>
                <select name="delivery_user" id="delivery_user" class="form-control">
                    <option value="">{{ __('delivery_stats.select_delivery_user') }}</option>
                    @foreach ($deliveryUsers as $user)
                        <option value="{{ $user->id }}" {{ request('delivery_user') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="start_date">{{ __('delivery_stats.start_date') }}</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>

            <div class="col-md-3">
                <label for="end_date">{{ __('delivery_stats.end_date') }}</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mt-4">{{ __('delivery_stats.filter_button') }}</button>
            </div>
        </div>
    </form>

    <!-- Display filtered orders -->
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('orders.deliverystats.pdf', request()->query()) }}" class="btn btn-info mb-4">
                <span class="icons"><i class="fas fa-file-pdf"></i></span>
                {{ __('delivery_stats.export_pdf') }}
            </a>
            @if ($filteredOrders->count())
                <table class="table table-striped">
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
                                <td>{{ ucfirst($order->shipping_status) }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $filteredOrders->links() }}
            @else
                <p>{{ __('delivery_stats.no_orders_found') }}</p>
            @endif
        </div>
    </div>
</div>

    </x-app-layout>