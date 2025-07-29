<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Product Details -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-blue-600 mb-6">
                            {{ __('product.product_details') }}
                        </h2>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-8">
                                    <!-- Product Image -->
                                    @if($product->image)
                                        <div class="flex-shrink-0 mb-6 lg:mb-0">
                                            <img src="{{ asset($product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-48 h-48 object-cover rounded-lg shadow-md">
                                        </div>
                                    @endif

                                    <!-- Product Information -->
                                    <div class="flex-1">
                                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32">{{ __('product.category') }}:</span>
                                                <span class="text-sm text-gray-900">{{ $product->category->name }}</span>
                                            </div>

                                            <div class="flex items-start">
                                                <span class="text-sm font-medium text-gray-500 w-32 mt-1">{{ __('product.description') }}:</span>
                                                <span class="text-sm text-gray-900 flex-1">{{ $product->description }}</span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32">{{ __('product.new_product') }}:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->new_product ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $product->new_product ? __('product.yes') : __('product.no') }}
                                                </span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32">{{ __('product.new_offers') }}:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->new_offers ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $product->new_offers ? __('product.yes') : __('product.no') }}
                                                </span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32">{{ __('product.suggested') }}:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->suggested ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $product->suggested ? __('product.yes') : __('product.no') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Sizes Section -->
                    @if($product->sizes && $product->sizes->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('product.product_sizes') }}</h3>
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('product.size') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('product.price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($product->sizes as $size)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $size->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $size->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Extra Products Section -->
                    @if($product->extras && $product->extras->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('product.extra_products') }}</h3>
                            <div class="bg-white shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <div class="px-6 py-4">
                                    <div class="space-y-4">
                                        @foreach($product->extras as $extra)
                                            <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-900">{{ $extra->name }}</h4>
                                                        @if($extra->category)
                                                            <p class="text-xs text-gray-500 italic">{{ $extra->category->name }}</p>
                                                        @endif
                                                    </div>
                                                    @if($extra->prices && $extra->prices->count() > 0)
                                                        <div class="text-sm text-gray-900">
                                                            @foreach($extra->prices as $price)
                                                                <span class="inline-block bg-gray-100 rounded px-2 py-1 mr-2">{{ $price->price }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('product.back_to_products') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
