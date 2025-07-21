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

        label {
            display: block;
            font-size: 0.875rem; /* Equivalent to text-sm */
            font-weight: 500; /* Equivalent to font-medium */
            color: #4b5563; /* Equivalent to text-gray-700 */
            margin-bottom: 0.5rem;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db; /* Equivalent to border-gray-300 */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            box-sizing: border-box;
            font-size: 1rem; /* Equivalent to text-sm */
            margin-bottom: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #4f46e5; /* Equivalent to focus:border-indigo-500 */
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3); /* Equivalent to focus:ring-indigo-500 */
            outline: none;
        }

        button {
            background-color: #4f46e5; /* Equivalent to bg-indigo-600 */
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem; /* Equivalent to text-sm */
            cursor: pointer;
            border-radius: 0.375rem; /* Equivalent to rounded-lg */
            transition: background-color 0.3s, box-shadow 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #4338ca; /* Equivalent to hover:bg-indigo-700 */
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3); /* Equivalent to focus:ring-indigo-500 */
        }

        .error {
            color: #dc2626; /* Tailwind's red-600 color */
            font-size: 0.875rem; /* Tailwind's text-sm */
        }
    </style>


    <div class="max-w-4xl mx-auto p-6">
        <div class="breadcrumb">
            <a href="{{ route('extra-products.index') }}">Extra Products</a>
            <span class="separator">/</span>
            <span>Edit Extra Product</span>
        </div>

        <div class="container">
            <h1>Edit Extra Product</h1>
            <form action="{{ route('extra-products.update', $extraProduct->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $extraProduct->name) }}" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required>{{ old('description', $extraProduct->description) }}</textarea>
                </div>
                
                @foreach($descriptions as $desc)
<?php $price = App\Models\ExtraProductPrice::where("extra_product_id", $extraProduct->id)->where("desc_id",$desc->id)->first(); ?>
                <div>
                    <label for="price">Price - {{ $desc->name }}</label>
<input type="text" name="price[{{$price->id}}]" id="price" value="{{ old('prices.' . $price->id, $price->price) }}"> 
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
@endforeach

                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $extraProduct->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Update Extra Product</button>
            </form>
        </div>
    </div>
</x-app-layout>
