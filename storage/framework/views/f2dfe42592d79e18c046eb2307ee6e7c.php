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
        .adjust-stock-page {
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

        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb-separator {
            margin: 0 0.5rem;
        }

        .adjustment-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .product-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .product-details h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .product-details p {
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .product-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #e0e7ff;
            color: #3730a3;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .stock-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stock-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .stock-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stock-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-value.current {
            color: #3b82f6;
        }

        .stock-value.minimum {
            color: #ef4444;
        }

        .stock-value.maximum {
            color: #10b981;
        }

        .stock-value.unit {
            color: #64748b;
            font-size: 1rem;
        }

        .adjustment-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 100px;
            transition: border-color 0.3s ease;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .quantity-preview {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            border: 1px solid #e2e8f0;
        }

        .preview-label {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .preview-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .preview-value.positive {
            color: #059669;
        }

        .preview-value.negative {
            color: #dc2626;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #fecaca;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #bbf7d0;
        }

        @media (max-width: 768px) {
            .product-info {
                flex-direction: column;
                text-align: center;
            }

            .product-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .stock-overview {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="adjust-stock-page">
        <!-- Page Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <a href="<?php echo e(route('stock-management.index')); ?>"><?php echo e(__('stock-management.stock_management_dashboard')); ?></a>
                <span class="breadcrumb-separator">/</span>
                <a href="<?php echo e(route('stock-management.product-stock', $product)); ?>"><?php echo e($product->name); ?></a>
                <span class="breadcrumb-separator">/</span>
                <span><?php echo e(__('stock-management.adjust_stock')); ?></span>
            </div>
            <h1 class="page-title"><?php echo e(__('stock-management.adjust_stock')); ?></h1>
            <p class="page-subtitle"><?php echo e(__('stock-management.adjust_product_inventory')); ?></p>
        </div>

        <div class="adjustment-container">
            <!-- Product Information -->
            <div class="product-card">
                <div class="product-header">
                    <div class="product-info">
                        <div class="product-icon">📦</div>
                        <div class="product-details">
                            <h2><?php echo e($product->name); ?></h2>
                            <p><?php echo e($product->description); ?></p>
                            <span class="product-category"><?php echo e($product->category->name); ?></span>
                        </div>
                    </div>

                    <div class="stock-overview">
                        <div class="stock-item">
                            <div class="stock-label"><?php echo e(__('stock-management.current_stock_level')); ?></div>
                            <div class="stock-value current"><?php echo e($product->current_stock); ?> <?php echo e($product->stock_unit); ?></div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label"><?php echo e(__('stock-management.minimum_stock_level')); ?></div>
                            <div class="stock-value minimum"><?php echo e($product->min_stock_level); ?> <?php echo e($product->stock_unit); ?></div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label">Maximum Level</div>
                            <div class="stock-value maximum"><?php echo e($product->max_stock_level); ?> <?php echo e($product->stock_unit); ?></div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label"><?php echo e(__('stock-management.stock_unit')); ?></div>
                            <div class="stock-value unit"><?php echo e($product->stock_unit); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adjustment Form -->
            <div class="adjustment-form">
                <h3 class="form-title"><?php echo e(__('stock-management.adjust_stock')); ?></h3>

                <?php if($errors->any()): ?>
                    <div class="error-message">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="success-message">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('stock-management.process-adjustment', $product)); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('stock-management.adjustment_type')); ?></label>
                            <select name="transaction_type" class="form-select" required>
                                <option value=""><?php echo e(__('stock-management.select_type')); ?></option>
                                <option value="purchase" <?php echo e(old('transaction_type') == 'purchase' ? 'selected' : ''); ?>><?php echo e(__('stock-management.purchase')); ?></option>
                                <option value="sale" <?php echo e(old('transaction_type') == 'sale' ? 'selected' : ''); ?>><?php echo e(__('stock-management.sale')); ?></option>
                                <option value="adjustment" <?php echo e(old('transaction_type') == 'adjustment' ? 'selected' : ''); ?>><?php echo e(__('stock-management.adjustment')); ?></option>
                                <option value="return" <?php echo e(old('transaction_type') == 'return' ? 'selected' : ''); ?>><?php echo e(__('stock-management.return')); ?></option>
                                <option value="damage" <?php echo e(old('transaction_type') == 'damage' ? 'selected' : ''); ?>><?php echo e(__('stock-management.damage')); ?></option>
                                <option value="transfer" <?php echo e(old('transaction_type') == 'transfer' ? 'selected' : ''); ?>><?php echo e(__('stock-management.transfer')); ?></option>
                                <option value="correction" <?php echo e(old('transaction_type') == 'correction' ? 'selected' : ''); ?>><?php echo e(__('stock-management.correction')); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('stock-management.adjustment_quantity')); ?></label>
                            <input type="number" name="quantity" class="form-input" step="0.01" value="<?php echo e(old('quantity')); ?>" required>
                            <small class="text-gray-500"><?php echo e(__('stock-management.quantity_help_text')); ?></small>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('stock-management.unit_cost')); ?> (<?php echo e(__('stock-management.currency_symbol')); ?>)</label>
                            <input type="number" name="unit_cost" class="form-input" step="0.01" value="<?php echo e(old('unit_cost', 0)); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('stock-management.reference_number')); ?></label>
                            <input type="text" name="reference_number" class="form-input" value="<?php echo e(old('reference_number')); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('stock-management.supplier_name')); ?></label>
                            <input type="text" name="supplier_name" class="form-input" value="<?php echo e(old('supplier_name')); ?>">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label"><?php echo e(__('stock-management.notes')); ?></label>
                            <textarea name="notes" class="form-textarea" placeholder="<?php echo e(__('stock-management.notes_placeholder')); ?>"><?php echo e(old('notes')); ?></textarea>
                        </div>
                    </div>

                    <!-- Quantity Preview -->
                    <div class="quantity-preview">
                        <div class="preview-label"><?php echo e(__('stock-management.stock_after_adjustment')); ?>:</div>
                        <div class="preview-value" id="stock-preview">
                            <?php echo e($product->current_stock); ?> <?php echo e($product->stock_unit); ?>

                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('stock-management.apply_adjustment')); ?></button>
                        <a href="<?php echo e(route('stock-management.product-stock', $product)); ?>" class="btn btn-secondary"><?php echo e(__('stock-management.cancel')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Live preview of stock after adjustment
        document.querySelector('input[name="quantity"]').addEventListener('input', function() {
            const currentStock = <?php echo e($product->current_stock); ?>;
            const quantity = parseFloat(this.value) || 0;
            const newStock = currentStock + quantity;
            const unit = '<?php echo e($product->stock_unit); ?>';
            
            const preview = document.getElementById('stock-preview');
            preview.textContent = newStock + ' ' + unit;
            
            if (newStock < 0) {
                preview.className = 'preview-value negative';
            } else if (newStock < <?php echo e($product->min_stock_level); ?>) {
                preview.className = 'preview-value negative';
            } else {
                preview.className = 'preview-value positive';
            }
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
<?php endif; ?> <?php /**PATH C:\laragon\www\delivery\resources\views/stock-management/adjust-stock.blade.php ENDPATH**/ ?>