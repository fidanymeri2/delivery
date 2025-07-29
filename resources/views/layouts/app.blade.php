<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-banner />

    <!-- Modern Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-6 py-2">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-4">
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <svg class="h-8 w-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496.59 94.19"><g><path class="fill-gray-800 dark:fill-white" d="M157.73,76.41c4.74,0,8.49-.81,11.24-2.43,2.75-1.62,4.12-3.97,4.12-7.06,0-1.36-.21-2.52-.62-3.5-.42-.98-1.15-1.82-2.2-2.54-1.06-.71-2.49-1.34-4.29-1.86-1.81-.53-4.07-1.05-6.78-1.58l-5.53-1.02c-3.61-.6-6.66-1.36-9.15-2.26-2.48-.9-4.52-2-6.1-3.28-1.58-1.28-2.71-2.78-3.39-4.52-.68-1.73-1.02-3.76-1.02-6.1,0-4.89,2.04-8.75,6.11-11.58,4.08-2.82,9.66-4.24,16.76-4.24,3.09,0,6.04.4,8.83,1.19,2.79.79,5.26,1.98,7.42,3.56,2.15,1.58,3.87,3.5,5.15,5.76,1.28,2.26,1.93,4.86,1.93,7.79h-8.25c0-3.62-1.36-6.44-4.07-8.47s-6.4-3.05-11.07-3.05-8.19.75-10.79,2.26c-2.6,1.51-3.9,3.61-3.9,6.33,0,1.36.21,2.5.62,3.45.41.94,1.13,1.77,2.15,2.49,1.02.72,2.45,1.36,4.29,1.92,1.84.56,4.16,1.11,6.95,1.64l5.53.79c3.69.6,6.78,1.36,9.26,2.26,2.48.9,4.5,2,6.04,3.28,1.54,1.28,2.65,2.79,3.33,4.52.68,1.73,1.02,3.73,1.02,5.99,0,2.79-.6,5.24-1.81,7.34-1.21,2.11-2.86,3.88-4.97,5.31-2.11,1.43-4.61,2.52-7.51,3.28-2.9.75-6.01,1.13-9.32,1.13s-6.21-.45-9.15-1.36c-2.94-.9-5.55-2.22-7.85-3.95-2.3-1.73-4.12-3.82-5.48-6.27-1.36-2.45-2.03-5.21-2.03-8.3h7.91c0,3.84,1.54,6.99,4.63,9.43,3.09,2.45,7.08,3.67,11.97,3.67Z"></path><path class="fill-gray-800 dark:fill-white" d="M189.25,53.82c0-4.44.66-8.45,1.98-12.03,1.32-3.58,3.21-6.64,5.66-9.21,2.45-2.56,5.39-4.54,8.83-5.93,3.43-1.39,7.22-2.09,11.37-2.09s8.05.7,11.49,2.09c3.43,1.39,6.36,3.37,8.77,5.93,2.41,2.56,4.28,5.63,5.6,9.21,1.32,3.58,1.98,7.59,1.98,12.03s-.66,8.36-1.98,11.97c-1.32,3.61-3.19,6.72-5.6,9.32-2.41,2.6-5.34,4.59-8.77,5.99-3.43,1.39-7.26,2.09-11.49,2.09s-7.94-.7-11.37-2.09c-3.43-1.39-6.38-3.37-8.83-5.93-2.45-2.56-4.34-5.65-5.66-9.26s-1.98-7.64-1.98-12.09ZM197.49,53.82c0,6.48,1.79,11.63,5.37,15.47,3.58,3.84,8.3,5.76,14.18,5.76s10.8-1.94,14.35-5.82c3.54-3.88,5.31-9.02,5.31-15.42,0-3.16-.47-6.04-1.41-8.64-.94-2.6-2.26-4.82-3.95-6.66-1.69-1.84-3.77-3.28-6.21-4.29-2.45-1.02-5.14-1.52-8.08-1.52-5.87,0-10.6,1.92-14.18,5.76-3.58,3.84-5.37,8.96-5.37,15.36Z"></path><path class="fill-gray-800 dark:fill-white" d="M258.26,11.23h8.47v70.83h-8.47V11.23Z"></path><path class="fill-gray-800 dark:fill-white" d="M328.06,46.81c0-3.16.52-6.06,1.56-8.7,1.04-2.63,2.49-4.87,4.35-6.72,1.86-1.84,4.14-3.28,6.85-4.29s5.68-1.52,8.92-1.52h8.98v7.68s-8.98,0-8.98,0c-4.29,0-7.61,1.21-9.94,3.61-2.33,2.41-3.5,5.72-3.5,9.94v35.24h-8.25v-35.24Z"></path><path class="fill-gray-800 dark:fill-white" d="M373.05,25.36h8.47v56.48h-8.47V25.36Z"></path><path class="fill-gray-800 dark:fill-white" d="M397.17,11.01h8.25v38.75h5l22.14-24.4h9.94l-25.42,28.24,27.33,28.24h-10.5l-23.61-24.4h-4.89v24.4h-8.25V11.01Z"></path><path class="fill-gray-800 dark:fill-white" d="M472.98,76.19c4.74,0,8.49-.81,11.24-2.43,2.75-1.62,4.12-3.97,4.12-7.06,0-1.36-.21-2.52-.62-3.5-.41-.98-1.15-1.82-2.2-2.54-1.06-.71-2.49-1.34-4.29-1.86-1.81-.53-4.07-1.05-6.78-1.58l-5.54-1.02c-3.61-.6-6.66-1.36-9.15-2.26-2.49-.9-4.52-2-6.1-3.28-1.58-1.28-2.71-2.78-3.39-4.52-.68-1.73-1.02-3.76-1.02-6.1,0-4.89,2.04-8.75,6.11-11.58,4.08-2.82,9.66-4.24,16.76-4.24,3.09,0,6.04.4,8.83,1.19,2.79.79,5.26,1.98,7.42,3.56,2.15,1.58,3.87,3.5,5.15,5.76,1.28,2.26,1.92,4.86,1.92,7.79h-8.25c0-3.62-1.36-6.44-4.07-8.47s-6.4-3.05-11.07-3.05-8.19.75-10.79,2.26c-2.6,1.51-3.9,3.61-3.9,6.33,0,1.36.21,2.5.62,3.45.41.94,1.13,1.77,2.15,2.49,1.02.72,2.45,1.36,4.29,1.92,1.84.56,4.16,1.11,6.95,1.64l5.53.79c3.69.6,6.78,1.36,9.26,2.26,2.48.9,4.5,2,6.04,3.28,1.54,1.28,2.65,2.79,3.33,4.52.68,1.73,1.02,3.73,1.02,5.99,0,2.79-.6,5.24-1.81,7.34-1.21,2.11-2.86,3.88-4.97,5.31-2.11,1.43-4.61,2.52-7.51,3.28-2.9.75-6.01,1.13-9.32,1.13s-6.21-.45-9.15-1.36c-2.94-.9-5.55-2.22-7.85-3.95-2.3-1.73-4.12-3.82-5.48-6.27-1.36-2.45-2.03-5.21-2.03-8.3h7.91c0,3.84,1.54,6.99,4.63,9.43,3.09,2.45,7.08,3.67,11.97,3.67Z"></path><path class="fill-gray-800 dark:fill-white" d="M314.85,33.71v-8.13h-19.49c2.38-3.54,3.56-8.17,3.56-13.89v-.38h-8.25v.38c0,2.64-.21,4.84-.62,6.61-.42,1.77-1.15,3.2-2.2,4.29-1.06,1.09-2.45,1.86-4.18,2.32-1.73.45-3.92.68-6.55.68v8.13h13.55v30.5c0,5.65,1.47,10.04,4.41,13.16,2.94,3.13,7.12,4.69,12.54,4.69h7.23v-8.25h-7.23c-5.8,0-8.7-3.2-8.7-9.6v-30.5h15.93Z"></path></g><g><path class="fill-teal-600" d="M73.12,94.19h-16.65V16.96h16.65c0,5.38.45,9.87,1.39,13.41.92,3.54,2.5,6.39,4.73,8.56,2.23,2.15,5.16,3.67,8.78,4.5,3.62.84,8.15,1.27,13.53,1.27h.78v16.89h-.78c-11.71,0-21.19-2.44-28.44-7.31v39.91Z"></path><path class="fill-teal-600" d="M29.22,0h16.65v77.23h-16.65c0-5.38-.45-9.87-1.39-13.41-.92-3.54-2.5-6.39-4.73-8.56-2.23-2.15-5.16-3.67-8.78-4.5-3.62-.84-8.15-1.27-13.53-1.27h-.78v-16.89h.78c11.71,0,21.19,2.44,28.44,7.31V0Z"></path></g></svg>

                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-[#0d9488]">
                            POS
                        </h1>
                        <p class="text-xs text-gray-500">Point of Sale System</p>
                    </div>
                </div>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center ">

                <!-- User Menu -->
                <div class="relative">
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 bg-[#0d9488] rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="hidden sm:block text-sm font-medium">{{ auth()->user()->name }}</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Modern Sidebar -->
    <aside id="sidebar" class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform duration-300 ease-in-out transform -translate-x-full lg:translate-x-0 bg-white border-r border-gray-200 shadow-lg">
        <div class="flex flex-col h-full">
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                @if (auth()->user()->hasRole('admin'))
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'dashboard' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-tachometer-alt text-lg"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Products -->
                    <a href="{{ route('products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'products.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-box text-lg"></i>
                        <span class="font-medium">Products</span>
                    </a>

                    <!-- Categories -->
                    <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'categories.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-th text-lg"></i>
                        <span class="font-medium">Categories</span>
                    </a>

                    <!-- Extra Products -->
                    <a href="{{ route('extra-products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'extra-products.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-boxes text-lg"></i>
                        <span class="font-medium">Extra Products</span>
                    </a>

                    <!-- Description Categories -->
                    <a href="{{ route('description_categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'description_categories.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-tags text-lg"></i>
                        <span class="font-medium">Description Categories</span>
                    </a>

                    <!-- Extra Categories -->
                    <a href="{{ route('extra-categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'extra-categories.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-layer-group text-lg"></i>
                        <span class="font-medium">Extra Categories</span>
                    </a>

                    <!-- Stock Management -->
                    <a href="{{ route('stock-management.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'stock-management.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-warehouse text-lg"></i>
                        <span class="font-medium">Stock Management</span>
                    </a>

                    <!-- New Orders -->
                    <a href="{{ route('orders.new') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'orders.new' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="font-medium">New Orders</span>
                    </a>

                    <!-- Orders -->
                    <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'orders.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span class="font-medium">Orders</span>
                    </a>

                    <!-- Reservations -->
                    <a href="{{ route('reservations.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'reservations.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-calendar text-lg"></i>
                        <span class="font-medium">Reservations</span>
                    </a>

                    <!-- Table Categories -->
                    <a href="{{ route('table-categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'table-categories.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-sitemap text-lg"></i>
                        <span class="font-medium">Table Categories</span>
                    </a>

                    <!-- Restaurant Tables -->
                    <a href="{{ route('restaurant-tables.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'restaurant-tables.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-table text-lg"></i>
                        <span class="font-medium">Restaurant Tables</span>
                    </a>

                    <!-- Table Orders -->
                    <a href="{{ route('table-orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'table-orders.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-utensils text-lg"></i>
                        <span class="font-medium">Table Orders</span>
                    </a>

                    <!-- POS System -->
                    <a href="{{ route('pos.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'pos.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-cash-register text-lg"></i>
                        <span class="font-medium">POS System</span>
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('settings.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'settings.index' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-cog text-lg"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                @elseif (auth()->user()->hasRole('delivery'))
                    <!-- New Orders for Delivery -->
                    <a href="{{ route('orders.new') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::currentRouteName() == 'orders.new' ? 'bg-[#0d9488] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50 hover:text-[#0d9488]' }}">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="font-medium">New Orders</span>
                    </a>
                @endif
            </nav>

            <!-- Logout Section -->
            <div class="p-3 border-t border-gray-200">
                <button onclick="document.getElementById('logout-form').submit()" style="margin-bottom:60px;" class="pb-5  w-full px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-all duration-200">
                    Logout
                </button>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" >
                    @csrf
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

    <!-- Main Content -->
    <main id="main-content" class="lg:ml-64 pt-16 min-h-screen transition-all duration-300 ease-in-out">
        <div class="p-6">
            {{ $slot }}
        </div>
    </main>

    <!-- Scripts -->
    @livewireScripts
    <script>
        // Fullscreen toggle
        document.getElementById('fullscreen-toggle').addEventListener('click', function () {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mainContent = document.getElementById('main-content');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on menu items (mobile only)
        const menuItems = sidebar.querySelectorAll('a');
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>
