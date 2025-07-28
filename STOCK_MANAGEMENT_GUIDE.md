# Stock Management System Guide

## Overview

This comprehensive stock management system has been designed specifically for your POS restaurant delivery system. It provides flexible stock tracking that allows you to choose which products need stock management while keeping others without tracking.

## Key Features

### 🎯 **Flexible Stock Tracking**
- **Selective Tracking**: Choose which products require stock management
- **No Tracking**: Some products (like services, digital items) don't need stock tracking
- **Smart Defaults**: New products default to no stock tracking

### 📊 **Real-time Stock Management**
- **Current Stock**: Track available quantity for each product
- **Stock Levels**: Set minimum and maximum stock thresholds
- **Stock Units**: Flexible units (pieces, kg, liters, etc.)
- **Stock Status**: Visual indicators for stock levels

### 🔔 **Smart Alerts System**
- **Low Stock Alerts**: Notify when stock reaches minimum level
- **Out of Stock Alerts**: Critical alerts when stock is zero
- **Overstock Alerts**: Warn when stock exceeds maximum level
- **Alert Management**: Acknowledge, resolve, or dismiss alerts

### 📈 **Transaction Tracking**
- **Complete History**: Track all stock movements
- **Transaction Types**: Purchase, sale, adjustment, return, damage, transfer
- **Audit Trail**: User tracking, timestamps, IP addresses
- **Cost Tracking**: Unit costs and total costs for purchases

### 🛠 **Management Tools**
- **Bulk Updates**: Update multiple products at once
- **Stock Reports**: Export to CSV or PDF
- **Dashboard**: Real-time stock overview
- **API Endpoints**: Integration with other systems

## Database Structure

### Products Table (New Columns)
```sql
-- Stock management columns added to products table
requires_stock BOOLEAN DEFAULT FALSE
current_stock INTEGER DEFAULT 0
min_stock_level INTEGER DEFAULT 0
max_stock_level INTEGER NULL
stock_unit VARCHAR(50) DEFAULT 'pieces'
low_stock_alert BOOLEAN DEFAULT FALSE
last_stock_update TIMESTAMP NULL
```

### Stock Transactions Table
```sql
-- Tracks all stock movements
id BIGINT PRIMARY KEY
product_id BIGINT FOREIGN KEY
user_id BIGINT FOREIGN KEY
order_id BIGINT FOREIGN KEY NULL
table_order_id BIGINT FOREIGN KEY NULL
transaction_type ENUM('purchase', 'sale', 'adjustment', 'return', 'damage', 'transfer', 'initial', 'correction')
quantity INTEGER
quantity_before INTEGER
quantity_after INTEGER
unit_cost DECIMAL(10,2) NULL
total_cost DECIMAL(10,2) NULL
reference_number VARCHAR(100) NULL
supplier_name VARCHAR(100) NULL
notes TEXT NULL
ip_address VARCHAR(45) NULL
user_agent TEXT NULL
created_at TIMESTAMP
updated_at TIMESTAMP
deleted_at TIMESTAMP NULL
```

### Stock Alerts Table
```sql
-- Manages stock alerts and notifications
id BIGINT PRIMARY KEY
product_id BIGINT FOREIGN KEY
user_id BIGINT FOREIGN KEY NULL
alert_type ENUM('low_stock', 'out_of_stock', 'overstock', 'expiring_soon', 'custom')
title VARCHAR(255)
message TEXT
current_stock INTEGER
threshold_stock INTEGER
status ENUM('active', 'acknowledged', 'resolved', 'dismissed') DEFAULT 'active'
priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium'
email_sent BOOLEAN DEFAULT FALSE
sms_sent BOOLEAN DEFAULT FALSE
push_sent BOOLEAN DEFAULT FALSE
acknowledged_at TIMESTAMP NULL
resolved_at TIMESTAMP NULL
created_at TIMESTAMP
updated_at TIMESTAMP
deleted_at TIMESTAMP NULL
```

## Usage Guide

### 1. Setting Up Stock Management

#### Enable Stock Tracking for a Product
1. Go to **Products** → **Edit Product**
2. Check **"Requires Stock Tracking"**
3. Set initial stock values:
   - **Current Stock**: Available quantity
   - **Min Stock Level**: Alert threshold
   - **Max Stock Level**: Overstock threshold (optional)
   - **Stock Unit**: Unit of measurement
   - **Low Stock Alert**: Enable/disable alerts

#### Example Configuration
```
Product: "Margherita Pizza"
Requires Stock: ✅ Yes
Current Stock: 25
Min Stock Level: 5
Max Stock Level: 50
Stock Unit: pieces
Low Stock Alert: ✅ Yes
```

### 2. Stock Operations

#### Adding Stock (Purchase)
```php
// Using the service
$stockService->addStock($product, 50, [
    'unit_cost' => 2.50,
    'supplier_name' => 'Fresh Foods Inc.',
    'reference_number' => 'PO-2024-001',
    'notes' => 'Monthly pizza base order'
]);
```

