<?php
$item = (object) ($item);
?>
<?php if($item->checked): ?>
<li>
<label><span>&#10003;</span> <?php echo e($item->name); ?> </label>
        <ul >
        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('orders.menu', ['item' => $child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    
</li>
<?php endif; ?><?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/orders/menu.blade.php ENDPATH**/ ?>