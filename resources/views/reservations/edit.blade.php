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
        input[type="number"],
        input[type="date"],
        input[type="time"],
        textarea {
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
        <h1>Edit Reservation</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $reservation->name) }}" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $reservation->last_name) }}" required>

            <label for="adress">Address</label>
<input type="text" name="adress" id="adress" value="{{ old('adress', $reservation->adress) }}" required>



            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $reservation->postal_code) }}" required>

            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ old('date', $reservation->date) }}" required>

            <label for="time_reservation">Time Reservation</label>
            <input type="time" name="time_reservation" id="time_reservation" value="{{ old('time_reservation', $reservation->time_reservation) }}" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4">{{ old('description', $reservation->description) }}</textarea>

            <button type="submit">Update Reservation</button>
        </form>

        <a href="{{ route('reservations.index') }}" class="back-link">Back to Reservations</a>
    </div>
</x-app-layout>
