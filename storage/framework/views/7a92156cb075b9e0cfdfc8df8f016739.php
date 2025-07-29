<div class="modal-overlay" id="quantityModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><?php echo e(__('pos.add_to_order')); ?></h3>
            <button class="modal-close" id="closeModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="product-details">
                <h4 id="modalProductName"></h4>
                <p id="modalProductPrice"></p>
            </div>
            <div class="quantity-controls">
                <button class="qty-btn" id="decreaseQty">-</button>
                <input type="number" id="quantityInput" value="1" min="1" max="10">
                <button class="qty-btn" id="increaseQty">+</button>
            </div>
            <div class="notes-section">
                <label for="quantityNotes" class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('pos.special_instructions')); ?></label>
                <textarea id="quantityNotes" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                          placeholder="<?php echo e(__('pos.add_special_instructions')); ?>"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn secondary" id="cancelAdd"><?php echo e(__('pos.cancel')); ?></button>
            <button class="modal-btn primary" id="confirmAdd"><?php echo e(__('pos.add_to_order_btn')); ?></button>
        </div>
    </div>
</div> <?php /**PATH C:\laragon\www\delivery\resources\views/components/pos/quantity-modal.blade.php ENDPATH**/ ?>