<!-- resources/views/orders/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2854C5;
            color: white;
        }
        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1><?php echo e(__('delivery_stats.title')); ?></h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('delivery_stats.order_id')); ?></th>
                <th><?php echo e(__('delivery_stats.delivery_user')); ?></th>
                <th><?php echo e(__('delivery_stats.status')); ?></th>
                <th><?php echo e(__('delivery_stats.date')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $filteredOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($order->id); ?></td>
                    <td><?php echo e(optional($order->deliveryUser)->name ?? __('delivery_stats.not_assigned')); ?></td>
                    <td><?php echo e($order->shipping_status); ?></td>
                    <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/orders/pdf.blade.php ENDPATH**/ ?>