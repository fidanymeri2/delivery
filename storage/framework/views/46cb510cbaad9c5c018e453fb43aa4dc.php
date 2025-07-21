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
            max-width: 1500px;
            margin: auto;
            padding: 1rem;
        }
        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin: 1rem;
        }
        a {
            text-decoration: none;
            color: #2854C5;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        thead {
            background-color: #2854C5;
            color: white;
        }
        th, td {
            padding: 0.75rem;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }
        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e6f7ff;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #e60000;
        }
        .actions a {
            margin-right: 0.5rem;
        }
        .actions form {
            display: inline;
        }
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 0.75rem;
            margin: 1rem 0;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            text-decoration: none; 
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            text-decoration: none; 
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            overflow-x: auto; /* Enables horizontal scrolling if content overflows */
            -webkit-overflow-scrolling: touch;
        }
        .table td, .table th {
    white-space: nowrap;
}
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.5rem;
        }
        .form-group {
            flex: 1;
            margin: 0.5rem;
            min-width: 200px; /* Ensures form groups have a minimum width */
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .form-group button {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        .filter-section {
            margin-top: 3rem;
            padding-bottom: 1rem;
            border: 1px solid #ddd; 
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            background-color: #fff;
        }

        .status-new {
            color: blue;
            font-weight: bold;
        }

        .status-delivered {
            color: orange;
            font-weight: bold;
        }

        .status-complete {
            color: green;
            font-weight: bold;
        }

        .status-canceled {
           color: red;
            font-weight: bold;
        }

        .status-unknown {
            color: gray;
        }
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }
            table {
                font-size: 0.75rem;
            }
            th, td {
                padding: 0.5rem;
            }
            .actions {
                flex-direction: column;
                align-items: flex-start;
            }
            .actions a, .actions button {
                margin-bottom: 0.5rem;
            }
        }
        @media (max-width: 576px) {
            h1 {
                font-size: 1.25rem;
            }
            .container {
                padding: 0.25rem;
            }
            .btn, .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
<div class="container">
    <?php if(session('success')): ?>
        <p class="success-message"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="filter-section p-3 mb-4 border rounded shadow">
            <h1>Filter</h1>
            <form action="<?php echo e(route('orders.index')); ?>" method="GET" class="d-flex align-items-center">
                
                <div class="form-group mb-0 mr-2 flex-grow-1">
                    <label for="status" class="d-block">Order Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">All</option>
                        <option value="paid" <?php echo e(request('status') == 'paid' ? 'selected' : ''); ?>>Paid</option>
                        <option value="unpaid" <?php echo e(request('status') == 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                    </select>
                </div>

                <div class="form-group mb-0 mr-2 flex-grow-1">
                    <label for="status_of_payment" class="d-block">Payment Method</label>
                    <select name="status_of_payment" id="status_of_payment" class="form-control">
                        <option value="">All</option>
                        <option value="bank" <?php echo e(request('status_of_payment') == 'bank' ? 'selected' : ''); ?>>Bank</option>
                        <option value="cash" <?php echo e(request('status_of_payment') == 'cash' ? 'selected' : ''); ?>>Cash</option>
                        <option value="pickup" <?php echo e(request('status_of_payment') == 'pickup' ? 'selected' : ''); ?>>Pickup</option>
                    </select>
                </div>
                
                <div class="form-group mb-0 mr-2 flex-grow-1">
                    <label for="shipping_status" class="d-block">Shipping Status</label>
                    <select name="shipping_status" id="shipping_status" class="form-control">
                        <option value="new" <?php echo e(request('shipping_status', 'new') == 'new' ? 'selected' : ''); ?>>New</option>
                        <option value="delivered" <?php echo e(request('shipping_status') == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                        <option value="complete" <?php echo e(request('shipping_status') == 'complete' ? 'selected' : ''); ?>>Complete</option>
                        <option value="canceled" <?php echo e(request('shipping_status') == 'canceled' ? 'selected' : ''); ?>>Canceled</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <p>Total Orders: <span class="font-bold text-xl"><?php echo e($orders->total()); ?></span></p>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Order Code</th>
                    <th>Full Name</th>
                    <th>Phone NR</th>
                    <th>Location</th>
                    <th>Postal Code</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Shipping Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration); ?></td>
                        <td>#ORD-<?php echo e($order->id); ?></td>
                        <td><?php echo e($order->fullname); ?></td>
                        <td><?php echo e($order->phone_number); ?></td>
                        <td><?php echo e($order->location); ?></td>
                        <td><?php echo e($order->postal_code); ?></td>
                        <td><?php echo e($order->status_of_payment); ?></td>
                        <td><?php echo e($order->status); ?></td>
                        <td class="
                            <?php if($order->shipping_status == 'new'): ?> status-new
                            <?php elseif($order->shipping_status == 'delivered'): ?> status-delivered
                            <?php elseif($order->shipping_status == 'complete'): ?> status-complete
                            <?php elseif($order->shipping_status == 'canceled'): ?> status-canceled
                            <?php else: ?> status-unknown
                            <?php endif; ?>
                            ">
                            <?php if($order->shipping_status == 'new'): ?> New
                            <?php elseif($order->shipping_status == 'delivered'): ?> Delivered
                            <?php elseif($order->shipping_status == 'complete'): ?> Complete
                            <?php elseif($order->shipping_status == 'canceled'): ?> Canceled
                            <?php else: ?> Unknown
                            <?php endif; ?>
                        </td>

                        <td class="actions">
                            <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('orders.invoice', $order->id)); ?>" class="btn btn-primary" onclick="printInvoice(event, '<?php echo e(route('orders.invoice', $order->id)); ?>')">Invoice</a>
                            <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php echo e($orders->links()); ?>

    </div>

    <div class="filter-section p-3 mb-4 border rounded shadow">
        <h1 class="text-center mb-4">PDF Report</h1>

        <div class="d-flex justify-content-center align-items-start flex-wrap">
            <div class="p-2">
                <a href="<?php echo e(route('orders.dailyPdf')); ?>" class="btn btn-primary">Generate Daily Orders PDF</a>
            </div>

            <div class="p-2">
                <form action="<?php echo e(route('orders.dateRangePdf')); ?>" method="POST" class="d-flex align-items-end">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-0 mr-2">
                        <label for="start_date" class="d-block">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group mb-0 mr-2">
                        <label for="end_date" class="d-block">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Generate Date Range PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
    function printInvoice(event, url) {
        event.preventDefault(); 
        
        fetch(url)
            .then(response => response.text())
            .then(data => {
                const printWindow = window.open('', '', 'height=600,width=800');
                
                printWindow.document.write(data);
                
                printWindow.document.close();
                printWindow.print();
            })
            .catch(error => {
                console.error('Error fetching invoice:', error);
            });
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\devi-back\resources\views/orders/index.blade.php ENDPATH**/ ?>