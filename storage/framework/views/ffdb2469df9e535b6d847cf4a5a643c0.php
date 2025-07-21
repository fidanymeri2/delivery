<!DOCTYPE html>
<html>
<head>
    <title>Daily Orders - <?php echo e($date); ?></title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>Orders for <?php echo e($date); ?></h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($order->id); ?></td>
                <td><?php echo e($order->fullname); ?></td>
                <td>
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($item->product_id); ?> (<?php echo e($item->quantity); ?>)<br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>$<?php echo e($order->items->sum('price_sell')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4">No orders found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/pdf/daily_orders.blade.php ENDPATH**/ ?>