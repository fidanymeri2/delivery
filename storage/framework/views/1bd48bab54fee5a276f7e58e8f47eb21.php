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
ul{
List-style:none;margin:0;padding:0 5px;
}
    </style>
</head>
<body> 
<?php $logo = App\Models\Message::where('category',"LOGO")->first(); ?>
<div class="ticket">
        <p class="centered">
<img src="/public/storage/<?php echo e($logo->description); ?>" width="120" /><br/>
            #<?php echo e($order->order_code); ?>

            <br>For: <?php echo e($order->firstName); ?> <?php echo e($order->lastName); ?>

            <br>Phone: <?php echo e($order->phone_number); ?>

            <br>Location: <?php echo e($order->location); ?>

            <br>Postal Code: <?php echo e($order->postal_code); ?>

            <br>Payment Method: <?php echo e($order->status_of_payment); ?>

            <br>Description: <?php echo e($order->description); ?>

        </p>
        <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
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
                                <td><?php echo e($item->product->name); ?> <?php echo e($item->selectedLabel); ?></td>
                                <td><?php echo e(number_format($item->price_sell, 2)); ?> €</td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(number_format($itemTotal, 2)); ?> €</td>
<tr>
                                        <?php if($item->special_instruction): ?> <td colspan="4">** <?php echo e($item->special_instruction); ?></td><?php endif; ?>

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
<td colspan="4">
<?php
$menu = $item->menu ? (object) json_decode($item->menu,true) : null;
$optionals = $item->optionals ? (object) json_decode($item->optionals,true) : null;
?>
<?php if($optionals): ?>
<ul class="menu">

            <?php $__currentLoopData = $optionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$option = (object) $option;
?>
<?php if($option->checked): ?>
<li><span>&#10003;</span>  <?php echo e($option->name); ?><li><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
    </ul>
          <?php endif; ?>

<ul class="menu">
<?php if($menu): ?> 
<?php $__currentLoopData = $menu->itemsTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$item = (object) $item;
?> 
<?php echo $__env->make('orders.menu', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
    </ul>

<?php
$feMax =0;
$fee = \App\Models\ShippingFee::where('postal_code',$order->postal_code)->first();
if($fee)
{
$feMax = $fee->fee;
}
?>
</td>
                                </tr>
                                    <tr>
                                        <td style="background:lightblue;" colspan=4>
                                            
                                            
                                         </td>
                                    </tr>
                                </tr>
                            </tr>
                            <?php 
                                $orderTotal += $itemTotal + $optionTotal;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Order SubTotal:</strong></td>
                            <td><strong><?php echo e(number_format($orderTotal, 2)); ?> €</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Tip:</strong></td>
                            <td><strong><?php echo e(number_format($order->tip, 2)); ?> €</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Shipping Feee:</strong></td>
                            <td><strong><?php echo e(number_format($feMax, 2)); ?> €</strong></td>
                        </tr>
                        
                         <tr>
                            <td colspan="3" style="text-align: right;"><strong>Order Total:</strong></td>
                            <td><strong><?php echo e(number_format($orderTotal + $order->tip + $feMax, 2)); ?> €</strong></td>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/orders/invoice.blade.php ENDPATH**/ ?>