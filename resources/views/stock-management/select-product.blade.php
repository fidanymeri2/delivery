<x-app-layout>
    <style>
        .select-product-container {
            padding: 1.5rem;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1.125rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .product-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .product-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .product-category {
            font-size: 0.875rem;
            color: #64748b;
        }

        .stock-info {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stock-quantity {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-unit {
            font-size: 0.875rem;
            color: #64748b;
            text-transform: uppercase;
        }

        .stock-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-out-of-stock {
            background: #fef2f2;
            color: #dc2626;
        }

        .status-low-stock {
            background: #fffbeb;
            color: #d97706;
        }

        .status-normal {
            background: #f0fdf4;
            color: #059669;
        }

        .status-overstock {
            background: #eff6ff;
            color: #2563eb;
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .adjust-button {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            display: block;
            transition: all 0.3s ease;
        }

        .adjust-button:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-1px);
        }

        .disable-button {
            flex: 1;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            display: block;
            transition: all 0.3s ease;
        }

        .disable-button:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-1px);
        }

        .enable-button {
            flex: 1;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            display: block;
            transition: all 0.3s ease;
        }

        .enable-button:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-1px);
        }

        .tab-navigation {
            display: flex;
            background: white;
            border-radius: 12px;
            padding: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .tab-button {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            background: transparent;
            color: #64748b;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .tab-button.active {
            background: #3b82f6;
            color: white;
        }

        .tab-button:hover:not(.active) {
            background: #f1f5f9;
            color: #374151;
        }

        .search-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-section {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .filter-button {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            color: #374151;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .filter-button:hover {
            background: #f3f4f6;
        }

        .filter-button.active:hover {
            background: #2563eb;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-section {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }

            .tab-navigation {
                flex-direction: column;
            }

            .tab-button {
                margin-bottom: 0.25rem;
            }
        }
    </style>

    <div class="select-product-container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb" style="margin-bottom: 1rem; color: #64748b; font-size: 0.875rem;">
            <a href="{{ route('dashboard') }}" style="color: #3b82f6; text-decoration: none;">Dashboard</a>
            <span style="margin: 0 0.5rem;">›</span>
            <a href="{{ route('stock-management.index') }}" style="color: #3b82f6; text-decoration: none;">Stock Management</a>
            <span style="margin: 0 0.5rem;">›</span>
            <span style="color: #64748b;">Select Product</span>
        </div>

        <div class="page-header">
            <h1 class="page-title">
                @if($tab === 'stock-needed')
                    Select Product for Stock Adjustment
                @else
                    Products Without Stock Tracking
                @endif
            </h1>
            <p class="page-subtitle">
                @if($tab === 'stock-needed')
                    Choose a product to adjust its stock levels or disable stock tracking
                @else
                    Products that don't require inventory management. You can enable stock tracking if needed.
                @endif
            </p>
        </div>

        @if(session('success'))
            <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="{{ route('stock-management.select-product', ['tab' => 'stock-needed']) }}" 
               class="tab-button {{ $tab === 'stock-needed' ? 'active' : '' }}">
                📦 Products with Stock Tracking ({{ App\Models\Product::where('requires_stock', true)->count() }})
            </a>
            <a href="{{ route('stock-management.select-product', ['tab' => 'no-stock-needed']) }}" 
               class="tab-button {{ $tab === 'no-stock-needed' ? 'active' : '' }}">
                ❌ Products without Stock Tracking ({{ App\Models\Product::where('requires_stock', false)->count() }})
            </a>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <input type="text" id="searchInput" class="search-input" placeholder="Search products by name..." />
            <div class="filter-section">
                <button class="filter-button active" data-filter="all">All Products</button>
                <button class="filter-button" data-filter="low-stock">Low Stock</button>
                <button class="filter-button" data-filter="out-of-stock">Out of Stock</button>
                <button class="filter-button" data-filter="normal">Normal Stock</button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="productsGrid">
            @forelse($products as $product)
                <div class="product-card" 
                     data-name="{{ strtolower($product->name) }}"
                     data-status="{{ $product->getStockStatus() }}">
                    <div class="product-header">
                        <div>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-category">{{ $product->category->name ?? 'No Category' }}</div>
                        </div>
                    </div>
                    
                    @if($tab === 'stock-needed')
                        <div class="stock-info">
                            <div>
                                <div class="stock-quantity">{{ $product->current_stock }}</div>
                                <div class="stock-unit">{{ $product->stock_unit }}</div>
                            </div>
                            <div class="stock-status status-{{ $product->getStockStatus() }}">
                                {{ ucfirst(str_replace('_', ' ', $product->getStockStatus())) }}
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <a href="{{ route('stock-management.adjust-stock', $product) }}" class="adjust-button">
                                Adjust Stock
                            </a>
                            <form action="{{ route('stock-management.disable-tracking', $product) }}" method="POST" style="flex: 1;" onsubmit="return confirmDisableStock('{{ $product->name }}')">
                                @csrf
                                <button type="submit" class="disable-button">
                                    No Stock Needed
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="stock-info">
                            <div>
                                <div class="stock-quantity" style="color: #64748b; font-size: 1rem;">No Stock Tracking</div>
                                <div class="stock-unit" style="color: #64748b;">Disabled</div>
                            </div>
                            <div class="stock-status" style="background: #f1f5f9; color: #64748b;">
                                No Tracking
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <form action="{{ route('stock-management.enable-tracking', $product) }}" method="POST" style="flex: 1;" onsubmit="return confirmEnableStock('{{ $product->name }}')">
                                @csrf
                                <button type="submit" class="enable-button">
                                    Enable Stock Tracking
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">{{ $tab === 'stock-needed' ? '📦' : '❌' }}</div>
                    <h3>No Products Found</h3>
                    <p>
                        @if($tab === 'stock-needed')
                            No products with stock tracking enabled found.
                        @else
                            No products without stock tracking found.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const productsGrid = document.getElementById('productsGrid');
            const filterButtons = document.querySelectorAll('.filter-button');
            const productCards = document.querySelectorAll('.product-card');

            // Search functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                productCards.forEach(card => {
                    const productName = card.dataset.name;
                    const isVisible = productName.includes(searchTerm);
                    card.style.display = isVisible ? 'block' : 'none';
                });
            });

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    
                    productCards.forEach(card => {
                        const status = card.dataset.status;
                        const isVisible = filter === 'all' || status === filter;
                        card.style.display = isVisible ? 'block' : 'none';
                    });
                });
            });
        });

        // Confirmation function for disabling stock tracking
        function confirmDisableStock(productName) {
            return confirm(`Are you sure you want to disable stock tracking for "${productName}"?\n\nThis will:\n• Remove this product from stock management\n• Set current stock to 0\n• Disable stock alerts\n• This action cannot be undone\n\nClick OK to continue or Cancel to abort.`);
        }

        // Confirmation function for enabling stock tracking
        function confirmEnableStock(productName) {
            return confirm(`Are you sure you want to enable stock tracking for "${productName}"?\n\nThis will:\n• Add this product to stock management\n• Set initial stock to 0\n• Enable stock alerts\n• Set default stock levels\n\nClick OK to continue or Cancel to abort.`);
        }
    </script>
</x-app-layout> 