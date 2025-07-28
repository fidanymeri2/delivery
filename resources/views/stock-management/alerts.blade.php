<x-app-layout>
    <style>
        .alerts-page {
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

        .alerts-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

        .stat-icon.critical {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .stat-icon.high {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .stat-icon.medium {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .stat-icon.low {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

        .filters-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .filter-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-button {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: end;
        }

        .filter-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .alert-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .alert-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .alert-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .alert-info {
            flex: 1;
        }

        .alert-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .alert-message {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        .alert-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.75rem;
            color: #64748b;
        }

        .alert-priority {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .alert-priority.critical {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-priority.high {
            background: #fef3c7;
            color: #92400e;
        }

        .alert-priority.medium {
            background: #dbeafe;
            color: #1e40af;
        }

        .alert-priority.low {
            background: #dcfce7;
            color: #166534;
        }

        .alert-content {
            padding: 1.5rem;
        }

        .product-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .product-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }

        .product-details h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .product-details p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        .stock-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stock-item {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .stock-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stock-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-value.current {
            color: #3b82f6;
        }

        .stock-value.threshold {
            color: #f59e0b;
        }

        .stock-value.minimum {
            color: #ef4444;
        }

        .alert-actions {
            display: flex;
            gap: 0.75rem;
        }

        .action-button {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-button.acknowledge {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .action-button.acknowledge:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .action-button.resolve {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .action-button.resolve:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .action-button.secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .action-button.secondary:hover {
            background: #e5e7eb;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            font-size: 1rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .alerts-stats {
                grid-template-columns: 1fr;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .alerts-grid {
                grid-template-columns: 1fr;
            }

            .stock-info {
                grid-template-columns: 1fr;
            }

            .alert-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="alerts-page">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ __('stock-management.stock_alerts') }}</h1>
            <p class="page-subtitle">{{ __('stock-management.manage_stock_notifications') }}</p>
        </div>

        <!-- Alert Statistics -->
        <div class="alerts-stats">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon critical">🚨</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.critical_alerts') }}</h3>
                        <p>{{ __('stock-management.high_priority_notifications') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['critical'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon high">⚠️</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.high_priority') }}</h3>
                        <p>{{ __('stock-management.medium_priority_notifications') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['high'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon medium">📊</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.medium_priority') }}</h3>
                        <p>{{ __('stock-management.low_priority_notifications') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['medium'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon low">✅</div>
                    <div class="stat-info">
                        <h3>{{ __('stock-management.resolved') }}</h3>
                        <p>{{ __('stock-management.completed_notifications') }}</p>
                    </div>
                </div>
                <div class="stat-value">{{ $stats['resolved'] }}</div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <form method="GET" action="{{ route('stock-management.alerts') }}">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">{{ __('stock-management.product') }}</label>
                        <select name="product_id" class="filter-input">
                            <option value="">{{ __('stock-management.all_products') }}</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('stock-management.alert_type') }}</label>
                        <select name="alert_type" class="filter-input">
                            <option value="">{{ __('stock-management.all_types') }}</option>
                            <option value="low_stock" {{ request('alert_type') == 'low_stock' ? 'selected' : '' }}>{{ __('stock-management.low_stock') }}</option>
                            <option value="out_of_stock" {{ request('alert_type') == 'out_of_stock' ? 'selected' : '' }}>{{ __('stock-management.out_of_stock') }}</option>
                            <option value="overstock" {{ request('alert_type') == 'overstock' ? 'selected' : '' }}>{{ __('stock-management.status_overstock') }}</option>
                            <option value="expiring_soon" {{ request('alert_type') == 'expiring_soon' ? 'selected' : '' }}>{{ __('stock-management.expiring_soon') }}</option>
                            <option value="custom" {{ request('alert_type') == 'custom' ? 'selected' : '' }}>{{ __('stock-management.custom') }}</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('stock-management.priority') }}</label>
                        <select name="priority" class="filter-input">
                            <option value="">{{ __('stock-management.all_priorities') }}</option>
                            <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>{{ __('stock-management.critical') }}</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>{{ __('stock-management.high') }}</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>{{ __('stock-management.medium') }}</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>{{ __('stock-management.low') }}</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select name="status" class="filter-input">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="acknowledged" {{ request('status') == 'acknowledged' ? 'selected' : '' }}>Acknowledged</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <button type="submit" class="filter-button">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Alerts Grid -->
        <div class="alerts-grid">
            @if($alerts->count() > 0)
                @foreach($alerts as $alert)
                    <div class="alert-card">
                        <div class="alert-header">
                            <div class="alert-info">
                                <h3 class="alert-title">{{ $alert->title }}</h3>
                                <p class="alert-message">{{ $alert->message }}</p>
                                <div class="alert-meta">
                                    <span>{{ $alert->created_at->format('M d, Y H:i') }}</span>
                                    <span>•</span>
                                    <span>{{ $alert->getAlertTypeLabel() }}</span>
                                </div>
                            </div>
                            <span class="alert-priority {{ $alert->priority }}">
                                {{ ucfirst($alert->priority) }}
                            </span>
                        </div>

                        <div class="alert-content">
                            <div class="product-info">
                                <div class="product-icon">📦</div>
                                <div class="product-details">
                                    <h4>{{ $alert->product->name }}</h4>
                                    <p>{{ $alert->product->category->name }}</p>
                                </div>
                            </div>

                            <div class="stock-info">
                                <div class="stock-item">
                                    <div class="stock-label">Current Stock</div>
                                    <div class="stock-value current">{{ $alert->current_stock }} {{ $alert->product->stock_unit }}</div>
                                </div>
                                <div class="stock-item">
                                    <div class="stock-label">Threshold</div>
                                    <div class="stock-value threshold">{{ $alert->threshold_stock }} {{ $alert->product->stock_unit }}</div>
                                </div>
                                <div class="stock-item">
                                    <div class="stock-label">Min Level</div>
                                    <div class="stock-value minimum">{{ $alert->product->min_stock_level }} {{ $alert->product->stock_unit }}</div>
                                </div>
                            </div>

                            <div class="alert-actions">
                                @if($alert->status === 'active')
                                    <form method="POST" action="{{ route('stock-management.acknowledge-alert', $alert) }}" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="action-button acknowledge">Acknowledge</button>
                                    </form>
                                    <form method="POST" action="{{ route('stock-management.resolve-alert', $alert) }}" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="action-button resolve">Resolve</button>
                                    </form>
                                @elseif($alert->status === 'acknowledged')
                                    <form method="POST" action="{{ route('stock-management.resolve-alert', $alert) }}" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="action-button resolve">Resolve</button>
                                    </form>
                                    <button class="action-button secondary" style="flex: 1;" disabled>Acknowledged</button>
                                @else
                                    <button class="action-button secondary" style="flex: 1;" disabled>Resolved</button>
                                    <button class="action-button secondary" style="flex: 1;" disabled>Resolved</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">✅</div>
                    <h3 class="empty-state-title">No Alerts Found</h3>
                    <p class="empty-state-text">No stock alerts match your current filters.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($alerts->count() > 0)
            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $alerts->links() }}
            </div>
        @endif
    </div>
</x-app-layout> 