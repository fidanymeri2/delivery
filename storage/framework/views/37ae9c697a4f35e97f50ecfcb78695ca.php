<!DOCTYPE html>
<html>
<head>
    <title>Orders from <?php echo e($startDate); ?> to <?php echo e($endDate); ?></title>
    <style>
        /* Add some padding and margin to the table elements */
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f2f2f2; /* Add a subtle background color */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #800000; /* Change border color to dark red */
        }

        th {
            background-color: #800000; /* Header row background color */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child {
            border-bottom: 3px solid #800000; /* Make the last row more prominent with dark red */
        }

        .timestamp {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #666; /* Change the timestamp color to a slightly darker grey */
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px; /* Adjust size as needed */
        }
    </style>
</head>
<body>
    <img src="assets/yumiis-logo.png" alt="Company Logo" class="logo">

    <h1>Orders from <?php echo e($startDate); ?> to <?php echo e($endDate); ?></h1>

    <p class="timestamp">Report generated on: <?php echo e(now()->timezone('Europe/Berlin')->format('Y-m-d H:i')); ?></p>

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
                        <?php echo e($item->product->name); ?> (<?php echo e($item->quantity); ?>)<br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>$<?php echo e(number_format($order->items->sum('price_sell'), 2)); ?></td>
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
<?php /**PATH C:\laragon\www\devi-back\resources\views/pdf/date_range_orders.blade.php ENDPATH**/ ?>