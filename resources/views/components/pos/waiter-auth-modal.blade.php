<div class="waiter-auth-modal" id="waiterAuthModal">
    <div class="waiter-auth-content">
        <div class="waiter-auth-header">
            <h3>{{ __('pos.waiter_authentication') }}</h3>
            <p>{{ __('pos.enter_pin_code') }}</p>
        </div>
        <div class="waiter-auth-body">
            <div class="pin-input-container">
                <input type="password" id="waiterPin" class="pin-input" maxlength="4" placeholder="{{ __('pos.enter_4_digit_pin') }}" autocomplete="off">
                <div class="pin-dots" id="pinDots">
                    <span class="pin-dot"></span>
                    <span class="pin-dot"></span>
                    <span class="pin-dot"></span>
                    <span class="pin-dot"></span>
                </div>
            </div>
            <div class="pin-error" id="pinError" style="display: none;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ __('pos.invalid_pin_code') }}</span>
            </div>
            <div class="waiter-info" id="waiterInfo" style="display: none;">
                <div class="waiter-avatar">👤</div>
                <div class="waiter-details">
                    <h4 id="waiterName">{{ __('pos.waiter_name') }}</h4>
                    <p id="waiterId">{{ __('pos.id') }} 0</p>
                </div>
            </div>
            <div class="waiter-auth-actions">
                <button class="action-btn primary" id="loginBtn">{{ __('pos.login') }}</button>
                <button class="action-btn secondary" id="clearPinBtn">{{ __('pos.clear') }}</button>
            </div>
        </div>
    </div>
</div> 