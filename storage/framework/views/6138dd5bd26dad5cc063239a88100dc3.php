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
        body {
    font-family: Arial, sans-serif;
    background-color: #f9fafb;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    font-size: 1.5rem;
    color: #2854C5;
    margin: 1rem;
}

a {
    text-decoration: none;
    color: #2854C5;
}

a:hover {
    text-decoration: underline;
}

.container {
    max-width: 1200px;
    margin: auto;
    padding: 1rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #2854C5;
    color: white;
}

th, td {
    padding: 0.75rem;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    text-transform: uppercase;
    font-weight: 600;
    font-size: 0.875rem;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

tbody tr:hover {
    background-color: #e6f7ff;
}

button, .btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

button:hover, .btn:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-pdf {
    background-color: #eb5e28;
}

.btn-pdf:hover {
    background-color: #99582a;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.form-grid-item {
    display: flex;
    flex-direction: column;
}

.form-grid-item label {
    margin-bottom: 5px;
}

.form-control {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }

    table {
        font-size: 0.875rem;
    }

    th, td {
        padding: 0.5rem;
    }

    .actions {
        flex-direction: column;
    }
}

    </style>
    <div class="container">
    <div class="settings">
        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <a href="<?php echo e(route('settings.index')); ?>" class="text-white no-underline hover:no-underline"><i class='fas fa-angle-left'></i> Settings</a>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
        </div>  

        <form action="<?php echo e(route('products.stats')); ?>" method="GET" class="form-grid">
            <div class="form-grid-item">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" value="<?php echo e(request('start_date')); ?>" class="form-control">
            </div>
            <div class="form-grid-item">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" value="<?php echo e(request('end_date')); ?>" class="form-control">
            </div>
            <div class="form-grid-item">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-grid-item">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="">All Payment Methods</option>
                    <option value="paypal" <?php echo e(request('payment_method') == 'paypal' ? 'selected' : ''); ?>>PayPal</option>
                    <option value="credit_card" <?php echo e(request('payment_method') == 'credit_card' ? 'selected' : ''); ?>>Credit Card</option>
                    <option value="cash" <?php echo e(request('payment_method') == 'cash' ? 'selected' : ''); ?>>Cash</option>
                </select>
            </div>
            <div class="form-grid-item">
                <label for="stat_type">Stat Type:</label>
                <select name="stat_type" id="stat_type" class="form-control">
                    <option value="best_selling" <?php echo e(request('stat_type') == 'best_selling' ? 'selected' : ''); ?>>Best Seller</option>
                    <option value="least_selling" <?php echo e(request('stat_type') == 'least_selling' ? 'selected' : ''); ?>>Least Sold</option>
                </select>
            </div>
            <div class="form-grid-item">
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('products.stats')); ?>" class="btn btn-danger">Reset</a>
                    <a href="<?php echo e(route('orders.deliverystats')); ?>" class="btn btn-success">Delivery </a>
                </div>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-2">
                <a href="<?php echo e(route('products.generate_pdf', request()->all())); ?>" class="btn btn-pdf btn-block">Generate PDF</a>
            </div>
        </div>

        <?php if($bestSellingProducts->isEmpty()): ?>
            <p>No products found for the selected criteria.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Total Sold</th>
                        <th>Total Revenue (€)</th> <!-- New column for revenue -->
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category->name); ?></td>
                            <td><?php echo e($product->total_quantity); ?></td>
                            <td><?php echo e(number_format($product->total_revenue, 2)); ?></td> <!-- Display revenue -->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <?php echo e($bestSellingProducts->links()); ?>

        <?php endif; ?>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\delivery\resources\views/products/stats.blade.php ENDPATH**/ ?>