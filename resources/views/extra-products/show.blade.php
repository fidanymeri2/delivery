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
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Product Details
            </div>
            <div class="card-body">
                <dl>
                    <dt>Name:</dt>
                    <dd>{{ $extraProduct->name }}</dd>

                    <dt>Description:</dt>
                    <dd>{{ $extraProduct->description }}</dd>

                    <dt>Price:</dt>
                    <dd>${{ number_format($extraProduct->price, 2) }}</dd>

                    <dt>Category:</dt>
                    <dd>{{ $extraProduct->category->name ?? 'Uncategorized' }}</dd>
                </dl>

                <div class="actions">
                    <a href="{{ route('extra-products.index') }}" class="btn btn-info">
                        Back to List
                    </a>
                    <a href="{{ route('extra-products.edit', $extraProduct->id) }}" class="btn btn-primary">
                        Edit Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
