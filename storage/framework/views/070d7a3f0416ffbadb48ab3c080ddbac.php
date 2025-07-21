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

        a {
            text-decoration: none;
            color: #2854C5;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #2854C5;
            color: white;
        }

        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
            text-align: center; 

        }

        th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e6f7ff;
        }

        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e60000;
        }
        .btn-reset {
    background-color: #ff4d4d; /* Matches the red button style */
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    cursor: pointer;
    border-radius: 4px;
    text-align: center;
    display: inline-block;
    margin-left: 0.5rem;
    transition: background-color 0.3s;
}

.btn-reset:hover {
    background-color: #e60000; /* Darker red on hover */
}
        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 0.75rem;
            margin: 1rem 0;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-align: center;
    font-size: 0.875rem;
    text-decoration: none; /* Ensures no underline by default */
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

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    text-decoration: none; 
}
.filter-form {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.filter-form label {
    font-weight: 600;
    font-size: 0.875rem;
}

.filter-select {
    padding: 0.5rem;
    padding-right: 2rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: border-color 0.3s;
}

.filter-select:hover {
    border-color: #2854C5;
}


@media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }

            table {
                font-size: 0.875rem;
            }

            th, td {
                padding: 0.5rem;
            }

            .actions {
                flex-direction: column;
            }
        }

    </style>

<div class="container">
    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <a href="<?php echo e(route('products.create')); ?>" class="text-white no-underline hover:no-underline">Create New Product</a>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- <form method="GET" action="<?php echo e(route('products.index')); ?>" class="filter-form" >
        <label for="category">Filter by Category:</label>
        <select name="category_id" id="category" class="filter-select" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $categoryId ? 'selected' : ''); ?>>
                    <?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form> -->
    <form action="<?php echo e(route('products.index')); ?>" class="mt-6" method="GET">
    <input type="text" name="product_name" value="<?php echo e(request('product_name')); ?>" class="filter-select w-fit" placeholder="Search Product">
    <select name="category_id" class="filter-select">
        <option value="">All Categories</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit" class="btn btn-info">Search</button>
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-reset">Reset</a>
</form>
    <table id="product-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sortable">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($product->id); ?>">
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->category->name); ?></td>
                    <td class="actions">
                        <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-info">View</a>
                        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-primary">Edit</a>
                        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php echo e($products->links()); ?>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
  $(function() {
    $("#sortable").sortable({
        update: function(event, ui) {
            var sortedIDs = $(this).sortable('toArray', { attribute: 'data-id' });
            console.log('Sorted IDs:', sortedIDs); // Debug log

            $.ajax({
                url: '<?php echo e(route("products.sort")); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    order: sortedIDs
                },
                success: function(response) {
                    console.log('Order updated successfully:', response);
                    alert('Order updated successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', xhr.responseText);
                    alert('Failed to update order. Error: ' + xhr.responseText);
                }
            });
        }
    });
    $("#sortable").disableSelection();
});
    </script>

<?php /**PATH C:\laragon\www\devi-back\resources\views/products/index.blade.php ENDPATH**/ ?>