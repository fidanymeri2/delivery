<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">
                            {{ __('category.categories') }}
                        </a>
                        <span class="mx-2">/</span>
                        <span>{{ __('category.edit_category') }}</span>
                    </div>

                    <div class="max-w-2xl mx-auto">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ __('category.edit_category') }}
                        </h2>

                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('category.category_name') }}:
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ $category->name }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('category.category_description') }}:
                                </label>
                                <textarea name="description"
                                          id="description"
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $category->description }}</textarea>
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('categories.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('category.cancel') }}
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('category.update_category') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
