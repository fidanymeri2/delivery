<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('POS System') }} - Restaurant Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pos-demo.css') }}">
</head>
<body class="font-sans antialiased">
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
    <script>
        // Pass category data to JavaScript
        const categoryData = @json($categories);
    </script>
</body>
</html>


</body>
</html> 