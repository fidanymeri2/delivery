<!DOCTYPE html>
<html>
<head>
    <title>Orders from <?php echo e($startDate); ?> to <?php echo e($endDate); ?></title>
    <style>
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
            background-color: #f2f2f2; 
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #800000; 
        }

        th {
            background-color: #800000; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child {
            border-bottom: 3px solid #800000; 
        }

        .timestamp {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #666;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px; 
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
                <th>Order Code</th>
<th><?php echo e(isset($group[0]) ? $group[0] == 'w' ? 'Waiter' : 'Delivery' : 'Waiter'); ?></th>
                <th>Items</th>
                <th>Date</th>
                <th>Status</th>
                <th>Tip</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
<?php 
$total = 0;
$tipTotal = 0;
?>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php
$subtotal = $order->items->sum('price_sell') + $order->itemOptions->sum('price_sell');
$tip = $order->tip;
if($order->shipping_status != 'canceled'){
$total += $subtotal;
$tipTotal += $tip;

}
?>
            <tr>
                <td><?php echo e($order->order_code); ?></td>
                <td><?php echo e($order->waiter->name); ?></td>
                <td>
<?php echo e(count($order->items)); ?>

</td> 
<td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
<td>
                            <?php if($order->shipping_status == 'new'): ?> New
                            <?php elseif($order->shipping_status == 'delivered'): ?> On the way
                            <?php elseif($order->shipping_status == 'complete'): ?> Delivered
                            <?php elseif($order->shipping_status == 'canceled'): ?> Canceled
                            <?php else: ?> Unknown
                            <?php endif; ?>
                        </td>
                        
                <td><?php echo e(number_format($tip, 2)); ?> €</td>
                <td><?php echo e(number_format($subtotal, 2)); ?> €</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4">No orders found.</td>
            </tr>
            <?php endif; ?>
</tbody><tfoot>
    <tr>
<td colspan="5"></td>
<td><?php echo e(number_format($tipTotal, 2)); ?> €</td>
<td><?php echo e(number_format($total, 2)); ?> €</td>
    </tr>
</tfoot>
    </table>
</body>
</html>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/pdf/date_range_orders.blade.php ENDPATH**/ ?>