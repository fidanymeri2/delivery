<div class="tables-section full-width" id="tablesSection">
    <div class="section-header">
        <h3 class="section-title"><?php echo e(__('pos.restaurant_tables')); ?></h3>
        <div class="section-subtitle" id="tablesSubtitle"><?php echo e(__('pos.select_category_to_view_tables')); ?></div>
    </div>

    <!-- Categories View -->
    <div class="categories-view" id="categoriesView">
        <div class="categories-grid">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-card" data-category-id="<?php echo e($category->id); ?>" data-category-name="<?php echo e($category->name); ?>">
                    <div class="category-card-content">
                        <h4 class="category-card-title"><?php echo e($category->name); ?></h4>
                        <button class="view-tables-btn"><?php echo e(__('pos.view_tables')); ?></button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Tables Canvas View -->
    <div class="tables-canvas-view" id="tablesCanvasView" style="display: none;">
        <div class="canvas-header">
            <button class="back-to-categories-btn" id="backToCategories">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <?php echo e(__('pos.back_to_categories')); ?>

            </button>
            <h4 class="canvas-category-title" id="canvasCategoryTitle"></h4>
            <div class="canvas-stats" id="canvasStats"></div>
        </div>
        
        <div class="canvas-container">
            <div class="canvas-boundary" id="tablesCanvas">
                <!-- Tables will be dynamically added here -->
            </div>
        </div>
    </div>
</div> <?php /**PATH C:\laragon\www\delivery\resources\views/components/pos/tables-section.blade.php ENDPATH**/ ?>