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
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

Input[type="text"],input[type="time"],
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #2854C5;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1d3b8b;
        }

        .error-message {
            color: #ff4d4d;
            margin-bottom: 1rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #2854C5;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <h1>Edit Message</h1>

        <?php if($errors->any()): ?>
            <div class="error-message">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('messages.update', $message->id)); ?>" enctype="multipart/form-data" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label for="category">Category</label>
            <input type="text" readonly name="category" id="category" value="<?php echo e(old('category', $message->category)); ?>" required>
<?php if($message->category == 'OPEN_HOURS'): ?>
    <label for="description">From time:</label>
            <input type="time"  name="from" id="category" value="<?php echo e(explode('-', $message->description)[0]); ?>" required>
              <label for="description">To time:</label>
            <input type="time"  name="to" id="category" value="<?php echo e(explode('-', $message->description)[1]); ?>" required>
            
<?php elseif($message->category == 'CURRENT_MESSAGE'): ?>
<?php $category = App\Models\Message::whereIn('category',['HOURS_CLOSE_STORE_MESSAGE','VACTION_CLOSE_STORE_MESSAGE','LARGE_ORDER_MESSAGE'])->get(); ?>
<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<label for="<?php echo e($cat->category); ?>"> 
            <input type="radio"  name="description" id="<?php echo e($cat->category); ?>" <?php if($message->description == $cat->category): ?> checked <?php endif; ?> value="<?php echo e($cat->category); ?>" required> <?php echo e($cat->description); ?></label>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
<?php elseif($message->category == 'LOGO'): ?>

<input type="file" name="description"  required/>


<?php else: ?> 
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required><?php echo e(old('description', $message->description)); ?></textarea>
<?php endif; ?>
            <button type="submit">Update</button>
        </form>

        <a href="<?php echo e(route('messages.index')); ?>" class="back-link">Back to Messages</a>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/messages/edit.blade.php ENDPATH**/ ?>