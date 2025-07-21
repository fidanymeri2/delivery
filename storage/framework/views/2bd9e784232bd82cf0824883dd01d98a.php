<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermal Print Invoice</title>
    <style>
        body {
margin: 0 20px;
padding: 0;
            font-size: 10px;
            width: 80mm;
            font-family: 'Times New Roman', serif;
        }

        .ticket {
            width: 100%;
            max-width: 80mm;
            margin: 0 auto;
        }

        .centered {
            text-align: center;
            margin-bottom: 5px;
        }
        .ordertotal{
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-top: 5px;
        }

        th, td {
            padding: 2px;
            border: 1px solid black;
            text-align: left;
        }

        th.quantity, td.quantity {
            width: 20%;
        }

        th.description, td.description {
            width: 60%;
        }

        th.price, td.price {
            width: 20%;
        }

        @media print {
body {
padding:0px; 15px;
                width: 80mm;
                height: auto;
            }

            .hidden-print {
                display: none;
            }

            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <p class="centered">#<?php echo e($order->id); ?>

            <br>For: <?php echo e($order->fullname); ?>

            <br>Phone: <?php echo e($order->phone_number); ?>

            <br>Location: <?php echo e($order->location); ?>

            <br>Postal Code: <?php echo e($order->postal_code); ?>

            <br>Payment Method: <?php echo e($order->status_of_payment); ?>

            <br>Status: <?php echo e($order->status); ?>

        </p>
        <table>
            <thead>
                <tr>
                    <th class="quantity">Qty</th>
                    <th class="description">Item</th>
                    <th class="price">Price</th>
                    <th class="price">Total</th>
                </tr>
            </thead>
            <tbody>
                   <?php
                            $orderTotal = 0;
                        ?>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $itemTotal = $item->price_sell * $item->quantity;
                                $optionTotal = 0;
                            ?>
                            <tr>
                                <td><?php echo e($item->product->name); ?></td>
                                <td><?php echo e(number_format($item->price_sell, 2)); ?> €</td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(number_format($itemTotal, 2)); ?> €</td>
                                <tr>
                                    <?php if(count($item->options)): ?><td style="font-size:12px;" colspan=4><b>Option Items</b></td><?php endif; ?>
                                    <?php $__currentLoopData = $item->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $optionTotal  += $option->quantity * $option->price_sell;
                                    ?>
                                    <tr>
                                        <td style="font-size:11px;"><?php echo e($option->name); ?></td>
                                        <td style="font-size:11px;"><?php echo e(number_format($option->price_sell, 2)); ?> €</td>
                                        <td style="font-size:11px;"><?php echo e($option->quantity); ?></td>
                                        <td style="font-size:11px;"><?php echo e(number_format($option->quantity * $option->price_sell, 2)); ?> €</td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="background:lightblue;" colspan=4> </td>
                                    </tr>
                                </tr>
                            </tr>
                            <?php 
                                $orderTotal += $itemTotal + $optionTotal;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="3" class="description ordertotal"><strong>Order Total:</strong></td>
                    <td class="price"><strong>$<?php echo e(number_format($orderTotal, 2)); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Thanks for your purchase!
            <br>YUMIIS.de</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
    document.getElementById('btnPrint').addEventListener('click', function(e) {
        e.preventDefault();
        window.print();
    });
    </script>
</body>
</html>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/orders/invoice.blade.php ENDPATH**/ ?>