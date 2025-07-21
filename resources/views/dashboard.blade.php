<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Products</h3>
            <p class="mt-2 text-lg">{{ $totalProducts }}</p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Category</h3>
            <p class="mt-2 text-lg">{{ $totalCategories }}</p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Orders</h3>
            <p class="mt-2 text-lg">{{ $totalOrders }}</p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Users</h3>
            <p class="mt-2 text-lg">{{ $totalUsers }}</p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Extra Products</h3>
            <p class="mt-2 text-lg">{{ $totalExtrasProduct }}</p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Extra Category</h3>
            <p class="mt-2 text-lg">{{ $totalExtrasCategory }}</p>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4">Top 5 Best-Selling Products</h3>
                <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Product</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topSellingProducts as $item)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $item['product']->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $item['total_quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            <canvas id="productsChart" class="mt-6"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4">Shipping Status Statistics</h3>
            <canvas id="shippingStatusChart"></canvas>
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4 mt-6">Payment Status Statistics</h3>
            <canvas id="paymentStatusChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxProducts = document.getElementById('productsChart').getContext('2d');
            const ctxShippingStatus = document.getElementById('shippingStatusChart').getContext('2d');
            const ctxPaymentStatus = document.getElementById('paymentStatusChart').getContext('2d');


            // Products Chart
            new Chart(ctxProducts, {
                type: 'bar',
                data: {
                    labels: @json($topSellingProducts->pluck('product.name')),
                    datasets: [{
                        label: 'Total Sales',
                        data: @json($topSellingProducts->pluck('total_quantity')),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Shipping Status Chart
            new Chart(ctxShippingStatus, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(@json($shippingStatusStats)),
                    datasets: [{
                        label: 'Shipping Status',
                        data: Object.values(@json($shippingStatusStats)),
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            // Payment Status Chart
            new Chart(ctxPaymentStatus, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(@json($paymentStatusStats)),
                    datasets: [{
                        label: 'Payment Status',
                        data: Object.values(@json($paymentStatusStats)),
                        backgroundColor: ['rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>