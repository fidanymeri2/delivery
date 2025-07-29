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
                    <?php if(session('success')): ?>
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-800">
                                        <?php echo e(session('success')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Product Details -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-blue-600 mb-6">
                            <?php echo e(__('product.product_details')); ?>

                        </h2>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-8">
                                    <!-- Product Image -->
                                    <?php if($product->image): ?>
                                        <div class="flex-shrink-0 mb-6 lg:mb-0">
                                            <img src="<?php echo e(asset($product->image)); ?>"
                                                 alt="<?php echo e($product->name); ?>"
                                                 class="w-48 h-48 object-cover rounded-lg shadow-md">
                                        </div>
                                    <?php endif; ?>

                                    <!-- Product Information -->
                                    <div class="flex-1">
                                        <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php echo e($product->name); ?></h1>

                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32"><?php echo e(__('product.category')); ?>:</span>
                                                <span class="text-sm text-gray-900"><?php echo e($product->category->name); ?></span>
                                            </div>

                                            <div class="flex items-start">
                                                <span class="text-sm font-medium text-gray-500 w-32 mt-1"><?php echo e(__('product.description')); ?>:</span>
                                                <span class="text-sm text-gray-900 flex-1"><?php echo e($product->description); ?></span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32"><?php echo e(__('product.new_product')); ?>:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($product->new_product ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                                                    <?php echo e($product->new_product ? __('product.yes') : __('product.no')); ?>

                                                </span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32"><?php echo e(__('product.new_offers')); ?>:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($product->new_offers ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'); ?>">
                                                    <?php echo e($product->new_offers ? __('product.yes') : __('product.no')); ?>

                                                </span>
                                            </div>

                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-500 w-32"><?php echo e(__('product.suggested')); ?>:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($product->suggested ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'); ?>">
                                                    <?php echo e($product->suggested ? __('product.yes') : __('product.no')); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Sizes Section -->
                    <?php if($product->sizes && $product->sizes->count() > 0): ?>
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4"><?php echo e(__('product.product_sizes')); ?></h3>
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php echo e(__('product.size')); ?></th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?php echo e(__('product.price')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($size->name); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($size->price); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Extra Products Section -->
                    <?php if($product->extras && $product->extras->count() > 0): ?>
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4"><?php echo e(__('product.extra_products')); ?></h3>
                            <div class="bg-white shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <div class="px-6 py-4">
                                    <div class="space-y-4">
                                        <?php $__currentLoopData = $product->extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-900"><?php echo e($extra->name); ?></h4>
                                                        <?php if($extra->category): ?>
                                                            <p class="text-xs text-gray-500 italic"><?php echo e($extra->category->name); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if($extra->prices && $extra->prices->count() > 0): ?>
                                                        <div class="text-sm text-gray-900">
                                                            <?php $__currentLoopData = $extra->prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="inline-block bg-gray-100 rounded px-2 py-1 mr-2"><?php echo e($price->price); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="<?php echo e(route('products.index')); ?>"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <?php echo e(__('product.back_to_products')); ?>

                        </a>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\delivery\resources\views/products/show.blade.php ENDPATH**/ ?>