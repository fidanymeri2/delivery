<li id="menu-item-<?php echo e(implode('-', array_merge($parentIndices, [$item->id]))); ?>">
    <div style='display:flex;gap:25px;'>
        <div>
            <label for="items[<?php echo e(implode('][', array_merge($parentIndices, [$item->id]))); ?>][name]">Item Name:</label><br/>
            <input class="inp" type="text" name="items[<?php echo e(implode('][', array_merge($parentIndices, [$item->id]))); ?>][name]" value="<?php echo e(old('items.'.implode('.', array_merge($parentIndices, [$item->id])).'.name', $item->item_name)); ?>" required>
</div>

        <div class="sc">
             <?php if($item->item_select): ?>
                <div class="select">
                    <label for="items[<?php echo e(implode('][', array_merge($parentIndices, [$item->id]))); ?>][select]">Select:</label><br/>
                    <input class="inp" type="text" name="items[<?php echo e(implode('][', array_merge($parentIndices, [$item->id]))); ?>][select]" value="<?php echo e(old('items.'.implode('.', array_merge($parentIndices, [$item->id])).'.select', $item->item_select)); ?>">
                </div>
            <?php endif; ?>
        </div>

        <div><br/>
            <button type="button" onclick="addMenuItem([<?php echo e(implode(',', array_merge($parentIndices, [$item->id]))); ?>]), addExToParent([<?php echo e(implode(',', array_merge($parentIndices, [$item->id]))); ?>])">Add Option</button> | 
            <button type="button" class="remove-button" onclick="removeMenuItem('<?php echo e(implode('-', array_merge($parentIndices, [$item->id]))); ?>')">Remove</button>
        </div>
    </div>
    <ul id="nested-items-<?php echo e(implode('-', array_merge($parentIndices, [$item->id]))); ?>">
        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('menu.menu-item', ['item' => $child, 'parentIndices' => array_merge($parentIndices, [$item->id])], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li><?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/menu/menu-item.blade.php ENDPATH**/ ?>