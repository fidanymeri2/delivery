<div class="payment-modal" id="paymentModal">
    <div class="payment-modal-content">
        <div class="payment-modal-header">
            <h3>{{ __('pos.select_payment_method') }}</h3>
            <button class="close-payment-btn" id="closePaymentModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="payment-modal-body">
            <div class="payment-options">
                <div class="payment-option" data-method="cash">
                    <div class="payment-icon">💰</div>
                    <div class="payment-info">
                        <h4>{{ __('pos.cash') }}</h4>
                        <p>{{ __('pos.pay_with_cash') }}</p>
                    </div>
                </div>
                <div class="payment-option" data-method="bank_transfer">
                    <div class="payment-icon">🏦</div>
                    <div class="payment-info">
                        <h4>{{ __('pos.bank_transfer') }}</h4>
                        <p>{{ __('pos.pay_via_bank_transfer') }}</p>
                    </div>
                </div>
            </div>
            <div class="payment-summary">
                <div class="summary-row">
                    <span>{{ __('pos.total_amount') }}:</span>
                    <span id="paymentTotal">{{ __('pos.currency_symbol') }}0.00</span>
                </div>
            </div>
            <div class="payment-actions">
                <button class="action-btn secondary" id="cancelPayment">{{ __('pos.cancel') }}</button>
                <button class="action-btn primary" id="confirmPayment" disabled>{{ __('pos.confirm_payment') }}</button>
            </div>
        </div>
    </div>
</div> 