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
                <div class="card-header">{{ __('settings.stats') }}</div>
            </div>
        </a>


        <a href="{{ route('messages.index') }}" class="no-underline {{ Route::currentRouteName() == 'messages.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="far fa-comment-alt"></i></span>
                <div class="card-header">{{ __('settings.messages') }}</div>
            </div>
        </a>

        <a href="{{ route('documents.index') }}" class="no-underline {{ Route::currentRouteName() == 'documents.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-file-alt"></i></span>
                <div class="card-header">{{ __('settings.documents') }}</div>
            </div>
        </a>

        <a href="{{ route('users.index') }}" class="no-underline {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-users"></i></span>
                <div class="card-header">{{ __('settings.users') }}</div>
            </div>
        </a>

        <a href="{{ route('partners.index') }}" class="no-underline {{ Route::currentRouteName() == 'partners.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-handshake"></i></span>
                <div class="card-header">{{ __('settings.partners') }}</div>
            </div>
        </a>

        <a href="{{ route('shipping-fees.index') }}" class="no-underline {{ Route::currentRouteName() == 'shipping-fees.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-truck"></i></span>
                <div class="card-header">{{ __('settings.shipping_fees') }}</div>
            </div>
        </a>

        <a href="{{ route('banners.index') }}" class="no-underline {{ Route::currentRouteName() == 'banners.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-ad"></i></span>
                <div class="card-header">{{ __('settings.banners') }}</div>
            </div>
        </a>

        <a href="{{ route('feedbacks.index') }}" class="no-underline {{ Route::currentRouteName() == 'feedbacks.index' ? 'active' : '' }}">
            <div class="card">
                <span class="icons"><i class="fas fa-star"></i></span>
                <div class="card-header">{{ __('settings.feedbacks') }}</div>
            </div>
        </a>

        <!-- Language Selection Card -->
        <div class="card">
            <span class="icons"><i class="fas fa-globe"></i></span>
            <div class="card-header">{{ __('settings.language') }}</div>
            <form action="{{ route('settings.update-language') }}" method="POST" class="mt-3">
                @csrf
                <div class="flex flex-col space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="language" value="en" {{ auth()->user()->language == 'en' ? 'checked' : '' }} class="mr-2">
                        <span>{{ __('settings.english') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="language" value="sq" {{ auth()->user()->language == 'sq' ? 'checked' : '' }} class="mr-2">
                        <span>{{ __('settings.albanian') }}</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mt-3 w-full">{{ __('settings.save_changes') }}</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
</x-app-layout>
