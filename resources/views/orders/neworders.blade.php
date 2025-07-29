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

                    <!-- New Orders -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-blue-600 mb-4">
                            {{ __('neworder.new_orders') }} <span id="newOrder" class="text-gray-600">(0)</span>
                        </h2>
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status of Payment</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody" class="bg-white divide-y divide-gray-200">
                                    <!-- Dynamic content will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @php
                    $o = 1;
                    $c = 1;
                    $can = 1;
                    @endphp

                    <!-- Delivered Orders -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-orange-600 mb-4">
                            {{ __('neworder.delivered_orders') }} ({{ count($deliveredOrders) }})
                        </h2>
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.order_code') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.full_name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.phone_number') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.location') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.email') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.status_of_payment') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.date') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($deliveredOrders as $order)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->o++ }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->order_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->firstName }} {{ $order->lastName }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->phone_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->location }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->status_of_payment }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('Y-m-d') }}</td>
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
                                                    <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-purple-700 bg-purple-100">
                                                        {{ __('neworder.delivery') }}: {{ $order->takenByUser->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Completed Orders -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-green-600 mb-4">
                            {{ __('neworder.completed_orders') }} ({{ count($completedOrders) }})
                        </h2>
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.order_code') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.full_name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.phone_number') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.location') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.email') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.status_of_payment') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.date') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($completedOrders as $order)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $c++ }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->order_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->firstName }} {{ $order->lastName }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->phone_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->location }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->status_of_payment }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('Y-m-d') }}</td>
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
                                                    <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-purple-700 bg-purple-100">
                                                        {{ __('neworder.delivery') }}: {{ $order->takenByUser->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Canceled Orders -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">
                            {{ __('neworder.canceled_orders') }} ({{ count($canceledOrders) }})
                        </h2>
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.order_code') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.full_name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.phone_number') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.location') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.email') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.status_of_payment') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.date') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('neworder.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($canceledOrders as $order)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $can++ }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->order_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->firstName }} {{ $order->lastName }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->phone_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->location }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->status_of_payment }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('Y-m-d') }}</td>
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
                                                    <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-purple-700 bg-purple-100">
                                                        {{ __('neworder.delivery') }}: {{ $order->takenByUser->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Styles -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal.show {
            display: block;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .modal-footer .btn {
            margin-left: 10px;
        }
    </style>

    <audio id="kitchenAudio" src="{{ asset('assets/new_order.mp3') }}" preload="auto"></audio>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('show');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
            }
        }

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

        $(document).ready(function() {
            function onNewOrder() {
                $('#kitchenAudio')[0].play().catch(function(error) {
                    console.error('Error playing the audio:', error);
                });
            }

            function callApi() {
                let html = "";
                $.ajax({
                    url: '/orders/new/realtime',
                    method: 'GET',
                    success: function(response) {
                        let x = 1;
                        let userRole = "{{auth()->user()->role }}";
                        let csrfToken = "{{ csrf_token() }}";
                        let checkConfirmOrder = response.find((or) => or.confirm_email == 0);

                        if(checkConfirmOrder){
                            onNewOrder();
                        }

                        let deliveryUsers = <?php echo json_encode($deliveryUsers); ?>;
                        const authId = "{{auth()->user()->id}}";
                        console.log(authId);

                        let dt = response;
                        dt.forEach((order, index) => {
                            let date = new Date(order.created_at);
                            let day = String(date.getDate()).padStart(2, '0');
                            let month = String(date.getMonth() + 1).padStart(2, '0');
                            let year = date.getFullYear();
                            let hours = String(date.getHours()).padStart(2, '0');
                            let minutes = String(date.getMinutes()).padStart(2, '0');
                            let formattedDate = `${day}-${month}-${year} ${hours}:${minutes}`;

                            html += `
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.order_code}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.firstName} ${order.lastName}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.phone_number}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.location}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.email}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.status_of_payment}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formattedDate}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">`;

                            // Admin Actions
                            if (userRole === 'admin') {
                                html += `
                                    <a href="/orders/${order.id}" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                        <i class="fas fa-eye mr-1"></i> View
                                    </a>
                                    <a href="/orders/${order.id}/invoice" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150" onclick="printInvoice(event, '/orders/${order.id}/invoice')">
                                        Invoice
                                    </a>
                                    <a href="/orders/${order.id}/edit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>`;

                                if(order.shipping_status === 'new' && !order.confirm_email) {
                                    html += `
                                        <form action="/orders/${order.id}/send-email" method="POST" style="display:inline;">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition ease-in-out duration-150">
                                                <i class="fas fa-envelope mr-1"></i> Email
                                            </button>
                                        </form>`;
                                }

                                if (order.taken_by) {
                                    html += `
                                        <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-purple-700 bg-purple-100">
                                            Delivery: ${order.taken_by_user?.name || 'N/A'}
                                        </span>
                                        <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-orange-700 bg-orange-100 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition ease-in-out duration-150" onclick="openModal('changeDeliveryUserModal-${order.id}')">
                                            Change Delivery User
                                        </button>`;
                                } else {
                                    html += `
                                        <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-gray-700 bg-gray-100">
                                            No Delivery
                                        </span>
                                        <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150" onclick="openModal('changeDeliveryUserModal-${order.id}')">
                                            Assign Delivery User
                                        </button>`;
                                }
                            }

                            // Delivery Actions
                            if (userRole === 'delivery') {
                                if (!order.taken_by) {
                                    html += `
                                        <form action="/orders/${order.id}/claim" method="POST" style="display:inline;">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                                Take Order
                                            </button>
                                        </form>`;
                                } else if (order.taken_by === {{auth()->user()->id}}) {
                                    html += `
                                        <a href="/orders/${order.id}" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                            <i class="fas fa-eye mr-1"></i> View
                                        </a>
                                        <a href="/orders/${order.id}/invoice" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150" onclick="printInvoice(event, '/orders/${order.id}/invoice')">
                                            Invoice
                                        </a>
                                        <a href="/orders/${order.id}/edit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100">
                                            You Claimed This Order
                                        </span>`;
                                } else {
                                    html += `<span class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100">Order Taken By Another</span>`;
                                }
                            }

                            // Modal for changing/assigning delivery user (Admin only)
                            if (userRole === 'admin') {
                                html += `
                                    <div id="changeDeliveryUserModal-${order.id}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('changeDeliveryUserModal-${order.id}')">&times;</span>
                                            <form action="/orders/${order.id}/update-delivery-user" method="POST">
                                                <input type="hidden" name="_token" value="${csrfToken}">
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <label for="delivery_user" class="block text-sm font-medium text-gray-700 mb-2">Select Delivery User:</label>
                                                        <select name="delivery_user" id="delivery_user" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                            <option value="">-- Select Delivery User --</option>`;

                                deliveryUsers.forEach(user => {
                                    html += `<option value="${user.id}" ${order.taken_by === user.id ? 'selected' : ''}>
                                        ${user.name}
                                    </option>`;
                                });

                                html += `
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="closeModal('changeDeliveryUserModal-${order.id}')">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        <i class="fas fa-save mr-1"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>`;
                            }

                            html += `</div></td></tr>`;
                            x++;
                        });

                        $("#tbody").html(html);
                        $("#newOrder").html("("+response.length+")");
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }

            callApi();
            setInterval(callApi, 120000);
        });
    </script>
</x-app-layout>
