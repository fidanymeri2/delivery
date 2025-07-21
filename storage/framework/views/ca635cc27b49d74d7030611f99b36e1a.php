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

        input[type="file"] {
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
        <h1>Create Banner</h1>

        <?php if($errors->any()): ?>
            <div class="error-message">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('banners.store')); ?>" method="POST" enctype="multipart/form-data" id="bannerForm">
            <?php echo csrf_field(); ?>

            <div>
                <label for="image">Banner Image</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div>
                <label for="description">Description</label>
                <input type="text" name="description" id="description" required>
            </div>

            <div class="mb-6">
                <label for="status">Active</label>
                <p>Click if you want to activate the banner
                    <input type="checkbox" name="status" id="status" value="1"></p>
            </div>

            <button type="submit">Create Banner</button>
        </form>

        <a href="<?php echo e(route('banners.index')); ?>" class="back-link">Back to Banners List</a>
    </div>

    <!-- Modal for Resolution and File Size Info -->
    <div id="resolutionModal" style="display: none;">
        <div style="background-color: #fff; padding: 1rem; border-radius: 8px; width: 300px; margin: 2rem auto; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <h2>Invalid Image</h2>
            <p id="modalMessage">The uploaded image does not meet the required resolution or size.</p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const img = new Image();

            // File size check (not more than 1MB)
            const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
            if (file.size > maxSizeInBytes) {
                document.getElementById('modalMessage').textContent = 'The uploaded image must not exceed 1MB.';
                document.getElementById('resolutionModal').style.display = 'block';
                document.getElementById('bannerForm').reset();
                return;
            }

            img.onload = function() {
                const width = img.width;
                const height = img.height;

                // Check for specific resolution
                if (width !== 1920 || height !== 1080) { // Change to your desired resolution
                    document.getElementById('modalMessage').textContent = 'The uploaded image does not meet the required resolution of 1920x1080.';
                    document.getElementById('resolutionModal').style.display = 'block';
                    document.getElementById('bannerForm').reset();
                }
            };

            if (file) {
                img.src = URL.createObjectURL(file);
            }
        });

        function closeModal() {
            document.getElementById('resolutionModal').style.display = 'none';
        }
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
<?php endif; ?><?php /**PATH C:\laragon\www\devi-back\resources\views/banners/create.blade.php ENDPATH**/ ?>