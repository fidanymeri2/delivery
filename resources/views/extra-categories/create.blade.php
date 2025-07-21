<x-app-layout>
    <style>
        .error {
            color: #dc2626; /* Tailwind's red-600 color */
            font-size: 0.875rem; /* Tailwind's text-sm */
        }

        button:disabled {
            background-color: #d1d5db; /* Tailwind's gray-300 */
            cursor: not-allowed;
        }

        .container {
            max-width: 4xl; /* Equivalent to Tailwind's max-w-4xl */
            margin: auto;
            padding: 1.5rem; /* Equivalent to Tailwind's p-6 */
            background-color: #ffffff; /* bg-white */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            border-radius: 0.5rem; /* rounded-lg */
        }

        h1 {
            font-size: 1.875rem; /* text-2xl */
            font-weight: 700; /* font-bold */
            margin-bottom: 1.5rem; /* mb-6 */
            color: #1f2937; /* text-gray-900 */
            text-align: center;
        }

        label {
            display: block;
            font-size: 0.875rem; /* text-sm */
            font-weight: 600; /* font-medium */
            color: #4b5563; /* text-gray-700 */
            margin-bottom: 0.5rem; /* mb-2 */
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 0.75rem; /* px-3 py-2 */
            border: 1px solid #d1d5db; /* border-gray-300 */
            border-radius: 0.375rem; /* rounded-md */
            font-size: 0.875rem; /* text-sm */
            box-sizing: border-box;
            margin-bottom: 1rem; /* mb-4 */
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            background-color: #4f46e5; /* bg-indigo-600 */
            color: white;
            border: none;
            padding: 0.75rem 1.5rem; /* py-2 px-4 */
            font-size: 1rem; /* text-base */
            cursor: pointer;
            border-radius: 0.375rem; /* rounded-md */
            transition: background-color 0.3s;
            width: 100%; /* Full width button */
        }

        button:hover {
            background-color: #4338ca; /* bg-indigo-700 */
        }

        button:disabled {
            background-color: #d1d5db; /* bg-gray-300 */
            cursor: not-allowed;
        }

        .error-message {
            color: #dc2626; /* text-red-600 */
            font-size: 0.875rem; /* text-sm */
            margin-top: 0.25rem; /* mt-1 */
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.875rem; /* text-sm */
            color: #6b7280; /* text-gray-500 */
            margin-bottom: 1rem;
        }

        .breadcrumb a {
            color: #2854C5; /* Link color */
            text-decoration: none;
            margin-right: 0.5rem;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            margin-right: 0.5rem;
            color: #6b7280; /* Separator color */
        }
    </style>

    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('extra-categories.index') }}">Extra Category</a>
            <span class="separator">/</span>
            <span>Create Extra Category</span>
        </div>

        <h1>Create Extra Category</h1>

        <form action="{{ route('extra-categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Description <span class="text-gray-500 font-light">(optional)</span>:
                </label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <button type="submit">Create</button>
        </form>
    </div>
</x-app-layout>
