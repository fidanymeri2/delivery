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

        .card-body dl {
            margin: 0;
            padding: 0;
        }

        .card-body dt {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-body dd {
            margin: 0 0 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
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
.menu li{
    margin-left:12px;
    margin-top:10px;
}
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Order #<?php echo e($order->order_code); ?> / <?php if($order->paypal_id): ?> PayPal Id <?php echo e($order->paypal_id); ?> <?php endif; ?>
            </div>
            <div class="card-body">
                <dl>
                    <dt>First Name:</dt>
                    <dd><?php echo e($order->firstName); ?></dd>
                    <dt>Last Name:</dt>
                    <dd><?php echo e($order->lastName); ?></dd>
                    <dt>Phone NR:</dt>
                    <dd><?php echo e($order->phone_number); ?></dd>

                    <dt>Location:</dt>
                    <dd><?php echo e($order->location); ?></dd>

                    <dt>Postal Code:</dt>
                    <dd><?php echo e($order->postal_code); ?></dd>
                    
<?php if($order->lastName != 'local'): ?>

                    <dt>Reorder with Phone Number:</dt>
                    <dd><?php echo e(\App\Models\Order::where('phone_number',$order->phone_number)->where('id','!=',$order->id)->count()); ?></dd>
                    <dt>Reorder with E-mail:</dt>
                    <dd><?php echo e(\App\Models\Order::where('email',$order->email)->where('id','!=',$order->id)->count()); ?></dd>
<?php endif; ?>
                    <dt>Waiter</dt>
                    <dd><?php echo e(\App\Models\Waiter::where('id',$order->waiterId)->withTrashed()->first()->name); ?></dd>
                    <dt>Email:</dt>
                    <dd><?php echo e($order->email); ?></dd>
                    <dt>Status:</dt>
                    <dd><?php echo e($order->status_of_payment); ?></dd>
                    
                    <dt>Description:</dt>
                    <dd>** <?php echo e($order->description); ?></dd>
                </dl>

                <div class="card-header">
                    Order Items
                </div>

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
      
    </ul><hr/>
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
$feMax = 0;

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

           
    <br/><br/>
                <div class="actions">
                <a href="javascript:history.back()" class="btn btn-info">
    Back to Orders
</a>

                    <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-primary">
                        Edit Order
                    </a>
                </div>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/orders/show.blade.php ENDPATH**/ ?>