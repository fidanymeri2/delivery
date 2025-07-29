<?php
$item = (object) ($item);
?>
<?php if($item->checked): ?>
<li>
<label><span>&#10003;</span> <?php echo e($item->name); ?> </label>
        <ul >
        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('orders.menu', ['item' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    
</li>
<?php endif; ?><?php /**PATH C:\laragon\www\delivery\resources\views/orders/menu.blade.php ENDPATH**/ ?>