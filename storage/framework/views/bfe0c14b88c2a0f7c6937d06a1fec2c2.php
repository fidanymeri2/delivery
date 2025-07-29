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
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            <?php echo e(__('product.edit_product')); ?>

                        </h2>
                        <div class="flex space-x-2">
                            <?php
                            $checkIfHasMenu = \App\Models\Menu::where('product_id',$product->id)->first();
                            ?>
                            <?php if($checkIfHasMenu): ?>
                                <a href="<?php echo e(route('menu.edit',$checkIfHasMenu->id)); ?>"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <?php echo e(__('product.view_menu')); ?>

                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('menu.create',$product->id)); ?>"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <?php echo e(__('product.create_menu')); ?>

                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('products.index')); ?>"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('product.back_to_products')); ?>

                            </a>
                        </div>
                    </div>

                    <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.category')); ?>:
                                </label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.name')); ?>:
                                </label>
                                <input type="text" name="name" id="name" value="<?php echo e(old('name', $product->name)); ?>" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.allergies')); ?>:
                                </label>
                                <input type="text" name="allergies" id="allergies" value="<?php echo e(old('allergies', $product->allergies)); ?>"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="product_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.product_code')); ?>:
                                </label>
                                <input type="text" name="product_code" id="product_code" value="<?php echo e(old('product_code', $product->product_code)); ?>" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.description')); ?>:
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?php echo e(old('description', $product->description)); ?></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.current_image')); ?>:
                                </label>
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e(__('product.current_image')); ?>"
                                         class="max-w-xs h-auto mb-4 rounded-lg shadow-md">
                                <?php endif; ?>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.replace_image')); ?>:
                                </label>
                                <input type="file" name="image" id="image"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Checkboxes -->
                            <div class="md:col-span-2">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="hidden" name="new_product" value="0">
                                        <input type="checkbox" name="new_product" id="new_product" value="1" <?php echo e(old('new_product', $product->new_product) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_product" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.new_product')); ?>

                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="new_offers" value="0">
                                        <input type="checkbox" name="new_offers" id="new_offers" value="1" <?php echo e(old('new_offers', $product->new_offers) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_offers" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.new_offers')); ?>

                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="suggested" value="0">
                                        <input type="checkbox" name="suggested" id="suggested" value="1" <?php echo e(old('suggested', $product->suggested) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="suggested" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.suggested')); ?>

                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="isMenu" value="0">
                                        <input type="checkbox" name="isMenu" id="isMenu" value="1" <?php echo e(old('isMenu', $product->isMenu) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="isMenu" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.menu')); ?>

                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" id="status" value="1" <?php echo e(old('status', $product->status) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="status" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.status')); ?>

                                        </label>
                                        <span class="ml-2 text-sm <?php echo e($product->status == 1 ? 'text-green-600' : 'text-red-600'); ?>">
                                            <?php echo e($product->status == 1 ? __('product.product_active') : __('product.product_inactive')); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock Management Section -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4 mt-6">
                                    <?php echo e(__('product.stock_management')); ?>

                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center">
                                        <input type="hidden" name="requires_stock" value="0">
                                        <input type="checkbox" name="requires_stock" id="requires_stock" value="1" <?php echo e(old('requires_stock', $product->requires_stock) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="requires_stock" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.requires_stock_tracking')); ?>

                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="low_stock_alert" value="0">
                                        <input type="checkbox" name="low_stock_alert" id="low_stock_alert" value="1" <?php echo e(old('low_stock_alert', $product->low_stock_alert) ? 'checked' : ''); ?>

                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="low_stock_alert" class="ml-2 block text-sm text-gray-900">
                                            <?php echo e(__('product.enable_low_stock_alerts')); ?>

                                        </label>
                                    </div>
                                </div>

                                <div id="stock-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: <?php echo e(old('requires_stock', $product->requires_stock) ? 'grid' : 'none'); ?>;">
                                    <div>
                                        <label for="current_stock" class="block text-sm font-medium text-gray-700 mb-2">
                                            <?php echo e(__('product.current_stock')); ?>:
                                        </label>
                                        <input type="number" name="current_stock" id="current_stock" min="0" value="<?php echo e(old('current_stock', $product->current_stock ?? 0)); ?>"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="stock_unit" class="block text-sm font-medium text-gray-700 mb-2">
                                            <?php echo e(__('product.stock_unit')); ?>:
                                        </label>
                                        <select name="stock_unit" id="stock_unit"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <optgroup label="Sasi (copë)">
                                                <option value="copë" <?php echo e(old('stock_unit', $product->stock_unit) == 'copë' ? 'selected' : ''); ?>>copë</option>
                                                <option value="porcion" <?php echo e(old('stock_unit', $product->stock_unit) == 'porcion' ? 'selected' : ''); ?>>porcion</option>
                                                <option value="artikull" <?php echo e(old('stock_unit', $product->stock_unit) == 'artikull' ? 'selected' : ''); ?>>artikull</option>
                                            </optgroup>
                                            <optgroup label="Peshë (masa)">
                                                <option value="gram" <?php echo e(old('stock_unit', $product->stock_unit) == 'gram' ? 'selected' : ''); ?>>gram (g)</option>
                                                <option value="kilogram" <?php echo e(old('stock_unit', $product->stock_unit) == 'kilogram' ? 'selected' : ''); ?>>kilogram (kg)</option>
                                            </optgroup>
                                            <optgroup label="Vëllim (lëngje)">
                                                <option value="litër" <?php echo e(old('stock_unit', $product->stock_unit) == 'litër' ? 'selected' : ''); ?>>litër (L)</option>
                                                <option value="mililitër" <?php echo e(old('stock_unit', $product->stock_unit) == 'mililitër' ? 'selected' : ''); ?>>mililitër (ml)</option>
                                                <option value="decilitër" <?php echo e(old('stock_unit', $product->stock_unit) == 'decilitër' ? 'selected' : ''); ?>>decilitër (dl)</option>
                                            </optgroup>
                                            <optgroup label="Njësi pakete">
                                                <option value="shishe" <?php echo e(old('stock_unit', $product->stock_unit) == 'shishe' ? 'selected' : ''); ?>>shishe</option>
                                                <option value="kuti" <?php echo e(old('stock_unit', $product->stock_unit) == 'kuti' ? 'selected' : ''); ?>>kuti</option>
                                                <option value="thes" <?php echo e(old('stock_unit', $product->stock_unit) == 'thes' ? 'selected' : ''); ?>>thes</option>
                                            </optgroup>
                                            <optgroup label="Njësi konsumi">
                                                <option value="lugë" <?php echo e(old('stock_unit', $product->stock_unit) == 'lugë' ? 'selected' : ''); ?>>lugë</option>
                                                <option value="filxhan" <?php echo e(old('stock_unit', $product->stock_unit) == 'filxhan' ? 'selected' : ''); ?>>filxhan</option>
                                                <option value="gotë" <?php echo e(old('stock_unit', $product->stock_unit) == 'gotë' ? 'selected' : ''); ?>>gotë</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="min_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            <?php echo e(__('product.min_stock_level')); ?>:
                                        </label>
                                        <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="<?php echo e(old('min_stock_level', $product->min_stock_level ?? 0)); ?>"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="max_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            <?php echo e(__('product.max_stock_level')); ?> (<?php echo e(__('product.optional')); ?>):
                                        </label>
                                        <input type="number" name="max_stock_level" id="max_stock_level" min="0" value="<?php echo e(old('max_stock_level', $product->max_stock_level)); ?>"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="deleted-options" name="deleted_options" value="">

                        <!-- Product Sizes Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                <?php echo e(__('product.product_sizes')); ?>

                            </h3>

                            <div id="sizes-container">
                                <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 size-entry mb-4" data-index="<?php echo e($index); ?>">
                                        <div>
                                            <label for="price-<?php echo e($index); ?>" class="block text-sm font-medium text-gray-700 mb-2">
                                                <?php echo e(__('product.price')); ?>:
                                            </label>
                                            <input type="number" name="sizes[<?php echo e($index); ?>][price]" id="price-<?php echo e($index); ?>" value="<?php echo e($size->price); ?>" step="0.01" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="relative">
                                            <label for="dimensions-<?php echo e($index); ?>" class="block text-sm font-medium text-gray-700 mb-2">
                                                <?php echo e(__('product.description')); ?>:
                                            </label>
                                            <select name="sizes[<?php echo e($index); ?>][dimensions]" id="dimensions-<?php echo e($index); ?>"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($de->id); ?>" <?php echo e($size->dimensions == $de->id ? 'selected' : ''); ?>><?php echo e($de->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <button type="button" class="remove-size absolute top-0 right-0 mt-8 px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <button type="button" id="add-size-button"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('product.add_size')); ?>

                            </button>
                        </div>

                        <!-- Product Options Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                <?php echo e(__('product.product_options')); ?>

                            </h3>

                            <div class="mb-4">
                                <label for="max_checked" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo e(__('product.option_max_select')); ?>:
                                </label>
                                <input type="text" name="max_checked" value="<?php echo e($product->max_checked); ?>"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="<?php echo e(__('product.option_max_select')); ?>">
                            </div>

                            <?php
                                $options = App\Models\ProductOptionOptional::where('product_id', $product->id)->get();
                                $opts = App\Models\ProductSize::select('description_categories.*')->where('product_id', $product->id)->leftJoin('description_categories','description_categories.id','=','product_sizes.dimensions')->get();
                            ?>

                            <div id="inputs-container">
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-3 flex gap-2 items-end">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <?php echo e(__('product.option_name')); ?>:
                                            </label>
                                            <input type="text" name="options[<?php echo e($index); ?>][name]" value="<?php echo e($option->name); ?>"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                   placeholder="<?php echo e(__('product.option_name')); ?>">
                                        </div>
                                        <input type="hidden" name="options[<?php echo e($index); ?>][id]" value="<?php echo e($option->id); ?>">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <?php echo e(__('product.description')); ?>:
                                            </label>
                                            <select name="options[<?php echo e($index); ?>][desc_id]"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($opt->id); ?>" <?php echo e($option->desc_id == $opt->id ? 'selected' : ''); ?>><?php echo e($opt->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <button type="button" class="remove-input px-3 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <?php echo e(__('product.remove')); ?>

                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <button type="button" id="add-input-btn"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('product.add_new_option')); ?>

                            </button>
                        </div>

                        <!-- Extra Products Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                <?php echo e(__('product.extra_products_by_category')); ?>

                            </h3>

                            <?php
                                $categories = \App\Models\ExtraCategory::with('extraProducts')->get();
                            ?>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-6">
                                    <h4 class="text-md font-medium text-gray-700 mb-2"><?php echo e($category->name); ?></h4>
                                    <div class="mb-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="select_all_<?php echo e($category->id); ?>" class="select-all-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="select_all_<?php echo e($category->id); ?>" class="ml-2 block text-sm text-gray-900">
                                                <?php echo e(__('product.select_all')); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        <?php echo e(__('product.product_name')); ?>

                                                    </th>
                                                    <?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            <?php echo e(__('product.price')); ?> - <?php echo e($de->name); ?>

                                                        </th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        <?php echo e(__('product.select')); ?>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php $__currentLoopData = $category->extraProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            <?php echo e($extraProduct->name); ?>

                                                        </td>
                                                        <?php $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $deprice = \App\Models\ExtraProductPrice::where('desc_id',$de->id)->where('extra_product_id',$extraProduct->id)->first(); ?>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                <?php echo e(number_format($deprice->price,2)); ?> €
                                                            </td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            <input type="checkbox" name="extra_products[]" value="<?php echo e($extraProduct->id); ?>"
                                                                   id="extra_product_<?php echo e($category->id); ?>_<?php echo e($extraProduct->id); ?>"
                                                                   <?php echo e(in_array($extraProduct->id, $product->extraProducts->pluck('id')->toArray()) ? 'checked' : ''); ?>

                                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('product.update_product')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            let inputCount = <?php echo e($options->count()); ?>;
            var opts = "<?php foreach($opts as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

            $('#add-input-btn').click(function(e) {
                e.preventDefault();

                inputCount++;
                let newInput = `<div class="input-group mb-3 flex gap-2 items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('product.option_name')); ?>:</label>
                        <input type="text" name="options[${inputCount}][name]" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="<?php echo e(__('product.option_name')); ?>">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('product.description')); ?>:</label>
                        <select name="options[${inputCount}][desc_id]" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">${opts}</select>
                    </div>
                    <button type="button" class="remove-input px-3 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"><?php echo e(__('product.remove')); ?></button>
                </div>`;
                $('#inputs-container').append(newInput);
            });

            // Remove input field
            $(document).on('click', '.remove-input', function(e) {
                e.preventDefault();
                let inputGroup = $(this).closest('.input-group');
                let optionId = inputGroup.find('input[name*="[id]"]').val();

                if (optionId) {
                    let deletedOptions = $('#deleted-options').val();
                    $('#deleted-options').val(deletedOptions + optionId + ',');
                }

                inputGroup.remove();
            });
        });

        var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

        document.addEventListener('DOMContentLoaded', function() {
            let index = <?php echo e(count($product->sizes)); ?>;
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeButton = document.getElementById('add-size-button');

            addSizeButton.addEventListener('click', function() {
                // Create a new size entry
                const newSizeEntry = document.createElement('div');
                newSizeEntry.classList.add('grid', 'grid-cols-1', 'md:grid-cols-2', 'gap-4', 'size-entry', 'mb-4');
                newSizeEntry.setAttribute('data-index', index);

                newSizeEntry.innerHTML = `
                    <div>
                        <label for="price-${index}" class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('product.price')); ?>:</label>
                        <input type="number" name="sizes[${index}][price]" id="price-${index}" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="relative">
                        <label for="dimensions-${index}" class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('product.description')); ?>:</label>
                        <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            ${options}
                        </select>
                        <button type="button" class="remove-size absolute top-0 right-0 mt-8 px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Remove</button>
                    </div>
                `;

                sizesContainer.appendChild(newSizeEntry);
                index++;
            });

            sizesContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-size')) {
                    const sizeEntry = event.target.closest('.size-entry');
                    sizesContainer.removeChild(sizeEntry);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Attach event listeners to each "Select All" checkbox
            document.querySelectorAll('.select-all-checkbox').forEach(selectAllCheckbox => {
                selectAllCheckbox.addEventListener('change', function () {
                    // Get the category ID from the checkbox ID
                    const categoryId = this.id.split('_').pop();

                    // Select or deselect all checkboxes in the table rows under this category
                    document.querySelectorAll(`input[type="checkbox"][id^="extra_product_${categoryId}_"]`).forEach(productCheckbox => {
                        productCheckbox.checked = this.checked;
                    });
                });
            });

            // Stock management toggle
            const requiresStockCheckbox = document.getElementById('requires_stock');
            const stockFields = document.getElementById('stock-fields');

            if (requiresStockCheckbox && stockFields) {
                requiresStockCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        stockFields.style.display = 'grid';
                    } else {
                        stockFields.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const img = new Image();

            // Check file size (not more than 1MB)
            const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
            if (file.size > maxSizeInBytes) {
                alert('<?php echo e(__('product.image_size_error')); ?>');
                event.target.value = ''; // Reset the file input
                return;
            }

            img.onload = function() {
                const width = img.width;
                const height = img.height;

                // Check for specific resolution range
                if (width < 800 || width > 1000 || height < 800 || height > 1000) {
                    alert('<?php echo e(__('product.image_resolution_error')); ?>');
                    event.target.value = ''; // Reset the file input
                }
            };

            if (file) {
                img.src = URL.createObjectURL(file);
            }
        });
    </script>
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
<?php /**PATH C:\laragon\www\delivery\resources\views/products/edit.blade.php ENDPATH**/ ?>