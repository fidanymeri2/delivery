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
            max-width: 800px;
            margin: auto;
            padding: 1rem;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin: 1rem 0;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2854C5;
            border-bottom: 2px solid #2854C5;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-body {
            font-size: 1rem;
            color: #333;
        }

        .card-body label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .card-body input,
        .card-body select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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

        .btn-secondary {
            background-color: #508D4E;
        }

        .btn-secondary:hover {
            background-color: #80AF81;
            text-decoration: none;
        }
    </style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Update Shipping Status for Order #<?php echo e($order->id); ?>

        </div>
        <div class="card-body">
            <form action="<?php echo e(route('orders.updateShippingStatus', $order->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <label for="shipping_status">Shipping Status:</label>
                <select id="shipping_status" name="shipping_status" required>
                    <option value="new" <?php echo e($order->shipping_status == 'new' ? 'selected' : ''); ?>>New</option>
                    <option value="delivered" <?php echo e($order->shipping_status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                    <option value="complete" <?php echo e($order->shipping_status == 'complete' ? 'selected' : ''); ?>>Complete</option>
                    <option value="canceled" <?php echo e($order->shipping_status == 'canceled' ? 'selected' : ''); ?>>Canceled</option>
                </select>

                <div class="actions">
                    <button type="submit" class="btn btn-secondary">
                        Update Shipping Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Edit Order #<?php echo e($order->id); ?>

        </div>
        <div class="card-body">
            <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo e($order->fullname); ?>" required>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo e($order->phone_number); ?>" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo e($order->location); ?>" required>

                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo e($order->postal_code); ?>" >

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e($order->email); ?>" required>

                <label for="status_of_payment">Payment Status:</label>
                <select id="status_of_payment" name="status_of_payment" required>
                    <option value="bank" <?php echo e($order->status_of_payment == 'bank' ? 'selected' : ''); ?>>Bank</option>
                    <option value="cash" <?php echo e($order->status_of_payment == 'cash' ? 'selected' : ''); ?>>Cash</option>
                    <option value="pickup" <?php echo e($order->status_of_payment == 'pickup' ? 'selected' : ''); ?>>Pickup</option>
                </select>

                <label for="status">Order Status:</label>
                <select id="status" name="status" required>
                    <option value="paid" <?php echo e($order->status == 'paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="unpaid" <?php echo e($order->status == 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                </select>

                <div class="actions">
                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-info">
                        Back to List
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
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
<?php endif; ?>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/orders/edit.blade.php ENDPATH**/ ?>