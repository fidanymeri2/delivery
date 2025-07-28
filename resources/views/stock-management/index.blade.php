<x-app-layout>
    <style>
        .stock-dashboard {
            padding: 1.5rem;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: #64748b;
            font-size: 1.125rem;
        }

        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .stat-icon.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .stat-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .stock-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .view-all-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .view-all-link:hover {
            text-decoration: underline;
        }

        .product-list {
            space-y: 1rem;
        }

        .product-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            background: #f8fafc;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .product-item:hover {
            background: #f1f5f9;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .product-category {
            font-size: 0.875rem;
            color: #64748b;
        }

        .stock-info {
            text-align: right;
        }

        .stock-quantity {
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }

        .stock-unit {
            font-size: 0.75rem;
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

        .unit-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .unit-category {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #3b82f6;
        }

        .unit-category h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .unit-category p {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .unit-examples {
            font-size: 0.75rem;
            color: #64748b;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .action-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .action-description {
            color: #64748b;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .stock-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-overview {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="stock-dashboard">
        <div class="dashboard-header">
            <h1 class="dashboard-title">{{ __('stock-management.stock_management_dashboard') }}</h1>
            <p class="dashboard-subtitle">{{ __('stock-management.monitor_manage_inventory') }}</p>
        </div>

        <!-- Stock Unit Categories -->
        <div class="unit-categories">
            <div class="unit-category">
                <h3>{{ __('stock-management.quantity_pieces') }}</h3>
                <p>{{ __('stock-management.packaged_served_products') }}</p>
                <div class="unit-examples">{{ __('stock-management.pieces_portions_items') }}</div>
            </div>
            <div class="unit-category">
                <h3>{{ __('stock-management.weight_mass') }}</h3>
                <p>{{ __('stock-management.meat_cheese_vegetables_flour_sugar') }}</p>
                <div class="unit-examples">{{ __('stock-management.grams_kg') }}</div>
            </div>
            <div class="unit-category">
                <h3>{{ __('stock-management.volume_liquids') }}</h3>
                <p>{{ __('stock-management.drinks_milk_wines_water_juices') }}</p>
                <div class="unit-examples">{{ __('stock-management.liters_ml') }}</div>
            </div>
            <div class="unit-category">
                <h3>{{ __('stock-management.package_units') }}</h3>
                <p>{{ __('stock-management.packaged_supplies') }}</p>
                <div class="unit-examples">{{ __('stock-management.bottles_boxes_bags') }}</div>
            </div>
            <div class="unit-category">
                <h3>{{ __('stock-management.consumption_units') }}</h3>
                <p>{{ __('stock-management.more_for_recipes_kitchen_consumption') }}</p>
                <div class="unit-examples">{{ __('stock-management.spoons_cups_glasses') }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="{{ route('stock-management.select-product') }}" class="action-card">
                <div class="action-icon">📦</div>
                <div class="action-title">{{ __('stock-management.add_stock') }}</div>
                <div class="action-description">{{ __('stock-management.add_new_inventory_products') }}</div>
            </a>
            <a href="{{ route('stock-management.transactions') }}" class="action-card">
                <div class="action-icon">📊</div>
                <div class="action-title">{{ __('stock-management.view_transactions') }}</div>
                <div class="action-description">{{ __('stock-management.track_all_stock_movements') }}</div>
            </a>
            <a href="{{ route('stock-management.alerts') }}" class="action-card">
                <div class="action-icon">🔔</div>
                <div class="action-title">{{ __('stock-management.stock_alerts') }}</div>
                <div class="action-description">{{ __('stock-management.manage_low_stock_notifications') }}</div>
            </a>
            <a href="{{ route('stock-management.export-report') }}" class="action-card">
                <div class="action-icon">📄</div>
                <div class="action-title">{{ __('stock-management.export_report') }}</div>
                <div class="action-description">{{ __('stock-management.generate_stock_reports') }}</div>
            </a>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon green">📦</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.total_products') }}</h3>
                        <p>{{ __('stock-management.with_stock_tracking') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $summary['total_products'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon red">⚠️</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.out_of_stock') }}</h3>
                        <p>{{ __('stock-management.products_with_zero_stock') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $summary['out_of_stock'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon orange">📉</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.low_stock') }}</h3>
                        <p>{{ __('stock-management.below_minimum_level') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $summary['low_stock'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">📈</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.normal_stock') }}</h3>
                        <p>{{ __('stock-management.within_acceptable_range') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $summary['normal_stock'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon purple">💰</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.total_value') }}</h3>
                        <p>{{ __('stock-management.stock_inventory_value') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ __('stock-management.currency_symbol') }}{{ number_format($summary['total_stock_value'], 2) }}</div>
            </div>
        </div>

        <!-- Stock Sections -->
        <div class="stock-grid">
            <!-- Low Stock Products -->
            <div class="stock-section">
                <div class="section-header">
                    <h2 class="section-title">{{ __('stock-management.low_stock_products') }}</h2>
                    <a href="{{ route('stock-management.alerts') }}" class="view-all-link">{{ __('stock-management.view_all') }}</a>
                </div>
                <div class="product-list">
                    @forelse($lowStockProducts->take(5) as $product)
                        <div class="product-item">
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-category">{{ $product->category->name ?? __('stock-management.no_category') }}</div>
                            </div>
                            <div class="stock-info">
                                <div class="stock-quantity">{{ $product->current_stock }}</div>
                                <div class="stock-unit">{{ $product->stock_unit }}</div>
                                <div class="stock-status status-low-stock">{{ __('stock-management.status_low_stock') }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">{{ __('stock-management.no_low_stock_products') }}</p>
                    @endforelse
                </div>
            </div>

            <!-- Out of Stock Products -->
            <div class="stock-section">
                <div class="section-header">
                    <h2 class="section-title">{{ __('stock-management.out_of_stock_products') }}</h2>
                    <a href="{{ route('stock-management.alerts') }}" class="view-all-link">{{ __('stock-management.view_all') }}</a>
                </div>
                <div class="product-list">
                    @forelse($outOfStockProducts->take(5) as $product)
                        <div class="product-item">
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-category">{{ $product->category->name ?? __('stock-management.no_category') }}</div>
                            </div>
                            <div class="stock-info">
                                <div class="stock-quantity">{{ $product->current_stock }}</div>
                                <div class="stock-unit">{{ $product->stock_unit }}</div>
                                <div class="stock-status status-out-of-stock">{{ __('stock-management.status_out_of_stock') }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">{{ __('stock-management.no_out_of_stock_products') }}</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="stock-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('stock-management.recent_stock_transactions') }}</h2>
                <a href="{{ route('stock-management.transactions') }}" class="view-all-link">{{ __('stock-management.view_all') }}</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('stock-management.product') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('stock-management.type') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('stock-management.quantity') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('stock-management.user') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('stock-management.date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $transaction->product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $transaction->product->stock_unit }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $transaction->transaction_type === 'purchase' ? 'bg-green-100 text-green-800' : 
                                           ($transaction->transaction_type === 'sale' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ __('stock-management.' . $transaction->transaction_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transaction->quantity > 0 ? '+' : '' }}{{ $transaction->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $transaction->user->name ?? 'System' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $transaction->created_at->format('M d, Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">{{ __('stock-management.no_recent_transactions') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 