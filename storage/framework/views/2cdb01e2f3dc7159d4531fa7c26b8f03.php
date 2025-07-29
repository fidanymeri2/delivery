<div class="payment-modal" id="paymentModal">
    <div class="payment-modal-content">
        <div class="payment-modal-header">
            <h3><?php echo e(__('pos.select_payment_method')); ?></h3>
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
                        <h4><?php echo e(__('pos.cash')); ?></h4>
                        <p><?php echo e(__('pos.pay_with_cash')); ?></p>
                    </div>
                </div>
                <div class="payment-option" data-method="bank_transfer">
                    <div class="payment-icon">🏦</div>
                    <div class="payment-info">
                        <h4><?php echo e(__('pos.bank_transfer')); ?></h4>
                        <p><?php echo e(__('pos.pay_via_bank_transfer')); ?></p>
                    </div>
                </div>
            </div>
            <div class="payment-summary">
                <div class="summary-row">
                    <span><?php echo e(__('pos.total_amount')); ?>:</span>
                    <span id="paymentTotal"><?php echo e(__('pos.currency_symbol')); ?>0.00</span>
                </div>
            </div>
            <div class="payment-actions">
                <button class="action-btn secondary" id="cancelPayment"><?php echo e(__('pos.cancel')); ?></button>
                <button class="action-btn primary" id="confirmPayment" disabled><?php echo e(__('pos.confirm_payment')); ?></button>
            </div>
        </div>
    </div>
</div> <?php /**PATH C:\laragon\www\delivery\resources\views/components/pos/payment-modal.blade.php ENDPATH**/ ?>