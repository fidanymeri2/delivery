<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


</head>
<body class="font-sans antialiased">
    <?php if (isset($component)) { $__componentOriginalff9615640ecc9fe720b9f7641382872b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff9615640ecc9fe720b9f7641382872b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $attributes = $__attributesOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__attributesOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $component = $__componentOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__componentOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>
    <div class="wrapper">
        <div class="top_navbar">
            <div class="top_menu">
                <div class="logo">YUMIIS</div>
                <!-- Burger menu button -->
                <div class="burger-menu" id="burger-menu">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                    <li><a href="#" class="no-underline"><i class="fas fa-search"></i></a></li>
                    <li><a href="#" id="fullscreen-toggle" class="no-underline"><i class="fas fa-expand"></i></a></li>
                    <li>
                        <a href="<?php echo e(route('storage.link.create')); ?>" class="no-underline">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </a>
                    </li>
                    <li><a href="<?php echo e(route('profile.show')); ?>" class="no-underline"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
        <ul>
    <?php if(auth()->user()->hasRole('admin')): ?>
        <li>
            <a href="<?php echo e(route('dashboard')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'dashboard' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('products.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'products.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Products</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('categories.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'categories.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-th"></i></span>
                <span class="title">Category</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('extra-products.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'extra-products.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Extra Products</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('description_categories.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'description_categories.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Description Category</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('extra-categories.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'extra-categories.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-th"></i></span>
                <span class="title">Extra Category</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('stock-management.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'stock-management.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-boxes"></i></span>
                <span class="title">Stock Management</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('orders.new')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'orders.new' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-bell"></i></span>
                <span class="title">New Orders</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('orders.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'orders.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="title">Orders</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('reservations.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'reservations.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-calendar"></i></span>
                <span class="title">Reservations</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('table-categories.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'table-categories.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-layer-group"></i></span>
                <span class="title">Table Categories</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('restaurant-tables.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'restaurant-tables.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-table"></i></span>
                <span class="title">Restaurant Tables</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('table-orders.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'table-orders.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-utensils"></i></span>
                <span class="title">Table Orders</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('pos.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'pos.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-cash-register"></i></span>
                <span class="title">POS System</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('settings.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'settings.index' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-cog"></i></span>
                <span class="title">Settings</span>
            </a>
        </li>
    <?php elseif(auth()->user()->hasRole('delivery')): ?>
        <li>
            <a href="<?php echo e(route('orders.new')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'orders.new' ? 'active' : ''); ?>">
                <span class="icon"><i class="fas fa-bell"></i></span>
                <span class="title">New Orders</span>
            </a>
        </li>
    <?php endif; ?>
</ul>

            <form method="POST" action="<?php echo e(route('logout')); ?>" x-data class="logout-form">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-button">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="title">Logout</span>
                </button>
            </form>
        </div>
        <div class="main_container" id="main-container">
            <?php echo e($slot); ?>

        </div>
    </div>
    <!-- Scripts -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <script>
        document.getElementById('fullscreen-toggle').addEventListener('click', function () {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        const burgerMenu = document.getElementById('burger-menu');
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('main-container');
        const links = document.querySelectorAll('.sidebar a');

        // Toggle sidebar visibility
        burgerMenu.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            mainContainer.classList.toggle('full-width');
        });

        // Hide sidebar when clicking a menu item
        links.forEach(link => {
            link.addEventListener('click', function () {
                sidebar.classList.remove('active');
                mainContainer.classList.add('full-width');
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\activ\OneDrive\Documents\Soltriks Projects\delivery\resources\views/layouts/app.blade.php ENDPATH**/ ?>