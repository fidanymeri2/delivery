<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    @if(session('success'))
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

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Statistics Card -->
                        <a href="{{ route('products.stats') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.stats') }}</h3>
                                <p class="text-sm text-gray-500">View product statistics and analytics</p>
                            </div>
                        </a>

                        <!-- Messages Card -->
                        <a href="{{ route('messages.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="far fa-comment-alt"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.messages') }}</h3>
                                <p class="text-sm text-gray-500">Manage system messages and notifications</p>
                            </div>
                        </a>

                        <!-- Documents Card -->
                        <a href="{{ route('documents.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.documents') }}</h3>
                                <p class="text-sm text-gray-500">Manage documents and files</p>
                            </div>
                        </a>

                        <!-- Users Card -->
                        <a href="{{ route('users.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.users') }}</h3>
                                <p class="text-sm text-gray-500">Manage user accounts and permissions</p>
                            </div>
                        </a>

                        <!-- Partners Card -->
                        <a href="{{ route('partners.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.partners') }}</h3>
                                <p class="text-sm text-gray-500">Manage business partners and collaborations</p>
                            </div>
                        </a>

                        <!-- Shipping Fees Card -->
                        <a href="{{ route('shipping-fees.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.shipping_fees') }}</h3>
                                <p class="text-sm text-gray-500">Configure delivery and shipping costs</p>
                            </div>
                        </a>

                        <!-- Banners Card -->
                        <a href="{{ route('banners.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-ad"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.banners') }}</h3>
                                <p class="text-sm text-gray-500">Manage promotional banners and ads</p>
                            </div>
                        </a>

                        <!-- Feedbacks Card -->
                        <a href="{{ route('feedbacks.index') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 p-6 text-center group">
                                <div class="text-blue-600 text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('settings.feedbacks') }}</h3>
                                <p class="text-sm text-gray-500">View and manage customer feedback</p>
                            </div>
                        </a>

                        <!-- Language Selection Card -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 text-center">
                            <div class="text-blue-600 text-3xl mb-4">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('settings.language') }}</h3>
                            <form action="{{ route('settings.update-language') }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="space-y-2">
                                    <label class="flex items-center justify-center">
                                        <input type="radio" name="language" value="en" {{ auth()->user()->language == 'en' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">{{ __('settings.english') }}</span>
                                    </label>
                                    <label class="flex items-center justify-center">
                                        <input type="radio" name="language" value="sq" {{ auth()->user()->language == 'sq' ? 'checked' : '' }}
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">{{ __('settings.albanian') }}</span>
                                    </label>
                                </div>
                                <button type="submit"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    {{ __('settings.save_changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
