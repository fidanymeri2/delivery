<div class="modal-overlay" id="menuModal">
    <div class="modal-content menu-modal">
        <div class="modal-header">
            <h3><?php echo e(__('pos.menu_products')); ?></h3>
            <div class="selected-table-info">
                <span class="table-label"><?php echo e(__('pos.table')); ?></span>
                <span class="table-number" id="modalTableNumber"><?php echo e(__('pos.none')); ?></span>
            </div>
            <button class="modal-close" id="closeMenuModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="modal-body menu-modal-body">
            <!-- Product Categories -->
            <div class="product-categories">
                <div class="search-container">
                    <input type="text" id="productSearch" placeholder="<?php echo e(__('pos.search_products')); ?>" class="product-search">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button class="category-tab active" data-category="all">
                    <?php echo e(__('pos.all_items')); ?>

                </button>
                <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="category-tab" data-category="<?php echo e($category->id); ?>">
                        <?php echo e($category->name); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item" data-category="<?php echo e($product->category_id); ?>">
                        <div class="product-info">
                            <h4 class="product-name"><?php echo e($product->name); ?></h4>
                            <div class="product-price">
                                <?php if($product->sizes->count() > 0): ?>
                                    <?php echo e(__('pos.currency_symbol')); ?><?php echo e(number_format($product->sizes->first()->price, 2)); ?>

                                <?php else: ?>
                                    <span style="color: #9ca3af;"><?php echo e(__('pos.no_price_set')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button class="add-to-table-btn" 
                                data-product-id="<?php echo e($product->id); ?>" 
                                data-product-name="<?php echo e($product->name); ?>" 
                                data-product-price="<?php echo e($product->sizes->count() > 0 ? $product->sizes->first()->price : 0); ?>"
                                <?php echo e($product->sizes->count() == 0 ? 'disabled' : ''); ?>>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <?php echo e(__('pos.add_to_order')); ?>

                        </button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <!-- No products found message -->
                <div id="noProductsMessage" class="no-products-message" style="display: none;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3><?php echo e(__('pos.no_products_found')); ?></h3>
                    <p><?php echo e(__('pos.try_adjusting_search')); ?></p>
                </div>
            </div>
        </div>
    </div>
</div> <?php /**PATH C:\laragon\www\delivery\resources\views/components/pos/menu-modal.blade.php ENDPATH**/ ?>