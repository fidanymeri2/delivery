<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Table Order') }} #{{ $tableOrder->id }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('table-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Orders
                </a>
                @if($tableOrder->status === 'open')
                    <a href="{{ route('table-orders.edit', $tableOrder) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Order
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Order Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Information</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Order ID:</span>
                                    <span class="font-medium">#{{ $tableOrder->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Table:</span>
                                    <span class="font-medium">{{ $tableOrder->table->table_number ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Category:</span>
                                    <span class="font-medium">{{ $tableOrder->table->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Waiter:</span>
                                    <span class="font-medium">{{ $tableOrder->waiter->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($tableOrder->status === 'open') bg-green-100 text-green-800
                                        @elseif($tableOrder->status === 'closed') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($tableOrder->status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created:</span>
                                    <span class="font-medium">{{ $tableOrder->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                @if($tableOrder->closed_at)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Closed:</span>
                                        <span class="font-medium">{{ $tableOrder->closed_at->format('M d, Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Payment Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($tableOrder->payment_status === 'paid') bg-green-100 text-green-800
                                        @elseif($tableOrder->payment_status === 'partial') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($tableOrder->payment_status) }}
                                    </span>
                                </div>
                                @if($tableOrder->payment_method)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Payment Method:</span>
                                        <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $tableOrder->payment_method)) }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Amount:</span>
                                    <span class="font-medium text-lg">${{ number_format($tableOrder->total_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Paid Amount:</span>
                                    <span class="font-medium">${{ number_format($tableOrder->paid_amount, 2) }}</span>
                                </div>
                                @if($tableOrder->notes)
                                    <div class="mt-4">
                                        <span class="text-gray-600 block mb-2">Notes:</span>
                                        <p class="text-sm bg-white p-2 rounded border">{{ $tableOrder->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                        @if($tableOrder->items->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($tableOrder->items as $item)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $item->product->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    ${{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    ${{ number_format($item->total_price, 2) }}
                                                </td>
                                                <td class="px-4 py-2">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($item->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($item->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($item->status ?? 'pending') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No items in this order.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 