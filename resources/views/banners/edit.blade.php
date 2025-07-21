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

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #2854C5;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .current-image {
            margin-bottom: 1rem;
        }

        .current-image img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>

    <div class="container">
        <h1>{{ __('banners.edit_banner') }}</h1>

        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Display current banner image -->
            <div class="current-image">
                <label>{{ __('banners.current_image') }}</label>
                <img src="{{ asset('storage/banners/' . $banner->image_url) }}" alt="Current Banner Image">
            </div>

            <div class="mb-6">
                <label for="image">{{ __('banners.change_image') }}</label>
                <input type="file" name="image" id="image">
            </div>

           <div>
                <label for="title">{{ __('banners.title') }}</label>
                <input style="width:100%;" type="text" value="{{ $banner->title }}" name="title" id="title">
            </div>

            <div>
                <label for="description">{{ __('banners.description') }}</label>
                <textarea style="width:100%;" name="description" id="description" >{{ $banner->description }}</textarea>
            </div>
            <button type="submit">{{ __('banners.update_banner') }}</button>
        </form>

        <a href="{{ route('banners.index') }}" class="back-link">{{ __('banners.back_to_list') }}</a>
    </div>
</x-app-layout>
