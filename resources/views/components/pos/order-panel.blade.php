<div class="order-panel" id="orderPanel" style="display: none;">
    <div class="order-header">
        <div class="order-header-top">
            <h3 class="order-title">{{ __('pos.table_order') }}</h3>
            <button class="close-order-btn" id="closeOrderPanel">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="selected-table-info">
            <span class="table-label">{{ __('pos.table') }}</span>
            <span class="table-number" id="selectedTableNumber">{{ __('pos.none') }}</span>
        </div>
    </div>

    <div class="order-items" id="orderItems">
        <div class="empty-order">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <p>{{ __('pos.no_items_in_order') }}</p>
            <span>{{ __('pos.select_products_from_menu') }}</span>
        </div>
    </div>

    <div class="order-summary">
        <div class="summary-row">
            <span>{{ __('pos.subtotal') }}</span>
            <span id="subtotal">{{ __('pos.currency_symbol') }}0.00</span>
        </div>
        <div class="summary-row">
            <span>{{ __('pos.tax') }}</span>
            <span id="tax">{{ __('pos.currency_symbol') }}0.00</span>
        </div>
        <div class="summary-row total">
            <span>{{ __('pos.total') }}</span>
            <span id="total">{{ __('pos.currency_symbol') }}0.00</span>
        </div>
    </div>

    <div class="order-actions">
        <button class="action-btn secondary" id="clearOrder">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            {{ __('pos.clear_order') }}
        </button>
        <button class="action-btn primary" id="processOrder">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ __('pos.process_order') }}
        </button>
    </div>
</div> 