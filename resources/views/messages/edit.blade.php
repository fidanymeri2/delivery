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

Input[type="text"],input[type="time"],
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
        <h1>Edit Message</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('messages.update', $message->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <label for="category">Category</label>
            <input type="text" readonly name="category" id="category" value="{{ old('category', $message->category) }}" required>
@if($message->category == 'OPEN_HOURS')
    <label for="description">From time:</label>
            <input type="time"  name="from" id="category" value="{{ explode('-', $message->description)[0] }}" required>
              <label for="description">To time:</label>
            <input type="time"  name="to" id="category" value="{{ explode('-', $message->description)[1] }}" required>
            
@elseif($message->category == 'CURRENT_MESSAGE')
<?php $category = App\Models\Message::whereIn('category',['HOURS_CLOSE_STORE_MESSAGE','VACTION_CLOSE_STORE_MESSAGE','LARGE_ORDER_MESSAGE'])->get(); ?>
@foreach($category as $cat)
<label for="{{ $cat->category }}"> 
            <input type="radio"  name="description" id="{{ $cat->category }}" @if($message->description == $cat->category) checked @endif value="{{ $cat->category }}" required> {{ $cat->description }}</label>
@endforeach
        
@elseif($message->category == 'LOGO')

<input type="file" name="description"  required/>


@else 
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description', $message->description) }}</textarea>
@endif
            <button type="submit">Update</button>
        </form>

        <a href="{{ route('messages.index') }}" class="back-link">Back to Messages</a>
    </div>
</x-app-layout>
