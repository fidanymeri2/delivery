<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status </title>
    <style>
        /* Universal styles for the email template */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%; /* Prevent font scaling in mobile devices */
        }
        .container {
            max-width: 100%;
            width: 90%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #8C0000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            width: 100px;
            max-width: 80%;
            height: auto;
            margin-bottom: 10px;
        }
        .header h2 {
            color: #333;
            font-size: 20px;
            margin: 0;
        }
        .content {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }
        .content p {
            margin-bottom: 15px;
        }
        .content ul {
            list-style: none;
            padding: 0;
        }
        .content ul li {
            margin-bottom: 10px;
        }
        .content ul li strong {
            color: #333;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .footer a {
            color: #888;
            text-decoration: none;
            margin: 0 5px;
        }
        .footer a:hover {
            text-decoration: underline;
        }

        /* Media queries for responsive design */
        @media screen and (max-width: 480px) {
            .header img {
                width: 80px;
            }
            .header h2 {
                font-size: 18px;
            }
            .content {
                font-size: 12px;
            }
            .footer {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://yumiis.de/images/fifi.png" alt="Company Logo">
            <h2>Order Status Update</h2>
        </div>
        <div class="content">
            <p>Hi <?php echo e($order->fullname); ?>,</p>
            <p>We wanted to let you know that the status of your order has been updated.</p>

            <p><strong>Order Details:</strong></p>
            <ul>
                <li><strong>Full Name:</strong> <?php echo e($order->fullname); ?></li>
                <li><strong>Phone Number:</strong> <?php echo e($order->phone_number); ?></li>
                <li><strong>Location:</strong> <?php echo e($order->location); ?></li>
                <li><strong>Postal Code:</strong> <?php echo e($order->postal_code); ?></li>
                <li><strong>Email:</strong> <?php echo e($order->email); ?></li>
                <li><strong>Status of Payment:</strong> <?php echo e($order->status_of_payment); ?></li>
                <li><strong>Order Status:</strong> <?php echo e($order->status); ?></li>
                <li><strong>Shipping Status:</strong> <?php echo e(ucfirst($order->shipping_status)); ?></li>
            </ul>

            <?php if($order->shipping_status == 'delivered'): ?>
                <p>Your order has been <strong>delivered</strong> successfully! We hope you enjoy your purchase.</p>
            <?php elseif($order->shipping_status == 'complete'): ?>
                <p>Your order is now marked as <strong>complete</strong>. Thank you for shopping with us!</p>
            <?php elseif($order->shipping_status == 'canceled'): ?>
                <p>We regret to inform you that your order has been <strong>canceled</strong>. If you have any questions or need assistance, please contact us.</p>
            <?php endif; ?>

            <p>If you have any questions or need further assistance, please feel free to contact us.</p>

            <a href="tel:01771411174">Call Us: <strong>+1 (234) 567-890</strong></a>
            <h4><em>Schrannenstraße 58, 86633 Neuburg an der Donau, Germany</em></h4>

            <p>Thank you for choosing our service!</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 YUMIIS PIZZA. All rights reserved.</p>
            <p><a href="unsubscribe-url">Unsubscribe</a> | <a href="preferences-url">Manage Preferences</a></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/u397680723/domains/soltriks.com/public_html/testtt/resources/views/emails/order-status.blade.php ENDPATH**/ ?>