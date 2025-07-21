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
    <link rel="stylesheet" href="{{ asset('build/assets/app-0zNOfxlS.css') }}" data-navigate-track="reload" />
    <script type="module" src="{{ asset('build/assets/app-C1-XIpUa.js') }}" data-navigate-track="reload"></script>
    @livewireStyles
    <style>
    .burger-menu {
        display: none;
        cursor: pointer;
    }
    .sidebar {
    position: fixed;
    top: 70px; 
    left: 10px;
    background: #2e4ead;
    width: 200px;
    height: calc(100vh - 70px); 
    
    border-bottom-left-radius: 20px;
    transition: all 0.3s ease;
    overflow-y: auto; 
    display: flex;
    flex-direction: column;
}
.sidebar::-webkit-scrollbar {
    width: 12px; 
}

.sidebar::-webkit-scrollbar-track {
    background: #2e4ead; 
}

.sidebar::-webkit-scrollbar-thumb {
    background: #1e40af; 
    border-radius: 10px; 
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #1a3a8f; 
}


.sidebar ul {
    padding: 0;
    margin: 0;
    list-style-type: none;
}

.sidebar ul li a {
    display: block;
    padding: 20px;
    position: relative;
    margin-bottom: 1px;
    color: #92a6e2;
    white-space: nowrap;
    transition: background-color 0.3s ease, color 0.3s ease;
    text-decoration: none; 
}
    

    @media (max-width: 768px) {
        .burger-menu {
            display: block;
            padding: 10px;
            font-size: 1.5rem;
        }

        .sidebar {
            position: fixed; 
            top: 60px; 
            left: 0;
            width: 200px; 
            height: calc(100% - 60px); 
            background: #fff;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none; 
        }

        .sidebar.active {
            display: block;
        }

        .main_container.full-width {
            width: 100%;
            margin-left: 0;
        }
    }
</style>

</head>
<body class="font-sans antialiased">
    <x-banner />
    <div class="wrapper">
        <div class="top_navbar">
            <div class="top_menu">
                <div class="logo">YUMIIS</div>
                <!-- Burger menu button -->
                <div class="burger-menu" id="burger-menu">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                    <li><a href="#" class="no-underline"><i class="fas fa-search"></i></a></li>
                    <li><a href="#" id="fullscreen-toggle" class="no-underline"><i class="fas fa-expand"></i></a></li>
                    <li>
                        <a href="{{ route('storage.link.create') }}" class="no-underline">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </a>
                    </li>
                    <li><a href="{{ route('profile.show') }}" class="no-underline"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
        <ul>
    @if (auth()->user()->hasRole('admin'))
        <li>
            <a href="{{ route('dashboard') }}" class="no-underline {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="no-underline {{ Route::currentRouteName() == 'products.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Products</span>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="no-underline {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-th"></i></span>
                <span class="title">Category</span>
            </a>
        </li>
        <li>
            <a href="{{ route('extra-products.index') }}" class="no-underline {{ Route::currentRouteName() == 'extra-products.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Extra Products</span>
            </a>
        </li>
        <li>
            <a href="{{ route('description_categories.index') }}" class="no-underline {{ Route::currentRouteName() == 'description_categories.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-box"></i></span>
                <span class="title">Description Category</span>
            </a>
        </li>
        <li>
            <a href="{{ route('extra-categories.index') }}" class="no-underline {{ Route::currentRouteName() == 'extra-categories.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-th"></i></span>
                <span class="title">Extra Category</span>
            </a>
        </li>
        <li>
            <a href="{{ route('orders.new') }}" class="no-underline {{ Route::currentRouteName() == 'orders.new' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-bell"></i></span>
                <span class="title">New Orders</span>
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}" class="no-underline {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="title">Orders</span>
            </a>
        </li>
        <li>
            <a href="{{ route('reservations.index') }}" class="no-underline {{ Route::currentRouteName() == 'reservations.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-calendar"></i></span>
                <span class="title">Reservations</span>
            </a>
        </li>
        <li>
            <a href="{{ route('settings.index') }}" class="no-underline {{ Route::currentRouteName() == 'settings.index' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-cog"></i></span>
                <span class="title">Settings</span>
            </a>
        </li>
    @elseif (auth()->user()->hasRole('delivery'))
        <li>
            <a href="{{ route('orders.new') }}" class="no-underline {{ Route::currentRouteName() == 'orders.new' ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-bell"></i></span>
                <span class="title">New Orders</span>
            </a>
        </li>
    @endif
</ul>

            <form method="POST" action="{{ route('logout') }}" x-data class="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="title">Logout</span>
                </button>
            </form>
        </div>
        <div class="main_container full-width" id="main-container">
            {{ $slot }}
        </div>
    </div>
    <!-- Scripts -->
    @livewireScripts
    <script>
        document.getElementById('fullscreen-toggle').addEventListener('click', function () {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        const burgerMenu = document.getElementById('burger-menu');
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('main-container');
        const links = document.querySelectorAll('.sidebar a');

        // Toggle sidebar visibility
        burgerMenu.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            mainContainer.classList.toggle('full-width');
        });

        // Hide sidebar when clicking a menu item
        links.forEach(link => {
            link.addEventListener('click', function () {
                sidebar.classList.remove('active');
                mainContainer.classList.add('full-width');
            });
        });
    </script>
</body>
</html>
