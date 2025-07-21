<x-app-layout>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .product-container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .product-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .product-header img {
            max-width: 100%;
            width: 200px;
            margin-right: 2rem;
            border-radius: 8px;
        }

        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 1.75rem;
            color: #2854C5;
            margin: 0 0 1rem 0;
        }

        .product-details p {
            margin: 0.5rem 0;
            font-size: 1rem;
        }

        .product-sizes, .extra-products {
            margin: 2rem 0;
        }

        .product-sizes table, .extra-products ul {
            width: 100%;
            border-collapse: collapse;
        }

        .product-sizes th, .product-sizes td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-sizes th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
            background-color: #2854C5;
            color: white;
        }

        .product-sizes tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .extra-products ul {
            list-style-type: none;
            padding: 0;
        }

        .extra-products li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        .extra-products li:last-child {
            border-bottom: none;
        }

        .extra-products .category {
            font-style: italic;
            color: #555;
        }

        .back-button {
            display: inline-block;
            margin-top: 1rem;
            background-color: #2854C5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #003a8c;
        }

        @media (max-width: 768px) {
            .product-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-header img {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .product-details h1 {
                font-size: 1.5rem;
            }

            .product-details p {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="product-container">
        <div class="product-header">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            @endif
            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>New Product:</strong> {{ $product->new_product ? 'Yes' : 'No' }}</p>
                <p><strong>New Offers:</strong> {{ $product->new_offers ? 'Yes' : 'No' }}</p>
                <p><strong>Suggested:</strong>  {{ $product->suggested ? 'Yes' : 'No' }} </p>
            </div>
        </div>

    
        <a href="{{ route('products.index') }}" class="back-button">Back to Products</a>
    </div>
</x-app-layout>
