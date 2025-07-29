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

                    <!-- Trash Button -->
                    <div class="mb-6">
                        <a href="{{ route('orders.trash') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                            <i class="fas fa-trash mr-2"></i> View Trash
                        </a>
                    </div>

                    <!-- Filter Section -->
                    <div class="mb-8 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Filter Orders</h2>
                        <form action="{{ route('orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Order Status</label>
                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                </select>
                            </div>

                            <div>
                                <label for="status_of_payment" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                <select name="status_of_payment" id="status_of_payment" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All</option>
                                    <option value="bank" {{ request('status_of_payment') == 'bank' ? 'selected' : '' }}>Bank</option>
                                    <option value="cash" {{ request('status_of_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="pickup" {{ request('status_of_payment') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                                </select>
                            </div>

                            <div>
                                <label for="shipping_status" class="block text-sm font-medium text-gray-700 mb-2">Shipping Status</label>
                                <select name="shipping_status" id="shipping_status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="new" {{ request('shipping_status', 'new') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="delivered" {{ request('shipping_status') == 'delivered' ? 'selected' : '' }}>On the way</option>
                                    <option value="complete" {{ request('shipping_status') == 'complete' ? 'selected' : '' }}>Delivered</option>
                                    <option value="canceled" {{ request('shipping_status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Orders Table -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-900">Orders</h2>
                            <p class="text-sm text-gray-600">Total Orders: <span class="font-bold text-xl text-blue-600">{{ $orders->total() }}</span></p>
                        </div>

                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone NR</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postal Code</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shipping Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($orders as $order)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->order_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->firstName }} {{ $order->lastName }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->phone_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->location }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->postal_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->status_of_payment }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if($order->shipping_status == 'new')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">New</span>
                                                @elseif($order->shipping_status == 'delivered')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">On the way</span>
                                                @elseif($order->shipping_status == 'complete')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Delivered</span>
                                                @elseif($order->shipping_status == 'canceled')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Canceled</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Unknown</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                       class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                                        <i class="fas fa-eye mr-1"></i> View
                                                    </a>
                                                    <a href="{{ route('orders.invoice', $order->id) }}"
                                                       class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150"
                                                       onclick="printInvoice(event, '{{ route('orders.invoice', $order->id) }}')">
                                                        Invoice
                                                    </a>
                                                    <a href="{{ route('orders.edit', $order->id) }}"
                                                       class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150"
                                                                onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash mr-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    </div>

                    <!-- PDF Report Section -->
                    <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">PDF Report</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="text-center">
                                <a href="{{ route('orders.dailyPdf') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                    <i class="fas fa-file-pdf mr-2"></i> Generate Daily Orders PDF
                                </a>
                            </div>

                            <div>
                                <form action="{{ route('orders.dateRangePdf') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="waiterId" class="block text-sm font-medium text-gray-700 mb-2">Waiter / Delivery</label>
                                        <select name="waiterId" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="all">All</option>
                                            <optgroup label="Waiter">
                                                @php
                                                $waiters = \App\Models\Waiter::get();
                                                @endphp
                                                @foreach($waiters as $waiter)
                                                    <option value="w-{{$waiter->id}}">{{ $waiter->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Delivery">
                                                @php
                                                $users = \App\Models\User::where('role','delivery')->get();
                                                @endphp
                                                @foreach($users as $user)
                                                    <option value="d-{{$user->id}}">{{ $user->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="start_date" name="start_date" required>
                                        </div>
                                        <div>
                                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="end_date" name="end_date" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                            <i class="fas fa-file-pdf mr-2"></i> Generate Date Range PDF
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printInvoice(event, url) {
            event.preventDefault();

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    const printWindow = window.open('', '', 'height=600,width=800');

                    printWindow.document.write(data);

                    printWindow.document.close();
                    printWindow.print();
                })
                .catch(error => {
                    console.error('Error fetching invoice:', error);
                });
        }
    </script>
</x-app-layout>
