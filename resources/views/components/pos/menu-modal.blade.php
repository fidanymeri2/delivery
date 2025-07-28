<div class="modal-overlay" id="menuModal">
    <div class="modal-content menu-modal">
        <div class="modal-header">
            <h3>{{ __('pos.menu_products') }}</h3>
            <div class="selected-table-info">
                <span class="table-label">{{ __('pos.table') }}</span>
                <span class="table-number" id="modalTableNumber">{{ __('pos.none') }}</span>
            </div>
            <button class="modal-close" id="closeMenuModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="modal-body menu-modal-body">
            <!-- Product Categories -->
            <div class="product-categories">
                <div class="search-container">
                    <input type="text" id="productSearch" placeholder="{{ __('pos.search_products') }}" class="product-search">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button class="category-tab active" data-category="all">
                    {{ __('pos.all_items') }}
                </button>
                @foreach($productCategories as $category)
                    <button class="category-tab" data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-item" data-category="{{ $product->category_id }}">
                        <div class="product-info">
                            <h4 class="product-name">{{ $product->name }}</h4>
                            <div class="product-price">
                                @if($product->sizes->count() > 0)
                                    {{ __('pos.currency_symbol') }}{{ number_format($product->sizes->first()->price, 2) }}
                                @else
                                    <span style="color: #9ca3af;">{{ __('pos.no_price_set') }}</span>
                                @endif
                            </div>
                        </div>
                        <button class="add-to-table-btn" 
                                data-product-id="{{ $product->id }}" 
                                data-product-name="{{ $product->name }}" 
                                data-product-price="{{ $product->sizes->count() > 0 ? $product->sizes->first()->price : 0 }}"
                                {{ $product->sizes->count() == 0 ? 'disabled' : '' }}>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            {{ __('pos.add_to_order') }}
                        </button>
                    </div>
                @endforeach
                
                <!-- No products found message -->
                <div id="noProductsMessage" class="no-products-message" style="display: none;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3>{{ __('pos.no_products_found') }}</h3>
                    <p>{{ __('pos.try_adjusting_search') }}</p>
                </div>
            </div>
        </div>
    </div>
</div> 