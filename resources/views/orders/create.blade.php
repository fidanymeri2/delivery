<x-app-layout>
    <style>
        .error {
            color: #dc2626;
            font-size: 0.875rem;
        }

        button:disabled {
            background-color: #d1d5db;
            cursor: not-allowed;
        }

        .container {
            max-width: 4xl;
            margin: auto;
            padding: 1.5rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        h1 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #1f2937;
            text-align: center;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            box-sizing: border-box;
            margin-bottom: 1rem;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 0.375rem;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #4338ca;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .breadcrumb a {
            color: #2854C5;
            text-decoration: none;
            margin-right: 0.5rem;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            margin-right: 0.5rem;
            color: #6b7280;
        }
    </style>

    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('orders.index') }}">Orders</a>
            <span class="separator">/</span>
            <span>Create Order</span>
        </div>
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                @error('fullname')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                @error('postal_code')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="status_of_payment">Payment Method:</label>
                <select name="status_of_payment" id="status_of_payment" class="form-control" required>
                    <option value="bank" {{ old('status_of_payment') == 'bank' ? 'selected' : '' }}>Bank</option>
                    <option value="cash" {{ old('status_of_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="pickup" {{ old('status_of_payment') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                </select>
                @error('status_of_payment')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
                @error('status')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create Order</button>
        </form>
    </div>
</x-app-layout>
