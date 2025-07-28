<div class="pos-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="header-title">{{ __('pos.restaurant_pos_system') }}</h1>
            <p class="header-subtitle">{{ __('pos.point_of_sale_management') }}</p>
        </div>
        <div class="header-right">
            <div class="header-info">
                <span class="current-time" id="currentTime"></span>
                <span class="current-date" id="currentDate"></span>
            </div>
            <div class="waiter-display" id="waiterDisplay" style="display: none;">
                <span class="waiter-label">{{ __('pos.logged_in_as') }}</span>
                <span class="waiter-name" id="headerWaiterName">{{ __('pos.waiter') }}</span>
                <button class="logout-btn" id="logoutBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('pos.logout') }}
                </button>
            </div>
            <a href="{{ route('dashboard') }}" class="back-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('pos.back_to_dashboard') }}
            </a>
        </div>
    </div>
</div> 