#### Removing Stock (Sale)
```php
// Automatically called when order is placed
$stockService->removeStock($product, 2, [
    'order_id' => $order->id,
    'notes' => 'Customer order #1234'
]);
```

#### Manual Adjustment
```php
// Correct stock discrepancies
$stockService->adjustStock($product, -3, [
    'notes' => 'Found 3 damaged items during inventory'
]);
```

### 3. Stock Status Indicators

#### Stock Status Types
- **No Tracking**: Gray - Product doesn't require stock management
- **Out of Stock**: Red - Stock level is zero
- **Low Stock**: Orange - Stock at or below minimum level
- **Overstock**: Blue - Stock above maximum level
- **Normal**: Green - Stock within acceptable range

#### Status Methods
```php
$product->getStockStatus();        // Returns status string
$product->getStockStatusColor();   // Returns CSS color class
$product->getStockStatusLabel();   // Returns human-readable label
$product->isLowStock();           // Boolean check
$product->isOutOfStock();         // Boolean check
$product->canSell(5);             // Check if can sell quantity
```

### 4. Alert Management

#### Alert Types
- **Low Stock**: Triggered when stock ≤ min_stock_level
- **Out of Stock**: Triggered when stock = 0
- **Overstock**: Triggered when stock > max_stock_level
- **Custom**: Manual alerts

#### Alert Priorities
- **Critical**: Out of stock situations
- **High**: Low stock alerts
- **Medium**: Overstock alerts
- **Low**: General notifications

#### Managing Alerts
```php
// Acknowledge alert
$alert->acknowledge();

// Resolve alert
$alert->resolve();

// Dismiss alert
$alert->dismiss();
```

### 5. Dashboard Features

#### Stock Summary
- Total products with stock tracking
- Out of stock count
- Low stock count
- Overstock count
- Total stock value

#### Recent Activity
- Latest stock transactions
- Active alerts
- Stock movements by user

#### Quick Actions
- Bulk stock updates
- Export reports
- Manage alerts

### 6. API Endpoints

#### Stock Summary
```
GET /stock-management/api/summary
```

#### Low Stock Products
```
GET /stock-management/api/low-stock
```

#### Out of Stock Products
```
GET /stock-management/api/out-of-stock
```

### 7. Integration with POS

#### Automatic Stock Deduction
When orders are placed through the POS system, stock is automatically deducted:

```php
// In your order processing
foreach ($orderItems as $item) {
    if ($item->product->requires_stock) {
        $stockService->removeStock($item->product, $item->quantity, [
            'order_id' => $order->id,
            'table_order_id' => $tableOrder->id ?? null,
            'notes' => "Order #{$order->id}"
        ]);
    }
}
```

#### Stock Validation
```php
// Check if product can be sold
if (!$product->canSell($requestedQuantity)) {
    return response()->json([
        'error' => 'Insufficient stock',
        'available' => $product->getAvailableStock()
    ], 400);
}
```

## Best Practices

### 1. Initial Setup
- Start with stock tracking disabled for all products
- Enable tracking only for products that need it
- Set realistic minimum and maximum stock levels

### 2. Regular Maintenance
- Review and acknowledge alerts daily
- Conduct regular stock counts
- Update stock levels after inventory checks

### 3. User Training
- Train staff on stock management procedures
- Explain alert meanings and priorities
- Show how to handle stock adjustments

### 4. Monitoring
- Check dashboard regularly for stock issues
- Review transaction history for discrepancies
- Monitor alert patterns

## Migration Commands

Run these migrations to set up the stock management system:

```bash
php artisan migrate
```

This will:
1. Add stock columns to products table
2. Create stock_transactions table
3. Create stock_alerts table

## Troubleshooting

### Common Issues

#### Stock Not Updating
- Check if product has `requires_stock = true`
- Verify user permissions
- Check database transaction logs

#### Alerts Not Triggering
- Ensure `low_stock_alert = true` for the product
- Verify `min_stock_level` is set correctly
- Check alert status (should be 'active')

#### Performance Issues
- Add indexes to frequently queried columns
- Use pagination for large transaction lists
- Consider archiving old transactions

### Support

For technical support or questions about the stock management system, refer to the code documentation or contact the development team.

## Future Enhancements

Potential improvements for the stock management system:

1. **Barcode Integration**: Scan products for quick stock updates
2. **Supplier Management**: Track suppliers and purchase orders
3. **Expiry Date Tracking**: For perishable items
4. **Multi-location Support**: Stock across multiple locations
5. **Automated Reordering**: Automatic purchase order generation
6. **Stock Forecasting**: Predict stock needs based on sales history
7. **Mobile App**: Stock management on mobile devices
8. **Email/SMS Notifications**: Automated alert notifications 