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
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-grid input,
        .form-grid select,
        .form-grid textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-grid textarea {
            height: 100px;
        }

        .form-grid .full-width {
            grid-column: span 2;
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
            padding-left: 40px;
        }

        .checkbox-wrapper label::before {
            content: '';
            display: inline-block;
            width: 34px;
            height: 20px;
            background-color: #ddd;
            border-radius: 50px;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: background-color 0.3s;
        }

        .checkbox-wrapper label::after {
            content: '';
            display: block;
            width: 16px;
            height: 16px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 2px;
            transform: translateY(-50%);
            transition: transform 0.3s;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::before {
            background-color: #2854C5;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::after {
            transform: translateX(14px) translateY(-50%);
        }
        .extra-products-section {
    padding: 20px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Creates a 3-column grid */
    gap: 20px; /* Space between items */
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    background-color: #f9f9f9;
}

.product-card h4 {
    margin-top: 0;
    font-size: 1.2em;
}

.product-card p {
    font-size: 1em;
    margin: 10px 0;
}

.product-card input[type="checkbox"] {
    margin-right: 5px;
}

.product-card label {
    font-size: 0.9em;
}

.select-all {
    margin-bottom: 10px;
}

.select-all input[type="checkbox"] {
    margin-right: 5px;
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
        <h1>Create Product</h1>

        <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data" >
            <?php echo csrf_field(); ?>

            <div class="form-grid">
                <div>
                    <label for="category_id">Category:</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="category_id" id="category_id" required>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="name">Name:</label>
                    <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" id="name" required>
                </div>

                <div class="full-width">
                    <label for="description">Description:</label>
                    <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="description" id="description"></textarea>
                </div>
                <div>
                    <label for="allergies">Allergies:</label>
                    <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="allergies" id="allergies" required>
                </div>

                <div>
    <label for="image">Image:</label>
    <input type="file" name="image" id="image">
</div>

                <div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="new_product" value="0">
        <input type="checkbox" name="new_product" id="new_product" value="1">
        <label for="new_product">New Product</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="new_offers" value="0">
        <input type="checkbox" name="new_offers" id="new_offers" value="1">
        <label for="new_offers">New Offers</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="suggested" value="0">
        <input type="checkbox" name="suggested" id="suggested" value="1">
        <label for="suggested">Suggested</label>
    </div>
</div>

            </div>

            <div id="sizes-container" class="mt-4">
    <div class="grid grid-cols-2 gap-4 size-entry" data-index="0">
        <div>
            <label for="price-0" class="block">Price:</label>
            <input type="number" name="sizes[0][price]" step="any" id="price-0" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="dimensions-0" class="block">Description:</label>
<select  name="sizes[0][dimensions]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($de->id); ?>"><?php echo e($de->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</select>
        </div>
    </div>
</div>


            <button type="button" id="add-size-button">Add Another Size</button> <br>

       


            <button type="submit">Create Product</button>
        </form>

<script>

    var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";
        
        document.addEventListener('DOMContentLoaded', function() {
            let index = 1; // Start with index 1 since index 0 is already in the form
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeButton = document.getElementById('add-size-button');

            addSizeButton.addEventListener('click', function() {
                // Create a new size entry
                const newSizeEntry = document.createElement('div');
                newSizeEntry.classList.add('grid', 'grid-cols-2', 'gap-4', 'size-entry');
                newSizeEntry.setAttribute('data-index', index);

                newSizeEntry.innerHTML = `
                    <div>
                        <label for="price-${index}" class="block">Price:</label>
                        <input type="number" name="sizes[${index}][price]" step="any" id="price-${index}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="dimensions-${index}" class="block">Description </label>
                            <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                ${options}
                            </select>
                    </div>
                    
                `;

                sizesContainer.appendChild(newSizeEntry);
                index++;
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
</script><?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/products/create.blade.php ENDPATH**/ ?>