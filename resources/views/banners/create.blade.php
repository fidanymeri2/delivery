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

        input[type="file"] {
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
        <h1>{{ __('banners.create_banner') }}</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" id="bannerForm">
            @csrf

            <div>
                <label for="image">{{ __('banners.image') }}</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div>
                <label for="title">{{ __('banners.title') }}</label>
                <input style="width:100%;" type="text" name="title" id="title">
            </div>

            <div>
                <label for="description">{{ __('banners.description') }}</label>
                <textarea style="width:100%;" name="description" id="description" ></textarea>
            </div>

            <button type="submit">{{ __('banners.create_banner') }}</button>
        </form>

        <a href="{{ route('banners.index') }}" class="back-link">{{ __('banners.back_to_list') }}</a>
    </div>

    <!-- Modal for Resolution and File Size Info -->
    <div id="resolutionModal" style="display: none;">
        <div style="background-color: #fff; padding: 1rem; border-radius: 8px; width: 300px; margin: 2rem auto; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <h2>{{ __('banners.invalid_image') }}</h2>
            <p id="modalMessage">{{ __('banners.invalid_image_message') }}</p>
            <button onclick="closeModal()">{{ __('banners.close') }}</button>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const img = new Image();

            // File size check (not more than 1MB)
            const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
            if (file.size > maxSizeInBytes) {
                document.getElementById('modalMessage').textContent = 'The uploaded image must not exceed 1MB.';
                document.getElementById('resolutionModal').style.display = 'block';
                document.getElementById('bannerForm').reset();
                return;
            }

            img.onload = function() {
                const width = img.width;
                const height = img.height;

                // Check for specific resolution
                if (width !== 689 || height !== 255) { // Change to your desired resolution
                    document.getElementById('modalMessage').textContent = 'The uploaded image does not meet the required resolution of 689x255.';
                    document.getElementById('resolutionModal').style.display = 'block';
                    document.getElementById('bannerForm').reset();
                }
            };

            if (file) {
                img.src = URL.createObjectURL(file);
            }
        });

        function closeModal() {
            document.getElementById('resolutionModal').style.display = 'none';
        }
    </script>
</x-app-layout>