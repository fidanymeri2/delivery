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
        .container {
            max-width: 1500px;
            margin: auto;
            padding: 1rem;
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
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }
        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e6f7ff;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #e60000;
        }
        .actions a {
            margin-right: 0.5rem;
        }
        .actions form {
            display: inline;
        }
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 0.75rem;
            margin: 1rem 0;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            text-decoration: none; 
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            text-decoration: none; 
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            overflow-x: auto; /* Enables horizontal scrolling if content overflows */
            -webkit-overflow-scrolling: touch;
        }
        .table td, .table th {
    white-space: nowrap;
}
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.5rem;
        }
        .form-group {
            flex: 1;
            margin: 0.5rem;
            min-width: 200px; /* Ensures form groups have a minimum width */
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .form-group button {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        .filter-section {
            margin-top: 3rem;
            padding-bottom: 1rem;
            border: 1px solid #ddd; 
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            background-color: #fff;
        }

        .status-new {
            color: blue;
            font-weight: bold;
        }

        .status-delivered {
            color: orange;
            font-weight: bold;
        }

        .status-complete {
            color: green;
            font-weight: bold;
        }

        .status-canceled {
           color: red;
            font-weight: bold;
        }

        .status-unknown {
            color: gray;
        }
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }
            table {
                font-size: 0.75rem;
            }
            th, td {
                padding: 0.5rem;
            }
            .actions {
                flex-direction: column;
                align-items: flex-start;
            }
            .actions a, .actions button {
                margin-bottom: 0.5rem;
            }
        }
        @media (max-width: 576px) {
            h1 {
                font-size: 1.25rem;
            }
            .container {
                padding: 0.25rem;
            }
            .btn, .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
    <div class="container">
        <h1>Trashed Orders</h1>
    
        <?php if(session('success')): ?>
        <p class="success-message"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

        <?php if($orders->isEmpty()): ?>
            <p>No trashed orders found.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Deleted By</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->fullname); ?></td>
                            <td><?php echo e(optional($order->deletedBy)->name ?? 'Unknown'); ?></td>
                            <td><?php echo e($order->deleted_at); ?></td>
                            <td>
                                <a href="<?php echo e(route('orders.restore', $order->id)); ?>" class="btn btn-primary">Restore</a>
                                <form action="<?php echo e(route('orders.forceDelete', $order->id)); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
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
<?php endif; ?><?php /**PATH C:\laragon\www\delivery\resources\views/orders/trash.blade.php ENDPATH**/ ?>