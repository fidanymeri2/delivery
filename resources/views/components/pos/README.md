# POS System Components

This directory contains reusable Blade components for the POS (Point of Sale) system.

## Component Structure

### Core Components

1. **`header.blade.php`** - Main POS header with time, date, waiter info, and navigation
2. **`waiter-auth-modal.blade.php`** - Waiter authentication modal with PIN input
3. **`tables-section.blade.php`** - Tables management with categories and canvas views
4. **`order-panel.blade.php`** - Order management panel with items and totals
5. **`payment-modal.blade.php`** - Payment method selection modal
6. **`menu-modal.blade.php`** - Product menu with search and filtering
7. **`quantity-modal.blade.php`** - Quantity selection for adding products

## Usage

### Basic Implementation

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Head content -->
</head>
<body>
    <div class="pos-container">
        <!-- Header Component -->
        <x-pos.header />

        <!-- Waiter Authentication Modal Component -->
        <x-pos.waiter-auth-modal />

        <!-- Main Content -->
        <div class="pos-main" id="posMain" style="display: none;">
            <!-- Tables Section Component -->
            <x-pos.tables-section :categories="$categories" />

            <!-- Order Panel Component -->
            <x-pos.order-panel />

            <!-- Payment Modal Component -->
            <x-pos.payment-modal />
        </div>
    </div>

    <!-- Menu Modal Component -->
    <x-pos.menu-modal :products="$products" :productCategories="$productCategories" />

    <!-- Quantity Modal Component -->
    <x-pos.quantity-modal />

    <!-- POS System JavaScript -->
    <script src="{{ asset('js/pos-system.js') }}"></script>
</body>
</html>
```

### Required Data

The components expect the following data to be passed from the controller:

```php
// In your controller
public function index()
{
    return view('demo.index', [
        'categories' => TableCategory::with('tables.positions')->get(),
        'products' => Product::with('sizes')->get(),
        'productCategories' => Category::all(),
    ]);
}
```

## JavaScript Integration

The components work with the `pos-system.js` module which handles:

- Waiter authentication
- Table selection and management
- Product search and filtering
- Order management
- Payment processing
- Modal interactions

## Benefits of Component Structure

1. **Reusability** - Components can be used across different POS views
2. **Maintainability** - Each component has a single responsibility
3. **Testability** - Components can be tested independently
4. **Scalability** - Easy to add new features or modify existing ones
5. **Code Organization** - Clear separation of concerns

## Customization

Each component can be customized by:

1. **Styling** - Modify the CSS classes in `pos-demo.css`
2. **Functionality** - Extend the JavaScript methods in `pos-system.js`
3. **Layout** - Adjust the Blade template structure
4. **Data** - Pass additional data through component props

## File Structure

```
resources/views/components/pos/
├── header.blade.php
├── waiter-auth-modal.blade.php
├── tables-section.blade.php
├── order-panel.blade.php
├── payment-modal.blade.php
├── menu-modal.blade.php
├── quantity-modal.blade.php
└── README.md

resources/js/
└── pos-system.js

public/css/
└── pos-demo.css
``` 