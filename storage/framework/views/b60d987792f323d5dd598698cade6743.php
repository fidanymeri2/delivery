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
            <?php echo e(__('Tables in')); ?> <?php echo e($category->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/tables-canvas.css')); ?>">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Section -->
                    <div class="category-page-header">
                        <div class="category-info">
                            <h3 class="category-title"><?php echo e($category->name); ?></h3>
                            <?php if($category->description): ?>
                                <p class="category-description"><?php echo e($category->description); ?></p>
                            <?php endif; ?>
                            <p class="category-count"><?php echo e($tables->count()); ?> tables in this category</p>
                        </div>
                        <div class="category-actions">
                            <a href="<?php echo e(route('restaurant-tables.index')); ?>" class="category-btn secondary">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to All Tables
                            </a>
                            <a href="<?php echo e(route('restaurant-tables.reposition', $category->id)); ?>" class="category-btn reposition">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                </svg>
                                Reposition Tables
                            </a>
                            <a href="<?php echo e(route('restaurant-tables.create', ['category' => $category->id])); ?>" class="category-btn primary">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add New Table
                            </a>
                        </div>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Category Stats -->
                    <div class="category-stats">
                        <div class="stat-card available">
                            <div class="stat-content">
                                <div class="stat-indicator available"></div>
                                <div>
                                    <p class="stat-label available">Available</p>
                                    <p class="stat-value available"><?php echo e($tables->where('status', 'available')->count()); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card occupied">
                            <div class="stat-content">
                                <div class="stat-indicator occupied"></div>
                                <div>
                                    <p class="stat-label occupied">Occupied</p>
                                    <p class="stat-value occupied"><?php echo e($tables->where('status', 'occupied')->count()); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card reserved">
                            <div class="stat-content">
                                <div class="stat-indicator reserved"></div>
                                <div>
                                    <p class="stat-label reserved">Reserved</p>
                                    <p class="stat-value reserved"><?php echo e($tables->where('status', 'reserved')->count()); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card maintenance">
                            <div class="stat-content">
                                <div class="stat-indicator maintenance"></div>
                                <div>
                                    <p class="stat-label maintenance">Maintenance</p>
                                    <p class="stat-value maintenance"><?php echo e($tables->where('status', 'maintenance')->count()); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tables Grid -->
                    <div class="tables-container">
                        <?php if($tables->isNotEmpty()): ?>
                            <div class="tables-grid">
                                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                
                                <!-- Add New Table Card -->
                                <a href="<?php echo e(route('restaurant-tables.create', ['category' => $category->id])); ?>" 
                                   class="add-table-card">
                                    <div class="add-table-content">
                                        <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <span class="add-text">Add Table</span>
                                    </div>
                                </a>
                            </div>
                        <?php else: ?>
                            <!-- Empty State -->
                            <div class="empty-state">
                                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <h3 class="empty-title">No tables found in <?php echo e($category->name); ?></h3>
                                <p class="empty-description">Get started by creating a new table in this category.</p>
                                <a href="<?php echo e(route('restaurant-tables.create', ['category' => $category->id])); ?>" class="empty-action">
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
<?php endif; ?> <?php /**PATH C:\laragon\www\delivery\resources\views/restaurant-tables/show-category.blade.php ENDPATH**/ ?>