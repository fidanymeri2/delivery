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
    <style>
        .dashboard-container {
            padding: 1.5rem;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            pointer-events: none;
        }

        .stat-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .stat-card .stat-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2rem;
            opacity: 0.3;
            z-index: 0;
        }

        /* Stock Management Cards */
        .stock-card {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stock-card.stock-products {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stock-card.out-of-stock {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .stock-card.low-stock {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stock-card.stock-value {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-card h3 {
                font-size: 1rem;
            }

            .stat-card .stat-value {
                font-size: 1.5rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(5) { animation-delay: 0.5s; }
        .stat-card:nth-child(6) { animation-delay: 0.6s; }
        .stat-card:nth-child(7) { animation-delay: 0.7s; }
        .stat-card:nth-child(8) { animation-delay: 0.8s; }
        .stat-card:nth-child(9) { animation-delay: 0.9s; }
        .stat-card:nth-child(10) { animation-delay: 1.0s; }
        .stat-card:nth-child(11) { animation-delay: 1.1s; }
        .stat-card:nth-child(12) { animation-delay: 1.2s; }
        .stat-card:nth-child(13) { animation-delay: 1.3s; }

        /* Quick Actions Section */
        .quick-actions-section {
            margin-bottom: 2rem;
        }

        .quick-actions-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #4c62a7;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .quick-action-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: #e2e8f0;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .action-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .action-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .action-icon.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .action-icon.purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .action-svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .action-content {
            flex: 1;
        }

        .action-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .action-description {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        /* Stock Management Section Styles */
        .stock-section {
            margin-bottom: 2rem;
        }

        .stock-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .stock-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stock-card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stock-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4c62a7;
        }

        .stock-card-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .stock-card-link:hover {
            color: #2563eb;
        }

        .stock-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .stock-item.low-stock {
            background: #fef3c7;
            border-left-color: #f59e0b;
        }

        .stock-item.out-of-stock {
            background: #fee2e2;
            border-left-color: #ef4444;
        }

        .stock-item-info h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stock-item-info p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        .stock-item-value {
            text-align: right;
        }

        .stock-item-value .quantity {
            font-weight: 700;
            font-size: 1.125rem;
        }

        .stock-item-value .quantity.low {
            color: #f59e0b;
        }

        .stock-item-value .quantity.out {
            color: #ef4444;
        }

        .stock-item-value .label {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Responsive Design for Quick Actions */
        @media (max-width: 768px) {
            .quick-actions-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .quick-action-item {
                padding: 1rem;
            }

            .action-icon {
                width: 50px;
                height: 50px;
                margin-right: 0.75rem;
            }

            .action-svg {
                width: 20px;
                height: 20px;
            }

            .stock-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <h3><?php echo e(__('dashboard.products')); ?></h3>
                <div class="stat-value"><?php echo e($totalProducts); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📂</div>
                <h3><?php echo e(__('dashboard.category')); ?></h3>
                <div class="stat-value"><?php echo e($totalCategories); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🛒</div>
                <h3><?php echo e(__('dashboard.orders')); ?></h3>
                <div class="stat-value"><?php echo e($totalOrders); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <h3><?php echo e(__('dashboard.users')); ?></h3>
                <div class="stat-value"><?php echo e($totalUsers); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">➕</div>
                <h3><?php echo e(__('dashboard.extra_products')); ?></h3>
                <div class="stat-value"><?php echo e($totalExtrasProduct); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📁</div>
                <h3><?php echo e(__('dashboard.extra_category')); ?></h3>
                <div class="stat-value"><?php echo e($totalExtrasCategory); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🍽️</div>
                <h3><?php echo e(__('dashboard.table_categories')); ?></h3>
                <div class="stat-value"><?php echo e($totalTableCategories); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🪑</div>
                <h3><?php echo e(__('dashboard.restaurant_tables')); ?></h3>
                <div class="stat-value"><?php echo e($totalRestaurantTables); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <h3><?php echo e(__('dashboard.active_table_orders')); ?></h3>
                <div class="stat-value"><?php echo e($activeTableOrders); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👨‍💼</div>
                <h3><?php echo e(__('dashboard.waiters')); ?></h3>
                <div class="stat-value"><?php echo e($totalWaiters); ?></div>
            </div>

            <!-- Stock Management Cards -->
            <div class="stat-card stock-card stock-products">
                <div class="stat-icon">📊</div>
                <h3><?php echo e(__('dashboard.stock_products')); ?></h3>
                <div class="stat-value"><?php echo e($stockSummary['total_products'] ?? 0); ?></div>
            </div>

            <div class="stat-card stock-card out-of-stock">
                <div class="stat-icon">⚠️</div>
                <h3><?php echo e(__('dashboard.out_of_stock')); ?></h3>
                <div class="stat-value"><?php echo e($stockSummary['out_of_stock'] ?? 0); ?></div>
            </div>

            <div class="stat-card stock-card low-stock">
                <div class="stat-icon">🔶</div>
                <h3><?php echo e(__('dashboard.low_stock')); ?></h3>
                <div class="stat-value"><?php echo e($stockSummary['low_stock'] ?? 0); ?></div>
            </div>

            <div class="stat-card stock-card stock-value">
                <div class="stat-icon">💰</div>
                <h3><?php echo e(__('dashboard.stock_value')); ?></h3>
                <div class="stat-value">€<?php echo e(number_format($stockSummary['total_stock_value'] ?? 0, 2)); ?></div>
            </div>
        </div>



    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4"><?php echo e(__('dashboard.best_selling_products')); ?></h3>
                <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight"><?php echo e(__('dashboard.product')); ?></th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight"><?php echo e(__('dashboard.total_sales')); ?></th>
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
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4"><?php echo e(__('dashboard.shipping_status_statistics')); ?></h3>
            <canvas id="shippingStatusChart"></canvas>
            <h3 class="text-2xl font-semibold text-[#4c62a7] mb-4 mt-6"><?php echo e(__('dashboard.payment_status_statistics')); ?></h3>
            <canvas id="paymentStatusChart"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <div class="quick-actions-card">
            <h3 class="section-title"><?php echo e(__('dashboard.quick_actions')); ?></h3>
            <div class="quick-actions-grid">
                <a href="<?php echo e(route('stock-management.index')); ?>" class="quick-action-item">
                    <div class="action-icon blue">
                        <svg class="action-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h4 class="action-title"><?php echo e(__('dashboard.stock_management')); ?></h4>
                        <p class="action-description"><?php echo e(__('dashboard.manage_inventory')); ?></p>
                    </div>
                </a>

                <a href="<?php echo e(route('stock-management.transactions')); ?>" class="quick-action-item">
                    <div class="action-icon green">
                        <svg class="action-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h4 class="action-title"><?php echo e(__('dashboard.stock_transactions')); ?></h4>
                        <p class="action-description"><?php echo e(__('dashboard.view_all_movements')); ?></p>
                    </div>
                </a>

                <a href="<?php echo e(route('stock-management.alerts')); ?>" class="quick-action-item">
                    <div class="action-icon red">
                        <svg class="action-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h4 class="action-title"><?php echo e(__('dashboard.stock_alerts')); ?></h4>
                        <p class="action-description"><?php echo e(__('dashboard.manage_notifications')); ?></p>
                    </div>
                </a>

                <a href="<?php echo e(route('stock-management.export-report')); ?>" class="quick-action-item">
                    <div class="action-icon purple">
                        <svg class="action-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h4 class="action-title"><?php echo e(__('dashboard.export_report')); ?></h4>
                        <p class="action-description"><?php echo e(__('dashboard.download_stock_data')); ?></p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Stock Management Section -->
    <div class="stock-section">
        <div class="stock-grid">
            <!-- Low Stock Products -->
            <div class="stock-card">
                <div class="stock-card-header">
                    <h3 class="stock-card-title"><?php echo e(__('dashboard.low_stock_products')); ?></h3>
                    <a href="<?php echo e(route('stock-management.index')); ?>" class="stock-card-link"><?php echo e(__('dashboard.view_all')); ?></a>
                </div>
                <?php if($lowStockProducts->count() > 0): ?>
                    <div>
                        <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="stock-item low-stock">
                                <div class="stock-item-info">
                                    <h4><?php echo e($product->name); ?></h4>
                                    <p><?php echo e($product->category->name); ?></p>
                                </div>
                                <div class="stock-item-value">
                                    <div class="quantity low"><?php echo e($product->current_stock); ?> <?php echo e($product->stock_unit); ?></div>
                                    <div class="label"><?php echo e(__('dashboard.min')); ?>: <?php echo e($product->min_stock_level); ?></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-4"><?php echo e(__('dashboard.no_low_stock_products')); ?></p>
                <?php endif; ?>
            </div>

            <!-- Out of Stock Products -->
            <div class="stock-card">
                <div class="stock-card-header">
                    <h3 class="stock-card-title"><?php echo e(__('dashboard.out_of_stock_products')); ?></h3>
                    <a href="<?php echo e(route('stock-management.index')); ?>" class="stock-card-link"><?php echo e(__('dashboard.view_all')); ?></a>
                </div>
                <?php if($outOfStockProducts->count() > 0): ?>
                    <div>
                        <?php $__currentLoopData = $outOfStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="stock-item out-of-stock">
                                <div class="stock-item-info">
                                    <h4><?php echo e($product->name); ?></h4>
                                    <p><?php echo e($product->category->name); ?></p>
                                </div>
                                <div class="stock-item-value">
                                    <div class="quantity out">0 <?php echo e($product->stock_unit); ?></div>
                                    <div class="label"><?php echo e(__('dashboard.out_of_stock_label')); ?></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-4"><?php echo e(__('dashboard.no_out_of_stock_products')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Stock Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Stock Transactions -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-[#4c62a7]"><?php echo e(__('dashboard.recent_stock_transactions')); ?></h3>
                <a href="<?php echo e(route('stock-management.transactions')); ?>" class="text-blue-600 hover:text-blue-800 text-sm"><?php echo e(__('dashboard.view_all')); ?></a>
            </div>
            <?php if($recentStockTransactions->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $recentStockTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-semibold text-gray-800"><?php echo e($transaction->product->name); ?></h4>
                                <p class="text-sm text-gray-600"><?php echo e($transaction->getTransactionTypeLabel()); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold <?php echo e($transaction->quantity >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                                    <?php echo e($transaction->getFormattedQuantity()); ?> <?php echo e($transaction->product->stock_unit); ?>

                                </p>
                                <p class="text-xs text-gray-500"><?php echo e($transaction->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-4"><?php echo e(__('dashboard.no_recent_transactions')); ?></p>
            <?php endif; ?>
        </div>

        <!-- Active Stock Alerts -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-[#4c62a7]"><?php echo e(__('dashboard.active_stock_alerts')); ?></h3>
                <a href="<?php echo e(route('stock-management.alerts')); ?>" class="text-blue-600 hover:text-blue-800 text-sm"><?php echo e(__('dashboard.view_all')); ?></a>
            </div>
            <?php if($activeStockAlerts->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $activeStockAlerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-3 rounded-lg border-l-4 <?php echo e($alert->priority === 'critical' ? 'bg-red-50 border-red-500' : ($alert->priority === 'high' ? 'bg-orange-50 border-orange-500' : 'bg-yellow-50 border-yellow-500')); ?>">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800"><?php echo e($alert->product->name); ?></h4>
                                    <p class="text-sm text-gray-600"><?php echo e($alert->getAlertTypeLabel()); ?></p>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo e(Str::limit($alert->message, 60)); ?></p>
                                </div>
                                <div class="text-right ml-2">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full <?php echo e($alert->priority === 'critical' ? 'bg-red-100 text-red-800' : ($alert->priority === 'high' ? 'bg-orange-100 text-orange-800' : 'bg-yellow-100 text-yellow-800')); ?>">
                                        <?php echo e(ucfirst($alert->priority)); ?>

                                    </span>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo e($alert->created_at->diffForHumans()); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-4"><?php echo e(__('dashboard.no_active_alerts')); ?></p>
            <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\activ\OneDrive\Documents\Soltriks Projects\delivery\resources\views/dashboard.blade.php ENDPATH**/ ?>