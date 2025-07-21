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

        .product-container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .product-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .product-header img {
            max-width: 100%;
            width: 200px;
            margin-right: 2rem;
            border-radius: 8px;
        }

        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 1.75rem;
            color: #2854C5;
            margin: 0 0 1rem 0;
        }

        .product-details p {
            margin: 0.5rem 0;
            font-size: 1rem;
        }

        .product-sizes, .extra-products {
            margin: 2rem 0;
        }

        .product-sizes table, .extra-products ul {
            width: 100%;
            border-collapse: collapse;
        }

        .product-sizes th, .product-sizes td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-sizes th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
            background-color: #2854C5;
            color: white;
        }

        .product-sizes tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .extra-products ul {
            list-style-type: none;
            padding: 0;
        }

        .extra-products li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        .extra-products li:last-child {
            border-bottom: none;
        }

        .extra-products .category {
            font-style: italic;
            color: #555;
        }

        .back-button {
            display: inline-block;
            margin-top: 1rem;
            background-color: #2854C5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #003a8c;
        }

        @media (max-width: 768px) {
            .product-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-header img {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .product-details h1 {
                font-size: 1.5rem;
            }

            .product-details p {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="product-container">
        <div class="product-header">
            <?php if($product->image): ?>
                <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>">
            <?php endif; ?>
            <div class="product-details">
                <h1><?php echo e($product->name); ?></h1>
                <p><strong>Category:</strong> <?php echo e($product->category->name); ?></p>
                <p><strong>Description:</strong> <?php echo e($product->description); ?></p>
                <p><strong>New Product:</strong> <?php echo e($product->new_product ? 'Yes' : 'No'); ?></p>
                <p><strong>New Offers:</strong> <?php echo e($product->new_offers ? 'Yes' : 'No'); ?></p>
                <p><strong>Suggested:</strong>  <?php echo e($product->suggested ? 'Yes' : 'No'); ?> </p>
            </div>
        </div>

    
        <a href="<?php echo e(route('products.index')); ?>" class="back-button">Back to Products</a>
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
<?php /**PATH C:\laragon\www\delivery\resources\views/products/show.blade.php ENDPATH**/ ?>