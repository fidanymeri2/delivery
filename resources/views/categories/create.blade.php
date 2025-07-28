<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">

    <h1 class="text-2xl font-bold mb-6">{{ __('category.create_category') }}</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('category.category_name') }}:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                {{ __('category.category_description') }} <span class="text-gray-500 font-light">({{ __('category.optional') }})</span>:
                </label>
                <textarea name="description" id="description"
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ __('category.save_category') }}
            </button>
        </form>
    </div>
</x-app-layout>
