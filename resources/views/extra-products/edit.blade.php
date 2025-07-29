<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb -->
                    <div class="flex items-center mb-6 text-sm text-gray-500">
                        <a href="{{ route('extra-products.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            Extra Products
                        </a>
                        <span class="mx-2">/</span>
                        <span>Edit Extra Product</span>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Edit Extra Product
                        </h2>
                    </div>

                    <div class="max-w-2xl">
                        <form action="{{ route('extra-products.update', $extraProduct->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name:
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $extraProduct->name) }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description:
                                </label>
                                <textarea name="description"
                                          id="description"
                                          required
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description', $extraProduct->description) }}</textarea>
                                @error('description')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            @foreach($descriptions as $desc)
                                <?php $price = App\Models\ExtraProductPrice::where("extra_product_id", $extraProduct->id)->where("desc_id",$desc->id)->first(); ?>
                                <div class="mb-6">
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Price - {{ $desc->name }}
                                    </label>
                                    <input type="text"
                                           name="price[{{$price->id}}]"
                                           id="price"
                                           value="{{ old('prices.' . $price->id, $price->price) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('price')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="mb-6">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category:
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $extraProduct->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('extra-products.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Update Extra Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
