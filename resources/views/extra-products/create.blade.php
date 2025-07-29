<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb Navigation -->
                    <div class="flex items-center mb-6 text-sm text-gray-500">
                        <a href="{{ route('extra-products.index') }}" class="text-blue-600 hover:text-blue-800">
                            Extra Products
                        </a>
                        <span class="mx-2">/</span>
                        <span>Create Extra Product</span>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Create Extra Product
                        </h2>
                    </div>

                    <!-- Create Extra Product Form -->
                    <div class="max-w-2xl">
                        <form method="POST" action="{{ route('extra-products.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name:
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name') }}"
                                       class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description:
                                </label>
                                <textarea name="description"
                                          id="description"
                                          rows="3"
                                          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            @foreach($descriptions as $desc)
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Price - {{ $desc->name }}
                                    </label>
                                    <input type="text"
                                           name="price[{{$desc->id}}]"
                                           id="price"
                                           value="{{ old('prices.' . $desc->id) }}"
                                           class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    @error('price')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category:
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Create Extra Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
