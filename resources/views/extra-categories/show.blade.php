<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb Navigation -->
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <a href="{{ route('extra-categories.index') }}" class="text-blue-600 hover:underline">
                            Extra Categories
                        </a>
                        <span class="mx-2">/</span>
                        <span>Extra Category Details</span>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Extra Category Details
                        </h2>
                    </div>

                    <!-- Category Details -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-700 w-20">ID:</span>
                                <span class="text-gray-900">{{ $extraCategory->id }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-700 w-20">Name:</span>
                                <span class="text-gray-900">{{ $extraCategory->name }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 mt-6">
                            <a href="{{ route('extra-categories.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to List
                            </a>
                            <a href="{{ route('extra-categories.edit', $extraCategory->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
