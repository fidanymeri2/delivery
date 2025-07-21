<x-app-layout>
    <style>
        .card {
            background-color: #fff;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-header {
            font-size: 1.25rem;
            color: #2854C5;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .icons {
            color: #2854C5; 
            font-size: 2rem; 
            display: inline-block;
            margin-bottom: 10px; 
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
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .no-underline {
            text-decoration: none;
        }
        .active {
            font-weight: bold;
            color: #007bff; 
        }
    </style>

    <div class="container">
    <a href="{{ route('products.stats') }}" class="no-underline {{ Route::currentRouteName() == 'products.stats' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-chart-line"></i></span>
                <div class="card-header">Stats</div>
            </div>
        </a>


        <a href="{{ route('messages.index') }}" class="no-underline {{ Route::currentRouteName() == 'messages.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="far fa-comment-alt"></i></span>
                <div class="card-header">Messages</div>
            </div>
        </a>

        <a href="{{ route('documents.index') }}" class="no-underline {{ Route::currentRouteName() == 'documents.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-file-alt"></i></span>
                <div class="card-header">Documents</div>
            </div>
        </a>

        <a href="{{ route('users.index') }}" class="no-underline {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-users"></i></span>
                <div class="card-header">Users</div>
            </div>
        </a>

        <a href="{{ route('partners.index') }}" class="no-underline {{ Route::currentRouteName() == 'partners.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-handshake"></i></span>
                <div class="card-header">Partners</div>
            </div>
        </a>

        <a href="{{ route('shipping-fees.index') }}" class="no-underline {{ Route::currentRouteName() == 'shipping-fees.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-truck"></i></span>
                <div class="card-header">Shipping Fees</div>
            </div>
        </a>

        <a href="{{ route('banners.index') }}" class="no-underline {{ Route::currentRouteName() == 'banners.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-ad"></i></span>
                <div class="card-header">Banners</div>
            </div>
        </a>

        <a href="{{ route('feedbacks.index') }}" class="no-underline {{ Route::currentRouteName() == 'feedbacks.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-star"></i></span>
                <div class="card-header">Feedbacks</div>
            </div>
        </a>
    </div>
</x-app-layout>
