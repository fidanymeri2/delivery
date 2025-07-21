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
    <link rel="stylesheet" href="https://apiyumiis.soltriks.com/public/build/assets/app-0zNOfxlS.css" data-navigate-track="reload" />
    <script type="module" src="https://apiyumiis.soltriks.com/public/build/assets/app-C1-XIpUa.js" data-navigate-track="reload"></script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <style>
    .burger-menu {
        display: none;
        cursor: pointer;
    }
    .sidebar {
    position: fixed;
    top: 70px; 
    left: 10px;
    background: #2e4ead;
    width: 200px;
    height: calc(100vh - 70px); 
    
    border-bottom-left-radius: 20px;
    transition: all 0.3s ease;
    overflow-y: auto; 
    display: flex;
    flex-direction: column;
}
.sidebar::-webkit-scrollbar {
    width: 12px; 
}

.sidebar::-webkit-scrollbar-track {
    background: #2e4ead; 
}

.sidebar::-webkit-scrollbar-thumb {
    background: #1e40af; 
    border-radius: 10px; 
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #1a3a8f; 
}


.sidebar ul {
    padding: 0;
    margin: 0;
    list-style-type: none;
}

.sidebar ul li a {
    display: block;
    padding: 20px;
    position: relative;
    margin-bottom: 1px;
    color: #92a6e2;
    white-space: nowrap;
    transition: background-color 0.3s ease, color 0.3s ease;
    text-decoration: none; 
}
    

    @media (max-width: 768px) {
        .burger-menu {
            display: block;
            padding: 10px;
            font-size: 1.5rem;
        }

        .sidebar {
            position: fixed; 
            top: 60px; 
            left: 0;
            width: 200px; 
            height: calc(100% - 60px); 
            background: #fff;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none; 
        }

        .sidebar.active {
            display: block;
        }

        .main_container.full-width {
            width: 100%;
            margin-left: 0;
        }
    }
</style>

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
</li>   <li>
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
                <!-- <li>
                    <a href="<?php echo e(route('banners.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'banners.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-ad"></i></span>
                        <span class="title">Banners</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="<?php echo e(route('shipping-fees.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'shipping-fees.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-truck"></i></span>
                        <span class="title">Shipping Fee</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="<?php echo e(route('partners.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'partners.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-handshake"></i></span>
                        <span class="title">Partners</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo e(route('reservations.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'reservations.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-calendar"></i></span>
                        <span class="title">Reservations</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo e(route('users.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'users.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="title">Users</span>
                    </a>
                </li> -->

                <!-- <li>
                    <a href="<?php echo e(route('documents.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'documents.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-file-alt"></i>                        </span>
                        <span class="title">Documents</span>
                    </a>
                </li> -->

                <!-- <li>
                    <a href="<?php echo e(route('messages.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'messages.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-info-circle"></i>                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li> -->

                <li>
                    <a href="<?php echo e(route('settings.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'settings.index' ? 'active' : ''); ?>">
                        <span class="icon"><i class="fas fa-cog"></i>                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
            </ul>
            <form method="POST" action="<?php echo e(route('logout')); ?>" x-data class="logout-form">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-button">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="title">Logout</span>
                </button>
            </form>
        </div>
        <div class="main_container full-width" id="main-container">
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
<?php /**PATH C:\laragon\www\devi-back\resources\views/layouts/app.blade.php ENDPATH**/ ?>