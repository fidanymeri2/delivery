<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- Breadcrumb Navigation -->
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <a href="{{ route('extra-categories.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            Extra Categories
                        </a>
                        <span class="mx-2">/</span>
                        <span>Edit Extra Category</span>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Edit Extra Category
                        </h2>
                    </div>

                    <!-- Edit Extra Category Form -->
                    <div class="max-w-md mx-auto">
                        <form action="{{ route('extra-categories.update', $extraCategory) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name:
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $extraCategory->name) }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
