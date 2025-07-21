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
            max-width: 600px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #2854C5;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1d3b8b;
        }

        .error-message {
            color: #ff4d4d;
            margin-bottom: 1rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #2854C5;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <h1>Create Shipping Fee</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shipping-fees.store') }}" method="POST">
            @csrf
            <label for="postal_code">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>

            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>

            

            <label for="fee">Fee</label>
            <input type="number" name="fee" id="fee" value="{{ old('fee') }}" required step="0.01" min="0">

            <label for="minimal_fee">Minimal Fee</label>
            <input type="text" name="minimal_fee" id="minimal_fee" value="{{ old('minimal_fee') }}" required>

            <button type="submit">Create</button>
        </form>

        <a href="{{ route('shipping-fees.index') }}" class="back-link">Back to Shipping Fees</a>
    </div>
</x-app-layout>
