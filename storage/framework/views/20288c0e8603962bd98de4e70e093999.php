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

        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin: 1rem;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        input, select, textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #2854C5;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #1e3a8a;
        }
        .active-status {
            color: green;
        }
        .inactive-status {
            color: red;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-grid label {
            margin-bottom: 0.25rem;
        }

        .form-grid input, .form-grid select, .form-grid textarea {
            width: 100%;
        }

        .form-grid textarea {
            grid-column: span 2;
        }

        .form-grid .full-width {
            grid-column: span 2;
        }

        /* Custom Checkbox Styles */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            display: none;
        }

        .checkbox-wrapper label {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-wrapper label::before {
            content: '';
            display: inline-block;
            width: 34px;
            height: 20px;
            background-color: #ddd;
            border-radius: 50px;
            position: relative;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .checkbox-wrapper label::after {
            content: '';
            display: block;
            width: 16px;
            height: 16px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::before {
            background-color: #2854C5;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::after {
            transform: translateX(14px);
        }

        .size-entry {
            position: relative;
        }

        .remove-size {
            position: absolute;
            top: 0;
            right: 0;
            background: #ff5c5c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
        }

        .remove-size:hover {
            background: #e04b4b;
        }
        .go-back-button {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 1rem;
            text-decoration: none;
            display: inline-block;
        }

        .go-back-button:hover {
            background-color: #e0e0e0;
        }
        .extra-products-section {
            margin-top: 20px;
        }

        .extra-products-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .extra-products-section input[type="checkbox"] {
            margin-right: 10px;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
<?php 
$checkIfHasMenu  = \App\Models\Menu::where('product_id',$product->id)->first();

?>
<div class="form-container">
<h1>Edit Product  <?php if($checkIfHasMenu): ?> <button type="button"><a href="<?php echo e(route('menu.edit',$checkIfHasMenu->id)); ?>">View Menu</a></button>  <?php else: ?> <button type="button"><a href="<?php echo e(route('menu.create',$product->id)); ?>">Create Menu</a></button> <?php endif; ?></h1>



        <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
        <div>
            <label for="category_id">Category:</label>
            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="category_id" id="category_id" required>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="name">Name:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" id="name" value="<?php echo e(old('name', $product->name)); ?>" required>
        </div>
  <div>
            <label for="allergies">Allergies:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="allergies" id="allergies" value="<?php echo e(old('allergies', $product->allergies)); ?>" >
</div>
  <div>
            <label for="product_code">Product Code:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="product_code" id="product_code" value="<?php echo e(old('product_code', $product->product_code)); ?>" required>
        </div>
        
        <div class="full-width">
            <label for="description">Description:</label>
            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="description" id="description"><?php echo e(old('description', $product->description)); ?></textarea>
        </div>

        <div>
            <label for="image">Current Image:</label>
            <?php if($product->image): ?>
                <img src="<?php echo e(asset($product->image)); ?>" alt="Current Image" style="max-width: 100%; height: auto; margin-bottom: 1rem;">
            <?php endif; ?>
            <label for="image">Replace Image:</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="new_product" id="new_product" value="1" <?php echo e(old('new_product', $product->new_product) ? 'checked' : ''); ?>>
        <label for="new_product">New Product</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="new_offers" id="new_offers" value="1" <?php echo e(old('new_offers', $product->new_offers) ? 'checked' : ''); ?>>
        <label for="new_offers">New Offers</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="suggested" id="suggested" value="1" <?php echo e(old('suggested', $product->suggested) ? 'checked' : ''); ?>>
        <label for="suggested">Suggested</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="isMenu" id="isMenu" value="1" <?php echo e(old('isMenu', $product->isMenu) ? 'checked' : ''); ?>>
        <label for="isMenu">Menu</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="status" id="status" value="1" <?php echo e(old('status', $product->status) ? 'checked' : ''); ?>>
        <label for="status">Status</label>
    </div>
    <div class="status-text" style="color: <?php echo e($product->status == 1 ? 'green' : 'red'); ?>;">
        <?php echo e($product->status == 1 ? 'Product is Active' : 'Product is Inactive'); ?>

    </div>
</div>




<input type="hidden" id="deleted-options" name="deleted_options" value="">


    </div>

    <div id="sizes-container">

    <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="grid grid-cols-2 gap-4 size-entry" data-index="<?php echo e($index); ?>">

        <div  >
      
            <label for="price-<?php echo e($index); ?>">Price:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[<?php echo e($index); ?>][price]" id="price-<?php echo e($index); ?>" value="<?php echo e($size->price); ?>" step="0.01" required></div>
                    <div >

            <label for="dimensions-<?php echo e($index); ?>" class="block">Description:</label>
<select   name="sizes[<?php echo e($index); ?>][dimensions]" id="dimensions-<?php echo e($index); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option <?php if($size->dimensions == $de->id): ?> selected <?php endif; ?> value="<?php echo e($de->id); ?>"><?php echo e($de->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</select>

         
                        <button type="button" class="remove-size">Remove</button>

            </div>
            </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button type="button" id="add-size-button">Add Another Size</button>



<br/><br/>
<?php
    $options = App\Models\ProductOptionOptional::where('product_id', $product->id)->get();
    $opts = App\Models\ProductSize::select('description_categories.*')->where('product_id', $product->id)->leftJoin('description_categories','description_categories.id','=','product_sizes.dimensions')->get();

?>
<div id="inputs-container">
<label>Option Max Select</label>
    <input type="text" name="max_checked" value="<?php echo e($product->max_checked); ?>" class="form-control" placeholder="Option Max Select"><br/><br/>
    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="input-group mb-3" style="display:flex;gap:5px;">
            <input type="text" name="options[<?php echo e($index); ?>][name]" value="<?php echo e($option->name); ?>" class="form-control" placeholder="Option Name">
<input type="hidden" name="options[<?php echo e($index); ?>][id]" value="<?php echo e($option->id); ?>">
<select name="options[<?php echo e($index); ?>][desc_id]">
<?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option <?php if($option->desc_id ==  $opt->id): ?> selected <?php endif; ?>  value="<?php echo e($opt->id); ?>"><?php echo e($opt->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                       
            <button class="btn btn-danger remove-input">Remove</button>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<button id="add-input-btn">Add New Product Option</button>
    <div class="extra-products-section">
    <h3>Extra Products by Category</h3>

    <?php
        $categories = \App\Models\ExtraCategory::with('extraProducts')->get();
    ?>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h4><?php echo e($category->name); ?></h4>
          <div class="select-all">
            <input type="checkbox" id="select_all_<?php echo e($category->id); ?>" class="select-all-checkbox">
            <label for="select_all_<?php echo e($category->id); ?>">Select All</label>
        </div>
        <div class="table-responsive text-center">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
<?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<th>Price - <?php echo e($de->name); ?></th>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

<th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $category->extraProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($extraProduct->name); ?></td>
                                                        <?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $deprice = \App\Models\ExtraProductPrice::where('desc_id',$de->id)->where('extra_product_id',$extraProduct->id)->first(); ?>
                            <td><?php echo e(number_format($deprice->price,2)); ?> € </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <td>
                                <input type="checkbox" name="extra_products[]" value="<?php echo e($extraProduct->id); ?>" id="extra_product_<?php echo e($category->id); ?>_<?php echo e($extraProduct->id); ?>"
                                    <?php echo e(in_array($extraProduct->id, $product->extraProducts->pluck('id')->toArray()) ? 'checked' : ''); ?>>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



    <button type="submit">Update Product</button>
    <a href="<?php echo e(route('products.index')); ?>" class="go-back-button">Go Back</a>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>

$(document).ready(function() {
    let inputCount = <?php echo e($options->count()); ?>;
            var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";
            var opts = "<?php foreach($opts as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

    $('#add-input-btn').click(function(e) {
        e.preventDefault();

        inputCount++;
        let newInput = `<div class="input-group  mb-3" style="display:flex;gap:5px;">
<input type="text" name="options[${inputCount}][name]" class="form-control" placeholder="Option Name">
    
<select name="options[${inputCount}][desc_id]">${opts}</select>
                            <button class="btn btn-danger remove-input">Remove</button>
                        </div>`;
        $('#inputs-container').append(newInput);
    });

    // Remove input field
      $(document).on('click', '.remove-input', function(e) {
        e.preventDefault();
        let inputGroup = $(this).closest('.input-group');
        let optionId = inputGroup.find('input[name*="[id]"]').val();

        if (optionId) {
            let deletedOptions = $('#deleted-options').val();
            $('#deleted-options').val(deletedOptions + optionId + ',');
        }

        inputGroup.remove();
    });
});
            var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

            document.addEventListener('DOMContentLoaded', function() {
                let index = <?php echo e(count($product->sizes)); ?>; 
                const sizesContainer = document.getElementById('sizes-container');
                const addSizeButton = document.getElementById('add-size-button');

                addSizeButton.addEventListener('click', function() {
                    // Create a new size entry
                    const newSizeEntry = document.createElement('div');
                    newSizeEntry.classList.add('size-entry');
                    newSizeEntry.classList.add('grid');
                    newSizeEntry.classList.add('grid-cols-2');
                    newSizeEntry.classList.add('gap-4');
                    newSizeEntry.setAttribute('data-index', index);

                    newSizeEntry.innerHTML = `
                      <div
                        <label for="price-${index}">Price:</label>
                        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[${index}][price]" id="price-${index}" step="0.01" required></div>

                <div>
                    <label for="dimensions-${index}" class="block">Description </label>
                            <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                ${options}
                            </select>
                    
                        <button type="button" class="remove-size">Remove</button></div>
                    `;

                    sizesContainer.appendChild(newSizeEntry);
                    index++;
                });

                sizesContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-size')) {
                        const sizeEntry = event.target.closest('.size-entry');
                        sizesContainer.removeChild(sizeEntry);
                    }
                });
            });
            
            
        document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to each "Select All" checkbox
    document.querySelectorAll('.select-all-checkbox').forEach(selectAllCheckbox => {
        selectAllCheckbox.addEventListener('change', function () {
            // Get the category ID from the checkbox ID
            const categoryId = this.id.split('_').pop();

            // Select or deselect all checkboxes in the table rows under this category
            document.querySelectorAll(`input[type="checkbox"][id^="extra_product_${categoryId}_"]`).forEach(productCheckbox => {
                productCheckbox.checked = this.checked;
            });
        });
    });
});

        </script>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const img = new Image();

        // Check file size (not more than 1MB)
        const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
        if (file.size > maxSizeInBytes) {
            alert('The uploaded image must not exceed 1MB.');
            event.target.value = ''; // Reset the file input
            return;
        }

        img.onload = function() {
            const width = img.width;
            const height = img.height;

            // Check for specific resolution range
            if (width < 800 || width > 1000 || height < 800 || height > 1000) {
                alert('The image resolution must be between 800x800 and 1000x1000 pixels.');
                event.target.value = ''; // Reset the file input
            }
        };

        if (file) {
            img.src = URL.createObjectURL(file);
        }
    });
</script>



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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/products/edit.blade.php ENDPATH**/ ?>