<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Table Order') }} #{{ $tableOrder->id }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('table-orders.show', $tableOrder) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    View Order
                </a>
                <a href="{{ route('table-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Orders
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('table-orders.update', $tableOrder) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                                                {{ (old('restaurant_table_id', $tableOrder->restaurant_table_id) == $table->id) ? 'selected' : '' }}>
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
                                                {{ (old('waiter_id', $tableOrder->waiter_id) == $waiter->id) ? 'selected' : '' }}>
                                            {{ $waiter->name }} (PIN: {{ $waiter->pin_code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('waiter_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- Order Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Order Status *
                                </label>
                                <select name="status" id="status" required 
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="open" {{ (old('status', $tableOrder->status) == 'open') ? 'selected' : '' }}>Open</option>
                                    <option value="closed" {{ (old('status', $tableOrder->status) == 'closed') ? 'selected' : '' }}>Closed</option>
                                    <option value="cancelled" {{ (old('status', $tableOrder->status) == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment Status -->
                            <div>
                                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Status *
                                </label>
                                <select name="payment_status" id="payment_status" required 
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="pending" {{ (old('payment_status', $tableOrder->payment_status) == 'pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="partial" {{ (old('payment_status', $tableOrder->payment_status) == 'partial') ? 'selected' : '' }}>Partial</option>
                                    <option value="paid" {{ (old('payment_status', $tableOrder->payment_status) == 'paid') ? 'selected' : '' }}>Paid</option>
                                </select>
                                @error('payment_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-6">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                                Payment Method
                            </label>
                            <select name="payment_method" id="payment_method" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">No payment method selected</option>
                                <option value="cash" {{ (old('payment_method', $tableOrder->payment_method) == 'cash') ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ (old('payment_method', $tableOrder->payment_method) == 'card') ? 'selected' : '' }}>Card</option>
                                <option value="bank_transfer" {{ (old('payment_method', $tableOrder->payment_method) == 'bank_transfer') ? 'selected' : '' }}>Bank Transfer</option>
                            </select>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Notes
                            </label>
                            <textarea name="notes" id="notes" rows="3" 
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Add any special instructions or notes...">{{ old('notes', $tableOrder->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 