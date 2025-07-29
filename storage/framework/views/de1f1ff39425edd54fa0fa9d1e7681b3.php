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
        .transactions-page {
            padding: 1.5rem;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1.125rem;
        }

        .filters-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .filter-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-button {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: end;
        }

        .filter-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .transactions-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
        }

        .table tr:hover {
            background: #f8fafc;
        }

        .transaction-type {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .transaction-type.purchase {
            background: #dcfce7;
            color: #166534;
        }

        .transaction-type.sale {
            background: #fee2e2;
            color: #991b1b;
        }

        .transaction-type.adjustment {
            background: #dbeafe;
            color: #1e40af;
        }

        .transaction-type.return {
            background: #fef3c7;
            color: #92400e;
        }

        .transaction-type.damage {
            background: #fecaca;
            color: #7f1d1d;
        }

        .transaction-type.transfer {
            background: #e0e7ff;
            color: #3730a3;
        }

        .transaction-type.initial {
            background: #f3e8ff;
            color: #581c87;
        }

        .transaction-type.correction {
            background: #fef2f2;
            color: #7f1d1d;
        }

        .quantity-positive {
            color: #059669;
            font-weight: 600;
        }

        .quantity-negative {
            color: #dc2626;
            font-weight: 600;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .product-category {
            font-size: 0.75rem;
            color: #64748b;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 0.75rem;
        }

        .user-name {
            font-weight: 500;
            color: #1e293b;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
            background: white;
            border-top: 1px solid #e2e8f0;
        }

        .pagination-links {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-link {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            text-decoration: none;
            color: #374151;
            transition: all 0.3s ease;
        }

        .pagination-link:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .pagination-link.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            font-size: 1rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .filters-grid {
                grid-template-columns: 1fr;
            }

            .table {
                font-size: 0.75rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>

    <div class="transactions-page">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Stock Transactions</h1>
            <p class="page-subtitle">View and filter all stock movements</p>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <form method="GET" action="<?php echo e(route('stock-management.transactions')); ?>">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Product</label>
                        <select name="product_id" class="filter-input">
                            <option value="">All Products</option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>" <?php echo e(request('product_id') == $product->id ? 'selected' : ''); ?>>
                                    <?php echo e($product->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Transaction Type</label>
                        <select name="transaction_type" class="filter-input">
                            <option value="">All Types</option>
                            <option value="purchase" <?php echo e(request('transaction_type') == 'purchase' ? 'selected' : ''); ?>>Purchase</option>
                            <option value="sale" <?php echo e(request('transaction_type') == 'sale' ? 'selected' : ''); ?>>Sale</option>
                            <option value="adjustment" <?php echo e(request('transaction_type') == 'adjustment' ? 'selected' : ''); ?>>Adjustment</option>
                            <option value="return" <?php echo e(request('transaction_type') == 'return' ? 'selected' : ''); ?>>Return</option>
                            <option value="damage" <?php echo e(request('transaction_type') == 'damage' ? 'selected' : ''); ?>>Damage</option>
                            <option value="transfer" <?php echo e(request('transaction_type') == 'transfer' ? 'selected' : ''); ?>>Transfer</option>
                            <option value="initial" <?php echo e(request('transaction_type') == 'initial' ? 'selected' : ''); ?>>Initial</option>
                            <option value="correction" <?php echo e(request('transaction_type') == 'correction' ? 'selected' : ''); ?>>Correction</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Date From</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="filter-input">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Date To</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="filter-input">
                    </div>

                    <div class="filter-group">
                        <button type="submit" class="filter-button">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="transactions-table">
            <div class="table-header">
                <h2 class="table-title">Stock Transaction History</h2>
            </div>

            <?php if($transactions->count() > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Stock Before</th>
                            <th>Stock After</th>
                            <th>User</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction->created_at->format('M d, Y H:i')); ?></td>
                                <td>
                                    <div class="product-info">
                                        <div class="product-name"><?php echo e($transaction->product->name); ?></div>
                                        <div class="product-category"><?php echo e($transaction->product->category->name); ?></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="transaction-type <?php echo e($transaction->transaction_type); ?>">
                                        <?php echo e($transaction->getTransactionTypeLabel()); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="<?php echo e($transaction->quantity >= 0 ? 'quantity-positive' : 'quantity-negative'); ?>">
                                        <?php echo e($transaction->getFormattedQuantity()); ?> <?php echo e($transaction->product->stock_unit); ?>

                                    </span>
                                </td>
                                <td><?php echo e($transaction->quantity_before); ?> <?php echo e($transaction->product->stock_unit); ?></td>
                                <td><?php echo e($transaction->quantity_after); ?> <?php echo e($transaction->product->stock_unit); ?></td>
                                <td>
                                    <?php if($transaction->user): ?>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                <?php echo e(strtoupper(substr($transaction->user->name, 0, 1))); ?>

                                            </div>
                                            <div class="user-name"><?php echo e($transaction->user->name); ?></div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-500">System</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($transaction->notes): ?>
                                        <span title="<?php echo e($transaction->notes); ?>">
                                            <?php echo e(Str::limit($transaction->notes, 30)); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <?php echo e($transactions->links()); ?>

                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📊</div>
                    <h3 class="empty-state-title">No Transactions Found</h3>
                    <p class="empty-state-text">No stock transactions match your current filters.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\delivery\resources\views/stock-management/transactions.blade.php ENDPATH**/ ?>