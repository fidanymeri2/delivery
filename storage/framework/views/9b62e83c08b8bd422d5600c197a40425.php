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
.menu-items{width:20px;
    
}
.inp{
    height:25px;
    
}
.tree,
.tree ul {
  margin:0 0 0 1em; /* indentation */
  padding:0;
  list-style:none;
  color:#369;
  position:relative;
}

.tree ul {margin-left:.5em} /* (indentation/2) */

.tree:before,
.tree ul:before {
  content:"";
  display:block;
  width:0;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  border-left:1px solid;
}

.tree li {
  margin:0;
  padding:0 2em; /* indentation + .5em */
  line-height:2em; /* default list item's `line-height` */
  font-weight:bold;
  position:relative;
}

.tree li:before {
  content:"";
  display:block;
  width:25px; /* same with indentation */
  height:0;
  border-top:1px solid;
  margin-top:-1px; /* border top width */
  position:absolute;
  top:1em; /* (line-height/2) */
  left:0;
}

.tree li:last-child:before {
  background:white; /* same with body background */
  height:auto;
  top:1em; /* (line-height/2) */
  bottom:0;
}
.plus{
Background-color:#ddd;padding:3px 10px;
border-radius:25px;
}
.row{
Display:flex;gap:25px;
}
</style>
<form action="<?php echo e(route('menu.storeEdit')); ?>" method="POST">
                    <input type="hidden"  name="menu_id" value="<?php echo e(request()->id); ?>" required>

<?php echo csrf_field(); ?>
<?php
$product = \App\Models\Product::where('id',$menu->product_id )->first();

$productOption = \App\Models\ProductSize::select("description_categories.*")->where('product_id',$menu->product_id  )->join('description_categories',"description_categories.id","=","product_sizes.dimensions")->get();
?>
<h1 style="font-size:26px; font-weight:bold;"><a href="<?php echo e(route('products.edit',$menu->product_id)); ?>">❮</a> <?php echo e($product->name); ?><h1><br/>

<div class="row">       <!-- Menu name -->

<?php $__currentLoopData = $productOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php

$price = \App\Models\MenuPrice::where("menu_id",request()->id)->where("desc_id",$desc->id)->first();
?>
<div class="col-md-4">
            <label for="<?php echo e($desc->id); ?>">Price <?php echo e($desc->name); ?> </label>
            <input type="number" step="any"  id="<?php echo e($desc->id); ?>" name="price[<?php echo e($desc->id); ?>]" value="<?php echo e(number_format($price ? $price->price : 0,2)); ?>" required>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
</div>
        <hr>

        <!-- Menu Items --><br/>
<h2>Menu Items <button type="button" class="plus" onclick="addMenuItem()">&#43;</button></h2>
        <ul class="tree" id="menu-items">
            <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('menu.menu-item', ['item' => $item, 'parentIndices' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <!-- Add new menu item -->
        

        <!-- Submit --><br/><br/>
        <button type="submit">Save Menu</button>
    </form>

<script> 
let itemIndex = <?php echo e($menu->items->count()); ?>; // Continue counting from existing items

function addMenuItem(parentIndices = []) {
    const newIndex = itemIndex++;
    const parentPath = parentIndices.length ? `[${parentIndices.join('][')}]` : '';
    const container = parentIndices.length ? `nested-items-${parentIndices.join('-')}` : 'menu-items';
    // Create the new item HTML
    const newItem = `
        <li id="menu-item-${[...parentIndices, newIndex].join('-')}">
            <div style='display:flex;gap:25px;'>
                <div>
                    <label for="items${parentPath}[${newIndex}][name]">Item Name:</label><br/>
                    <input class="inp" type="text" name="items${parentPath}[${newIndex}][name]" required>
                </div>
                <div class="sc"></div>
                <div><br/>          
                    <button type="button" onclick="addMenuItem([${[...parentIndices, newIndex].join(',')}]), addExToParent([${[...parentIndices, newIndex].join(',')}],'${parentPath}[${newIndex}]')">Add Option</button> | 
                    <button type="button" class="remove-button" onclick="removeMenuItem('${[...parentIndices, newIndex].join('-')}')">Remove</button>
                </div>
            </div>
            <ul id="nested-items-${[...parentIndices, newIndex].join('-')}"></ul>
        </li>
    `;

    // Insert the new item into the appropriate container
    document.getElementById(container).insertAdjacentHTML('beforeend', newItem);
}

function removeMenuItem(itemId) {
    const item = document.getElementById(`menu-item-${itemId}`);
    if (item) {
        item.remove();
    }
} 

function addExToParent(parentIndices,name) {
    const parentPath = parentIndices.length ? `[${parentIndices.join('][')}]` : '';
    const parentId = `menu-item-${parentIndices.join('-')}`;
    const parentElement = document.getElementById(parentId);
    
    // Ensure parent element exists
    if (parentElement) {
        // Check if the additional input already exists
        if (!parentElement.querySelector('.select')) {
            const exText = `
                <div class="select">
                    <label for="items${name}[select]">Select:</label><br/>
                    <input class="inp" type="number" value="1" name="items${name}[select]">
                </div>
            `;

            // Append the new input
            parentElement.querySelector('.sc').insertAdjacentHTML('beforeend', exText);
        }
    }
}


</script>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/menu/edit.blade.php ENDPATH**/ ?>