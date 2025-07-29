<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(__('POS System')); ?> - Restaurant Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/pos-demo.css')); ?>">
</head>
<body class="font-sans antialiased">
    <div class="pos-container">
        <!-- Header Component -->
        <?php if (isset($component)) { $__componentOriginalddba0d6a6a9d32261b126f44add103a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddba0d6a6a9d32261b126f44add103a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddba0d6a6a9d32261b126f44add103a0)): ?>
<?php $attributes = $__attributesOriginalddba0d6a6a9d32261b126f44add103a0; ?>
<?php unset($__attributesOriginalddba0d6a6a9d32261b126f44add103a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddba0d6a6a9d32261b126f44add103a0)): ?>
<?php $component = $__componentOriginalddba0d6a6a9d32261b126f44add103a0; ?>
<?php unset($__componentOriginalddba0d6a6a9d32261b126f44add103a0); ?>
<?php endif; ?>

        <!-- Waiter Authentication Modal Component -->
        <?php if (isset($component)) { $__componentOriginal72adbb7b4def05fc5c172db5ac5fb9c0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72adbb7b4def05fc5c172db5ac5fb9c0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.waiter-auth-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.waiter-auth-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72adbb7b4def05fc5c172db5ac5fb9c0)): ?>
<?php $attributes = $__attributesOriginal72adbb7b4def05fc5c172db5ac5fb9c0; ?>
<?php unset($__attributesOriginal72adbb7b4def05fc5c172db5ac5fb9c0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72adbb7b4def05fc5c172db5ac5fb9c0)): ?>
<?php $component = $__componentOriginal72adbb7b4def05fc5c172db5ac5fb9c0; ?>
<?php unset($__componentOriginal72adbb7b4def05fc5c172db5ac5fb9c0); ?>
<?php endif; ?>

        <!-- Main Content -->
        <div class="pos-main" id="posMain" style="display: none;">
            <!-- Tables Section Component -->
            <?php if (isset($component)) { $__componentOriginalf45e879369717009125afbb69d9df7e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf45e879369717009125afbb69d9df7e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.tables-section','data' => ['categories' => $categories]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.tables-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf45e879369717009125afbb69d9df7e0)): ?>
<?php $attributes = $__attributesOriginalf45e879369717009125afbb69d9df7e0; ?>
<?php unset($__attributesOriginalf45e879369717009125afbb69d9df7e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf45e879369717009125afbb69d9df7e0)): ?>
<?php $component = $__componentOriginalf45e879369717009125afbb69d9df7e0; ?>
<?php unset($__componentOriginalf45e879369717009125afbb69d9df7e0); ?>
<?php endif; ?>

            <!-- Order Panel Component -->
            <?php if (isset($component)) { $__componentOriginalb863ef8871681da893109dccf4557a3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb863ef8871681da893109dccf4557a3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.order-panel','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.order-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb863ef8871681da893109dccf4557a3e)): ?>
<?php $attributes = $__attributesOriginalb863ef8871681da893109dccf4557a3e; ?>
<?php unset($__attributesOriginalb863ef8871681da893109dccf4557a3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb863ef8871681da893109dccf4557a3e)): ?>
<?php $component = $__componentOriginalb863ef8871681da893109dccf4557a3e; ?>
<?php unset($__componentOriginalb863ef8871681da893109dccf4557a3e); ?>
<?php endif; ?>

            <!-- Payment Modal Component -->
            <?php if (isset($component)) { $__componentOriginal25f2e6165c82aa8acb5302308b63b7da = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25f2e6165c82aa8acb5302308b63b7da = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.payment-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.payment-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25f2e6165c82aa8acb5302308b63b7da)): ?>
<?php $attributes = $__attributesOriginal25f2e6165c82aa8acb5302308b63b7da; ?>
<?php unset($__attributesOriginal25f2e6165c82aa8acb5302308b63b7da); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25f2e6165c82aa8acb5302308b63b7da)): ?>
<?php $component = $__componentOriginal25f2e6165c82aa8acb5302308b63b7da; ?>
<?php unset($__componentOriginal25f2e6165c82aa8acb5302308b63b7da); ?>
<?php endif; ?>
        </div>
    </div>

    <!-- Menu Modal Component -->
    <?php if (isset($component)) { $__componentOriginal4549e17611149ee7f9517e686c143c80 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4549e17611149ee7f9517e686c143c80 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.menu-modal','data' => ['products' => $products,'productCategories' => $productCategories]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.menu-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($products),'productCategories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productCategories)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4549e17611149ee7f9517e686c143c80)): ?>
<?php $attributes = $__attributesOriginal4549e17611149ee7f9517e686c143c80; ?>
<?php unset($__attributesOriginal4549e17611149ee7f9517e686c143c80); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4549e17611149ee7f9517e686c143c80)): ?>
<?php $component = $__componentOriginal4549e17611149ee7f9517e686c143c80; ?>
<?php unset($__componentOriginal4549e17611149ee7f9517e686c143c80); ?>
<?php endif; ?>

    <!-- Quantity Modal Component -->
    <?php if (isset($component)) { $__componentOriginalba906c2b8935b132f7e0b9cd4e66ff75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba906c2b8935b132f7e0b9cd4e66ff75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pos.quantity-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pos.quantity-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba906c2b8935b132f7e0b9cd4e66ff75)): ?>
<?php $attributes = $__attributesOriginalba906c2b8935b132f7e0b9cd4e66ff75; ?>
<?php unset($__attributesOriginalba906c2b8935b132f7e0b9cd4e66ff75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba906c2b8935b132f7e0b9cd4e66ff75)): ?>
<?php $component = $__componentOriginalba906c2b8935b132f7e0b9cd4e66ff75; ?>
<?php unset($__componentOriginalba906c2b8935b132f7e0b9cd4e66ff75); ?>
<?php endif; ?>

    <!-- POS System JavaScript -->
    <script src="<?php echo e(asset('js/pos-system.js')); ?>"></script>
    <script>
        // Pass category data to JavaScript
        const categoryData = <?php echo json_encode($categories, 15, 512) ?>;
    </script>
</body>
</html>


</body>
</html> <?php /**PATH C:\laragon\www\delivery\resources\views/demo/index.blade.php ENDPATH**/ ?>