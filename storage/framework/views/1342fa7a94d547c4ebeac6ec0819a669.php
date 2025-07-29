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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Restaurant Tables')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/tables-canvas.css')); ?>">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="page-header">
                        <h3 class="page-title">Restaurant Tables</h3>
                        <div class="header-actions">
                            <a href="<?php echo e(route('table-categories.index')); ?>" class="header-btn secondary">
                                Manage Categories
                            </a>
                            <a href="<?php echo e(route('restaurant-tables.create')); ?>" class="header-btn primary">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add New Table
                            </a>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <form method="GET" action="<?php echo e(route('restaurant-tables.index')); ?>" class="flex space-x-3">
                            <select name="category" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Filter
                            </button>
                            <?php if(request('category')): ?>
                                <a href="<?php echo e(route('restaurant-tables.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Tables Canvas -->
                    <div class="tables-container">
                        <?php
                            $groupedTables = $tables->groupBy('table_category_id');
                        ?>
                        
                        <?php $__currentLoopData = $groupedTables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryId => $categoryTables): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $category = $categories->firstWhere('id', $categoryId);
                            ?>
                            
                            <div class="category-section">
                                <div class="category-header">
                                    <div class="category-header-left">
                                        <span class="category-indicator"></span>
                                        <?php echo e($category ? $category->name : 'Unknown Category'); ?>

                                        <span class="category-count">(<?php echo e($categoryTables->count()); ?> tables)</span>
                                    </div>
                                    <a href="<?php echo e(route('restaurant-tables.show-category', $categoryId)); ?>" 
                                       class="show-all-btn">
                                        Show All Tables
                                    </a>
                                </div>
                                
                                <div class="tables-grid">
                                    <?php $__currentLoopData = $categoryTables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="table-card <?php echo e($table->status); ?>">
                                            <!-- Table Header -->
                                            <div class="table-header">
                                                <div class="table-header-content">
                                                    <h4 class="table-number"><?php echo e($table->table_number); ?></h4>
                                                    <span class="status-dot <?php echo e($table->status); ?>"></span>
                                                </div>
                                            </div>
                                            
                                            <!-- Table Body -->
                                            <div class="table-body">
                                                <div class="table-info">
                                                    <div class="info-row">
                                                        <svg class="info-icon" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <?php echo e($table->capacity); ?> seats
                                                    </div>
                                                    <div class="status-text <?php echo e($table->status); ?>">
                                                        <?php echo e(ucfirst($table->status)); ?>

                                                    </div>
                                                    <?php if($table->notes): ?>
                                                        <div class="table-notes" title="<?php echo e($table->notes); ?>">
                                                            <?php echo e(Str::limit($table->notes, 20)); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                            <!-- Hover Actions -->
                                            <div class="hover-actions">
                                                <a href="<?php echo e(route('restaurant-tables.edit', $table)); ?>" 
                                                   class="action-btn edit">
                                                    Edit
                                                </a>
                                                <form action="<?php echo e(route('restaurant-tables.destroy', $table)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                            class="action-btn delete"
                                                            onclick="return confirm('Are you sure you want to delete this table?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <!-- Add New Table Card for this Category -->
                                    <a href="<?php echo e(route('restaurant-tables.create', ['category' => $categoryId])); ?>" 
                                       class="add-table-card">
                                        <div class="add-table-content">
                                            <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <span class="add-text">Add Table</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <!-- Empty State -->
                        <?php if($tables->isEmpty()): ?>
                            <div class="empty-state">
                                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <h3 class="empty-title">No tables found</h3>
                                <p class="empty-description">Get started by creating a new table.</p>
                                <a href="<?php echo e(route('restaurant-tables.create')); ?>" class="empty-action">
                                    Add New Table
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
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
<?php endif; ?> <?php /**PATH C:\laragon\www\delivery\resources\views/restaurant-tables/index.blade.php ENDPATH**/ ?>