<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Products</h3>
            <p class="mt-2 text-lg"><?php echo e($totalProducts); ?></p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Category</h3>
            <p class="mt-2 text-lg"><?php echo e($totalCategories); ?></p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Orders</h3>
            <p class="mt-2 text-lg"><?php echo e($totalOrders); ?></p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Users</h3>
            <p class="mt-2 text-lg"><?php echo e($totalUsers); ?></p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Extra Products</h3>
            <p class="mt-2 text-lg"><?php echo e($totalExtrasProduct); ?></p>
        </div>

        <div class="bg-[#4c62a7] text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold">Extra Category</h3>
            <p class="mt-2 text-lg"><?php echo e($totalExtrasCategory); ?></p>
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
                <?php $__currentLoopData = $topSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300"><?php echo e($item['product']->name); ?></td>
                        <td class="py-2 px-4 border-b border-gray-300"><?php echo e($item['total_quantity']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    labels: <?php echo json_encode($topSellingProducts->pluck('product.name'), 15, 512) ?>,
                    datasets: [{
                        label: 'Total Sales',
                        data: <?php echo json_encode($topSellingProducts->pluck('total_quantity'), 15, 512) ?>,
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
                    labels: Object.keys(<?php echo json_encode($shippingStatusStats, 15, 512) ?>),
                    datasets: [{
                        label: 'Shipping Status',
                        data: Object.values(<?php echo json_encode($shippingStatusStats, 15, 512) ?>),
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
                    labels: Object.keys(<?php echo json_encode($paymentStatusStats, 15, 512) ?>),
                    datasets: [{
                        label: 'Payment Status',
                        data: Object.values(<?php echo json_encode($paymentStatusStats, 15, 512) ?>),
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/dashboard.blade.php ENDPATH**/ ?>