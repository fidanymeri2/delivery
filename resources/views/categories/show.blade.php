<x-app-layout>
    <style>
        /* Breadcrumb Styles */
        .breadcrumb {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.875rem; /* Equivalent to text-sm */
            color: #6b7280; /* Equivalent to text-gray-500 */
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

        /* Container Styles */
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            box-sizing: border-box;
        }

        h1 {
            font-size: 2rem; /* Equivalent to text-2xl */
            font-weight: 700; /* Equivalent to font-bold */
            margin-bottom: 1.5rem; /* Margin equivalent to mb-6 */
            color: #2854C5;
            text-align: center;
        }

        p {
            font-size: 1rem; /* Equivalent to text-base */
            margin-bottom: 0.5rem;
        }

        p strong {
            color: #4b5563; /* Equivalent to text-gray-700 */
        }

        a {
            color: #2854C5; /* Link color */
            text-decoration: none;
            margin-right: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="max-w-4xl mx-auto p-6">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="{{ route('categories.index') }}">{{ __('category.categories') }}</a>
            <span class="separator">/</span>
            <span>{{ __('category.category_details') }}</span>
        </div>

        <!-- Category Details -->
        <div class="container">
            <h1>{{ __('category.category_details') }}</h1>
            <p><strong>{{ __('category.category_name') }}:</strong> {{ $category->name }}</p>
            <p><strong>{{ __('category.category_description') }}:</strong> {{ $category->description }}</p>
            <a href="{{ route('categories.index') }}">{{ __('category.back_to_categories') }}</a>
            <a href="{{ route('categories.edit', $category->id) }}">{{ __('category.edit') }}</a>

        </div>
    </div>
</x-app-layout>
