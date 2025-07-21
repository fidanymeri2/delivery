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
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
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
        <h1>Create Reservation</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>

            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>

            <label for="date">Reservation Date</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" required>

            <label for="time_reservation">Reservation Time</label>
            <input type="time" name="time_reservation" id="time_reservation" value="{{ old('time_reservation') }}" required>

            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>

            <button type="submit">Create</button>
        </form>

        <a href="{{ route('reservations.index') }}" class="back-link">Back to Reservations</a>
    </div>
</x-app-layout>
