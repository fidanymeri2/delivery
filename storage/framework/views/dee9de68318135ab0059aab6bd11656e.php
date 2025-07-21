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
            max-width: 800px;
            margin: auto;
            padding: 1rem;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin: 1rem 0;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2854C5;
            border-bottom: 2px solid #2854C5;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-body {
            font-size: 1rem;
            color: #333;
        }

        .card-body label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .card-body input,
        .card-body select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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

        .btn-secondary {
            background-color: #508D4E;
        }

        .btn-secondary:hover {
            background-color: #80AF81;
            text-decoration: none;
        }
        .card-footer {
    margin-top: 20px;
    padding: 10px;
    border-top: 1px solid #ddd;
    background: #f9f9f9;
}

.card-footer h5 {
    margin-bottom: 10px;
    font-size: 1.25rem;
    font-weight: bold;
}

.status-history-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.status-history-list li {
    padding: 5px 0;
    display: flex;
    align-items: center;
}

.status-history-list i {
    margin-right: 10px;
    font-size: 1.2rem; /* Adjust size as needed */
}

.status-history-list li strong {
    margin-right: 5px;
}
/* The Modal (hidden by default) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #007bff;
    width: 80%; /* Could be more or less, depending on screen size */
    max-width: 500px; /* Set a maximum width for larger screens */
    text-align: center; /* Center text inside the modal */
    border-radius: 10px;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* Style the paragraph inside the modal */
.modal-content p {
    font-size: 16px;
    color: #333;
}

/* Add some padding to the buttons */
.modal-content button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.modal-content button:hover {
    background-color: #0056b3;
}

    </style>

<div class="container">
    
<div class="card">
    <div class="card-header">
        Update Shipping Status for Order #<?php echo e($order->order_code); ?>

    </div>
    <div class="card-body">
    <form action="<?php echo e(route('orders.updateShippingStatus', $order->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <label for="shipping_status">Shipping Status:</label>
    <select id="shipping_status" name="shipping_status" required>
        <option value="new" <?php echo e($order->shipping_status == 'new' ? 'selected' : ''); ?>>New</option>
        <option value="delivered" <?php echo e($order->shipping_status == 'delivered' ? 'selected' : ''); ?>> On the way  </option>
        <option value="complete" <?php echo e($order->shipping_status == 'complete' ? 'selected' : ''); ?>>Delivered</option>
        <option value="canceled" <?php echo e($order->shipping_status == 'canceled' ? 'selected' : ''); ?>>Canceled</option>
    </select>

    <div class="actions">
        <button type="submit" class="btn btn-secondary">Update Shipping Status</button>
    </div>
</form>

<!-- Add a button to send the email manually -->
<button id="sendEmailButton" class="btn btn-primary mt-2">
    Send Email Notification <i class="fas fa-envelope"></i>
</button>

<!-- Modal for email null -->
<div id="emailNullModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Email is null, you can't send an email notification.</p>
    </div>
</div>

<div id="emailSuccessModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Email sent successfully.</p>
        <button class="btn-close-modal">Close</button>
    </div>
</div>

<!-- Hidden form to send email -->
<form id="sendEmailForm" action="<?php echo e(route('orders.sendEmail', $order->id)); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

    </div>
    <div class="card-footer">
    <h5>Status History</h5>
    <ul class="status-history-list">
        <?php
            // Define custom status order
            $statusOrder = [
                'new' => 1,
                'delivered' => 2,
                'complete' => 3,
                'canceled' => 4
            ];

            // Sort statusHistories based on the custom order
            $statusHistories = $statusHistories->sortBy(function ($history) use ($statusOrder) {
                return $statusOrder[$history->status] ?? 999;
            });
        ?>

        <?php $__empty_1 = true; $__currentLoopData = $statusHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li>
                <?php
                    $icon = '';
                    switch ($history->status) {
                        case 'new':
                            $icon = 'box'; // Icon for new
                            break;
                        case 'delivered':
                            $icon = 'truck'; 
                            break;
                        case 'complete':
                            $icon = 'check-circle'; 
                            break;
                        case 'canceled':
                            $icon = 'times-circle'; 
                            break;
                        default:
                            $icon = 'question-circle'; 
                    }
                ?>
                <i class="fas fa-<?php echo e($icon); ?>"></i>
                <strong><?php echo e(ucfirst($history->status)); ?></strong> - <?php echo e($history->created_at->format('Y-m-d H:i:s')); ?>

                
                Changed by: <?php echo e($history->changedBy->name ?? 'Unknown'); ?>

            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No status history available.</li>
        <?php endif; ?>
    </ul>
</div>


</div>


    <div class="card">
        <div class="card-header">
            Edit Order #<?php echo e($order->id); ?>

        </div>
        <div class="card-body">
            <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo e($order->firstName); ?>" required>
 
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo e($order->lastName); ?>" required>
 
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo e($order->phone_number); ?>" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo e($order->location); ?>" required>

                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo e($order->postal_code); ?>" >

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e($order->email); ?>" >

                <label for="status_of_payment">Payment Status:</label>
                <select id="status_of_payment" name="status_of_payment" required>
                    <option value="bank" <?php echo e($order->status_of_payment == 'bank' ? 'selected' : ''); ?>>Bank</option>
                    <option value="cash" <?php echo e($order->status_of_payment == 'cash' ? 'selected' : ''); ?>>Cash</option>
                    <option value="pickup" <?php echo e($order->status_of_payment == 'pickup' ? 'selected' : ''); ?>>Pickup</option>
                </select>

                <label for="status">Order Status:</label>
                <select id="status" name="status" required>
                    <option value="paid" <?php echo e($order->status == 'paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="unpaid" <?php echo e($order->status == 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                </select>

                <div class="actions">
                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-info">
                        Back to List
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Trigger send email logic
    document.getElementById('sendEmailButton').addEventListener('click', function(event) {
        event.preventDefault();

        <?php if(!$order->email): ?>
            // Show modal if email is null
            document.getElementById('emailNullModal').style.display = 'block';
        <?php else: ?>
            // Submit form if email exists
            document.getElementById('sendEmailForm').submit();
        <?php endif; ?>
    });

    // Close modals logic
    document.querySelectorAll('.close, .btn-close-modal').forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            document.getElementById('emailNullModal').style.display = 'none';
            document.getElementById('emailSuccessModal').style.display = 'none';
        });
    });

    // Optional: close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('emailNullModal') || event.target == document.getElementById('emailSuccessModal')) {
            event.target.style.display = 'none';
        }
    };

    // Show success modal if the session contains success message
    // <?php if(session('success')): ?>
    //     document.getElementById('emailSuccessModal').style.display = 'block';
    // <?php endif; ?>
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
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/orders/edit.blade.php ENDPATH**/ ?>