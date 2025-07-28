<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Restaurant Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Edit Restaurant Table</h3>
                        <a href="{{ route('restaurant-tables.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Tables
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('restaurant-tables.update', $restaurantTable) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="table_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="table_category_id" id="table_category_id" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('table_category_id', $restaurantTable->table_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="table_number" class="block text-sm font-medium text-gray-700">Table Number</label>
                                <input type="text" name="table_number" id="table_number" value="{{ old('table_number', $restaurantTable->table_number) }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                       placeholder="e.g., Table 1, VIP-1" required>
                            </div>

                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity (Seats)</label>
                                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $restaurantTable->capacity) }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                       placeholder="4" min="1" max="20" required>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="available" {{ old('status', $restaurantTable->status) == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="occupied" {{ old('status', $restaurantTable->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                    <option value="reserved" {{ old('status', $restaurantTable->status) == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                    <option value="maintenance" {{ old('status', $restaurantTable->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="notes" id="notes" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                          placeholder="Any special notes about this table (e.g., window seat, corner table)">{{ old('notes', $restaurantTable->notes) }}</textarea>
                            </div>

                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $restaurantTable->sort_order) }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                       placeholder="0" min="0">
                            </div>

                            <div class="flex justify-end space-x-3 md:col-span-2">
                                <a href="{{ route('restaurant-tables.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Table
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 