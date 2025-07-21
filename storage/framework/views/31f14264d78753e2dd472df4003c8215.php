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
        .card {
            background-color: #fff;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-header {
            font-size: 1.25rem;
            color: #2854C5;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .icons {
            color: #2854C5; 
            font-size: 2rem; 
            display: inline-block;
            margin-bottom: 10px; 
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .no-underline {
            text-decoration: none;
        }
        .active {
            font-weight: bold;
            color: #007bff; 
        }
    </style>

    <div class="container">
    <a href="<?php echo e(route('products.stats')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'products.stats' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-chart-line"></i></span>
                <div class="card-header">Stats</div>
            </div>
        </a>


        <a href="<?php echo e(route('messages.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'messages.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="far fa-comment-alt"></i></span>
                <div class="card-header">Messages</div>
            </div>
        </a>

        <a href="<?php echo e(route('documents.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'documents.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-file-alt"></i></span>
                <div class="card-header">Documents</div>
            </div>
        </a>

        <a href="<?php echo e(route('users.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'users.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-users"></i></span>
                <div class="card-header">Users</div>
            </div>
        </a>

        <a href="<?php echo e(route('partners.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'partners.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-handshake"></i></span>
                <div class="card-header">Partners</div>
            </div>
        </a>

        <a href="<?php echo e(route('shipping-fees.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'shipping-fees.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-truck"></i></span>
                <div class="card-header">Shipping Fees</div>
            </div>
        </a>

        <a href="<?php echo e(route('banners.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'banners.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-ad"></i></span>
                <div class="card-header">Banners</div>
            </div>
        </a>

        <a href="<?php echo e(route('feedbacks.index')); ?>" class="no-underline <?php echo e(Route::currentRouteName() == 'feedbacks.index' ? 'active' : ''); ?>">
            <div class="card">
                <span class="icons"><i class="fas fa-star"></i></span>
                <div class="card-header">Feedbacks</div>
            </div>
        </a>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/settings/index.blade.php ENDPATH**/ ?>