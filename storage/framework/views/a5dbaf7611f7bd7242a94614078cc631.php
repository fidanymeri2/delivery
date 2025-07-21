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
        /* Breadcrumb Styles */
        .breadcrumb {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.875rem; /* Equivalent to text-sm */
            color: #6b7280; /* Equivalent to text-gray-500 */
            margin-bottom: 1rem;
        }

        .breadcrumb a {
            color: #2854C5;
            text-decoration: none;
            margin-right: 0.5rem;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            margin-right: 0.5rem;
            color: #6b7280; /* Equivalent to text-gray-500 */
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            box-sizing: border-box;
        }

        h1 {
            font-size: 2rem; /* Equivalent to text-2xl */
            font-weight: 700; /* Equivalent to font-bold */
            margin-bottom: 1.5rem; /* Margin equivalent to mb-6 */
            color: #2854C5;
            text-align: center;
        }

        label {
            display: block;
            font-size: 0.875rem; /* Equivalent to text-sm */
            font-weight: 500; /* Equivalent to font-medium */
            color: #4b5563; /* Equivalent to text-gray-700 */
            margin-bottom: 0.5rem;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db; /* Equivalent to border-gray-300 */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            box-sizing: border-box;
            font-size: 1rem; /* Equivalent to text-sm */
            margin-bottom: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus {
            border-color: #4f46e5; /* Equivalent to focus:border-indigo-500 */
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3); /* Equivalent to focus:ring-indigo-500 */
            outline: none;
        }

        button {
            background-color: #4f46e5; /* Equivalent to bg-indigo-600 */
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem; /* Equivalent to text-sm */
            cursor: pointer;
            border-radius: 0.375rem; /* Equivalent to rounded-lg */
            transition: background-color 0.3s, box-shadow 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #4338ca; /* Equivalent to hover:bg-indigo-700 */
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3); /* Equivalent to focus:ring-indigo-500 */
        }

        .error {
            color: #dc2626; /* Tailwind's red-600 color */
            font-size: 0.875rem; /* Tailwind's text-sm */
        }

        button:disabled {
            background-color: #d1d5db; /* Tailwind's gray-300 */
            cursor: not-allowed;
        }
    </style>

    <div class="max-w-4xl mx-auto p-6">
        <div class="breadcrumb">
            <a href="<?php echo e(route('categories.index')); ?>">Categories</a>
            <span class="separator">/</span>
            <span>Edit Category</span>
        </div>

        <div class="container">
            <h1>Edit Category</h1>
            <form action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo e($category->name); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"><?php echo e($category->description); ?></textarea>
                </div>

                <button type="submit">Update Category</button>
            </form>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/apiyumiis/resources/views/categories/edit.blade.php ENDPATH**/ ?>