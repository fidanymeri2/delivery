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

    <div class="form-container">
        <h1>Edit Product</h1>

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
        <input type="checkbox" name="status" id="status" value="1" <?php echo e(old('status', $product->status) ? 'checked' : ''); ?>>
        <label for="status">Status</label>
    </div>
    <div class="status-text" style="color: <?php echo e($product->status == 1 ? 'green' : 'red'); ?>;">
        <?php echo e($product->status == 1 ? 'Product is Active' : 'Product is Inactive'); ?>

    </div>
</div>


    </div>

    <div id="sizes-container">
    <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="size-entry" data-index="<?php echo e($index); ?>">
            <label for="size-<?php echo e($index); ?>">Size:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="sizes[<?php echo e($index); ?>][size]" id="size-<?php echo e($index); ?>" value="<?php echo e($size->size); ?>">

            <label for="price-<?php echo e($index); ?>">Price:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[<?php echo e($index); ?>][price]" id="price-<?php echo e($index); ?>" value="<?php echo e($size->price); ?>" step="0.01" required>

            <label for="dimensions-<?php echo e($index); ?>">Dimensions (optional):</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="sizes[<?php echo e($index); ?>][dimensions]" id="dimensions-<?php echo e($index); ?>" value="<?php echo e($size->dimensions); ?>">

            <button type="button" class="remove-size">Remove</button>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button type="button" id="add-size-button">Add Another Size</button>

    <div class="extra-products-section">
    <h3>Extra Products by Category</h3>

    <?php
        $categories = \App\Models\ExtraCategory::with('extraProducts')->get();
    ?>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h4><?php echo e($category->name); ?></h4>
        <div class="table-responsive text-center">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $category->extraProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($extraProduct->name); ?></td>
                            <td><?php echo e($extraProduct->price); ?> EUR</td>
                            <td>
                                <input type="checkbox" name="extra_products[]" value="<?php echo e($extraProduct->id); ?>" id="extra-product-<?php echo e($extraProduct->id); ?>"
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


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let index = <?php echo e(count($product->sizes)); ?>; 
                const sizesContainer = document.getElementById('sizes-container');
                const addSizeButton = document.getElementById('add-size-button');

                addSizeButton.addEventListener('click', function() {
                    // Create a new size entry
                    const newSizeEntry = document.createElement('div');
                    newSizeEntry.classList.add('size-entry');
                    newSizeEntry.setAttribute('data-index', index);

                    newSizeEntry.innerHTML = `
                        <label for="size-${index}">Size:</label>
                        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="sizes[${index}][size]" id="size-${index}" required>

                        <label for="price-${index}">Price:</label>
                        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[${index}][price]" id="price-${index}" step="0.01" required>

                        <label for="dimensions-${index}">Dimensions (optional):</label>
                        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="sizes[${index}][dimensions]" id="dimensions-${index}">

                        <button type="button" class="remove-size">Remove</button>
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
<?php /**PATH C:\laragon\www\devi-back\resources\views/products/edit.blade.php ENDPATH**/ ?>