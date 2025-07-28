<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Table Order') }}
            </h2>
            <a href="{{ route('table-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('table-orders.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Table Selection -->
                            <div>
                                <label for="restaurant_table_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Select Table *
                                </label>
                                <select name="restaurant_table_id" id="restaurant_table_id" required 
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Choose a table...</option>
                                    @foreach($tables as $table)
                                        <option value="{{ $table->id }}" 
                                                {{ old('restaurant_table_id') == $table->id ? 'selected' : '' }}>
                                            Table {{ $table->table_number }} 
                                            @if($table->category)
                                                ({{ $table->category->name }})
                                            @endif
                                            - {{ ucfirst($table->status) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('restaurant_table_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Waiter Selection -->
                            <div>
                                <label for="waiter_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Select Waiter *
                                </label>
                                <select name="waiter_id" id="waiter_id" required 
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Choose a waiter...</option>
                                    @foreach($waiters as $waiter)
                                        <option value="{{ $waiter->id }}" 
                                                {{ old('waiter_id') == $waiter->id ? 'selected' : '' }}>
                                            {{ $waiter->name }} (PIN: {{ $waiter->pin_code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('waiter_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Notes (Optional)
                            </label>
                            <textarea name="notes" id="notes" rows="3" 
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Add any special instructions or notes...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 