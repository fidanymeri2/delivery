<div class="tables-section full-width" id="tablesSection">
    <div class="section-header">
        <h3 class="section-title">{{ __('pos.restaurant_tables') }}</h3>
        <div class="section-subtitle" id="tablesSubtitle">{{ __('pos.select_category_to_view_tables') }}</div>
    </div>

    <!-- Categories View -->
    <div class="categories-view" id="categoriesView">
        <div class="categories-grid">
            @foreach($categories as $category)
                <div class="category-card" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">
                    <div class="category-card-content">
                        <h4 class="category-card-title">{{ $category->name }}</h4>
                        <button class="view-tables-btn">{{ __('pos.view_tables') }}</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tables Canvas View -->
    <div class="tables-canvas-view" id="tablesCanvasView" style="display: none;">
        <div class="canvas-header">
            <button class="back-to-categories-btn" id="backToCategories">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('pos.back_to_categories') }}
            </button>
            <h4 class="canvas-category-title" id="canvasCategoryTitle"></h4>
            <div class="canvas-stats" id="canvasStats"></div>
        </div>
        
        <div class="canvas-container">
            <div class="canvas-boundary" id="tablesCanvas">
                <!-- Tables will be dynamically added here -->
            </div>
        </div>
    </div>
</div> 