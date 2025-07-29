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
            <?php echo e(__('Reposition Tables -')); ?> <?php echo e($category->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        .reposition-container {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .canvas-container {
            position: relative;
            width: 100%;
            height: 600px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .canvas-boundary {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 0.375rem;
            pointer-events: none;
        }

        .draggable-table {
            position: absolute;
            cursor: move;
            user-select: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
            min-width: 80px;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            text-align: center;
            padding: 0.5rem;
        }

        .draggable-table:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .draggable-table.dragging {
            z-index: 1000;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: rotate(2deg);
        }

        .draggable-table.available {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .draggable-table.occupied {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .draggable-table.reserved {
            background: linear-gradient(135deg, #eab308, #ca8a04);
        }

        .draggable-table.maintenance {
            background: linear-gradient(135deg, #6b7280, #4b5563);
        }

        .table-number {
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .table-status {
            font-size: 0.625rem;
            opacity: 0.9;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .control-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-success {
            background: #22c55e;
            color: white;
        }

        .btn-success:hover {
            background: #16a34a;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .instructions {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .instructions h3 {
            color: #0c4a6e;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .instructions ul {
            color: #0369a1;
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        .instructions li {
            margin-bottom: 0.25rem;
        }

        .save-status {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 500;
            z-index: 1001;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        }

        .save-status.show {
            opacity: 1;
            transform: translateX(0);
        }

        .save-status.success {
            background: #22c55e;
        }

        .save-status.error {
            background: #ef4444;
        }

        .resize-handle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #3b82f6;
            border: 2px solid #ffffff;
            border-radius: 50%;
            cursor: se-resize;
            bottom: 4px;
            right: 4px;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }

        .resize-handle:hover {
            background: #2563eb;
            transform: scale(1.3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .draggable-table:hover .resize-handle {
            opacity: 1;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header -->
                    <div class="controls">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900"><?php echo e($category->name); ?> - Table Positioning</h3>
                            <p class="text-sm text-gray-600">Drag and drop tables to reposition them within the boundary</p>
                        </div>
                        <div class="control-buttons">
                            <a href="<?php echo e(route('restaurant-tables.show-category', $category->id)); ?>" class="btn btn-secondary">
                                Back to Category
                            </a>
                            <button id="testSave" class="btn btn-primary">
                                Test Save
                            </button>
                            <button id="savePositions" class="btn btn-success">
                                Save Positions
                            </button>
                            <button id="resetPositions" class="btn btn-danger">
                                Reset Positions
                            </button>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="instructions">
                        <h3>How to Reposition Tables:</h3>
                        <ul>
                            <li><strong>Drag</strong> tables to move them around the canvas</li>
                            <li><strong>Resize</strong> tables using the handle in the bottom-right corner</li>
                            <li>Tables must stay within the dashed boundary</li>
                            <li>Use the <strong>grid lines</strong> as guides for alignment</li>
                            <li>Click <strong>Save Positions</strong> to store your layout</li>
                            <li>Use <strong>Reset Positions</strong> to restore grid layout</li>
                        </ul>
                    </div>

                    <!-- Canvas -->
                    <div class="reposition-container">
                        <div class="canvas-container" id="canvas">
                            <div class="canvas-boundary"></div>
                            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $position = $table->positionForCategory($category->id);
                                    
                                    if ($position) {
                                        $x = $position->x_position;
                                        $y = $position->y_position;
                                        $width = $position->width;
                                        $height = $position->height;
                                        $zIndex = $position->z_index;
                                    } else {
                                        // Grid layout: 4 tables per row
                                        $tablesPerRow = 4;
                                        $row = intval($loop->index / $tablesPerRow);
                                        $col = $loop->index % $tablesPerRow;
                                        
                                        $x = 50 + ($col * 120);
                                        $y = 50 + ($row * 100);
                                        $width = 100;
                                        $height = 80;
                                        $zIndex = $loop->index;
                                    }
                                ?>
                                <div class="draggable-table <?php echo e($table->status); ?>" 
                                     data-table-id="<?php echo e($table->id); ?>"
                                     style="left: <?php echo e($x); ?>px; top: <?php echo e($y); ?>px; width: <?php echo e($width); ?>px; height: <?php echo e($height); ?>px; z-index: <?php echo e($zIndex); ?>;">
                                    <div>
                                        <div class="table-number"><?php echo e($table->table_number); ?></div>
                                        <div class="table-status"><?php echo e(ucfirst($table->status)); ?></div>
                                    </div>
                                    <div class="resize-handle"></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Status -->
    <div id="saveStatus" class="save-status"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('canvas');
            const draggableTables = document.querySelectorAll('.draggable-table');
            const testSaveButton = document.getElementById('testSave');
            const saveButton = document.getElementById('savePositions');
            const resetButton = document.getElementById('resetPositions');
            const saveStatus = document.getElementById('saveStatus');

            let isDragging = false;
            let currentTable = null;
            let offsetX = 0;
            let offsetY = 0;
            let isResizing = false;
            let resizeStartX = 0;
            let resizeStartY = 0;
            let originalWidth = 0;
            let originalHeight = 0;

            // Get canvas boundaries
            const canvasRect = canvas.getBoundingClientRect();
            const boundary = {
                left: 20,
                top: 20,
                right: canvasRect.width - 20,
                bottom: canvasRect.height - 20
            };

            // Drag functionality
            draggableTables.forEach(table => {
                table.addEventListener('mousedown', startDrag);
                table.addEventListener('touchstart', startDrag, { passive: false });
            });

            function startDrag(e) {
                e.preventDefault();
                
                // Check if the clicked element is a resize handle
                if (e.target.classList.contains('resize-handle')) {
                    startResize(e);
                    return;
                }
                
                // Check if the clicked element is inside a resize handle
                const resizeHandle = e.target.closest('.resize-handle');
                if (resizeHandle) {
                    startResize(e);
                    return;
                }

                isDragging = true;
                currentTable = e.target.closest('.draggable-table');
                currentTable.classList.add('dragging');
                
                const rect = currentTable.getBoundingClientRect();
                offsetX = e.clientX - rect.left;
                offsetY = e.clientY - rect.top;
                
                document.addEventListener('mousemove', drag);
                document.addEventListener('mouseup', stopDrag);
                document.addEventListener('touchmove', drag, { passive: false });
                document.addEventListener('touchend', stopDrag);
            }

            function drag(e) {
                if (!isDragging || !currentTable) return;
                e.preventDefault();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                
                const canvasRect = canvas.getBoundingClientRect();
                let newX = clientX - canvasRect.left - offsetX;
                let newY = clientY - canvasRect.top - offsetY;
                
                // Constrain to boundary
                const tableWidth = parseInt(currentTable.style.width);
                const tableHeight = parseInt(currentTable.style.height);
                
                newX = Math.max(boundary.left, Math.min(newX, boundary.right - tableWidth));
                newY = Math.max(boundary.top, Math.min(newY, boundary.bottom - tableHeight));
                
                currentTable.style.left = newX + 'px';
                currentTable.style.top = newY + 'px';
            }

            function stopDrag() {
                if (isDragging && currentTable) {
                    currentTable.classList.remove('dragging');
                    isDragging = false;
                    currentTable = null;
                }
                
                document.removeEventListener('mousemove', drag);
                document.removeEventListener('mouseup', stopDrag);
                document.removeEventListener('touchmove', drag);
                document.removeEventListener('touchend', stopDrag);
            }

            // Resize functionality
            function startResize(e) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('Resize started');
                
                isResizing = true;
                currentTable = e.target.closest('.draggable-table');
                resizeStartX = e.clientX;
                resizeStartY = e.clientY;
                originalWidth = parseInt(currentTable.style.width);
                originalHeight = parseInt(currentTable.style.height);
                
                console.log('Resize params:', {
                    table: currentTable,
                    startX: resizeStartX,
                    startY: resizeStartY,
                    originalWidth: originalWidth,
                    originalHeight: originalHeight
                });
                
                document.addEventListener('mousemove', resize);
                document.addEventListener('mouseup', stopResize);
                document.addEventListener('touchmove', resize, { passive: false });
                document.addEventListener('touchend', stopResize);
            }

            function resize(e) {
                if (!isResizing || !currentTable) return;
                e.preventDefault();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                
                const deltaX = clientX - resizeStartX;
                const deltaY = clientY - resizeStartY;
                
                let newWidth = Math.max(80, originalWidth + deltaX);
                let newHeight = Math.max(60, originalHeight + deltaY);
                
                // Constrain to boundary
                const currentX = parseInt(currentTable.style.left);
                const currentY = parseInt(currentTable.style.top);
                
                newWidth = Math.min(newWidth, boundary.right - currentX);
                newHeight = Math.min(newHeight, boundary.bottom - currentY);
                
                console.log('Resizing:', {
                    deltaX: deltaX,
                    deltaY: deltaY,
                    newWidth: newWidth,
                    newHeight: newHeight
                });
                
                currentTable.style.width = newWidth + 'px';
                currentTable.style.height = newHeight + 'px';
            }

            function stopResize() {
                isResizing = false;
                currentTable = null;
                
                document.removeEventListener('mousemove', resize);
                document.removeEventListener('mouseup', stopResize);
                document.removeEventListener('touchmove', resize);
                document.removeEventListener('touchend', stopResize);
            }

            // Test save
            testSaveButton.addEventListener('click', function() {
                const testData = {
                    test: true,
                    message: 'Test save request',
                    timestamp: new Date().toISOString()
                };

                console.log('Sending test data:', testData);

                fetch('<?php echo e(route("restaurant-tables.test-save")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(testData)
                })
                .then(response => {
                    console.log('Test response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Test response data:', data);
                    showSaveStatus('success', 'Test save successful: ' + data.message);
                })
                .catch(error => {
                    console.error('Test error:', error);
                    showSaveStatus('error', 'Test save failed: ' + error.message);
                });
            });

            // Save positions
            saveButton.addEventListener('click', function() {
                const positions = [];
                draggableTables.forEach((table, index) => {
                    positions.push({
                        table_id: parseInt(table.dataset.tableId),
                        x: parseInt(table.style.left),
                        y: parseInt(table.style.top),
                        width: parseInt(table.style.width),
                        height: parseInt(table.style.height),
                        z_index: index
                    });
                });

                const requestData = {
                    category_id: <?php echo e($category->id); ?>,
                    positions: positions
                };

                console.log('Sending data:', requestData);

                fetch('<?php echo e(route("restaurant-tables.save-positions")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    showSaveStatus(data.success ? 'success' : 'error', data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showSaveStatus('error', 'Failed to save positions: ' + error.message);
                });
            });

            // Reset positions
            resetButton.addEventListener('click', function() {
                if (confirm('Are you sure you want to reset all table positions?')) {
                    draggableTables.forEach((table, index) => {
                        // Grid layout: 4 tables per row
                        const tablesPerRow = 4;
                        const row = Math.floor(index / tablesPerRow);
                        const col = index % tablesPerRow;
                        
                        const x = 50 + (col * 120);
                        const y = 50 + (row * 100);
                        
                        table.style.left = x + 'px';
                        table.style.top = y + 'px';
                        table.style.width = '100px';
                        table.style.height = '80px';
                        table.style.zIndex = index;
                    });
                }
            });

            function showSaveStatus(type, message) {
                saveStatus.textContent = message;
                saveStatus.className = `save-status ${type} show`;
                
                setTimeout(() => {
                    saveStatus.classList.remove('show');
                }, 3000);
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
<?php endif; ?> <?php /**PATH C:\laragon\www\delivery\resources\views/restaurant-tables/reposition.blade.php ENDPATH**/ ?>