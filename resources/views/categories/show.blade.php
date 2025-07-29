<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb Navigation -->
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ __('category.categories') }}
                        </a>
                        <span class="mx-2">/</span>
                        <span>{{ __('category.category_details') }}</span>
                    </div>

                    <!-- Category Details -->
                    <div class="max-w-2xl mx-auto">
                        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                            {{ __('category.category_details') }}
                        </h1>

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-1">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('category.category_name') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $category->name }}
                                        </dd>
                                    </div>

                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('category.category_description') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $category->description }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex items-center space-x-3">
                            <a href="{{ route('categories.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('category.back_to_categories') }}
                            </a>
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('category.edit') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
