<x-app-layout>
    <style>
        .product-stock-page {
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

        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb-separator {
            margin: 0 0.5rem;
        }

        .product-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-overview {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .product-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .product-info {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .product-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .product-details h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .product-details p {
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .product-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #e0e7ff;
            color: #3730a3;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .stock-status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .stock-status.in-stock {
            background: #dcfce7;
            color: #166534;
        }

        .stock-status.low-stock {
            background: #fef3c7;
            color: #92400e;
        }

        .stock-status.out-of-stock {
            background: #fee2e2;
            color: #991b1b;
        }

        .stock-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-value.current {
            color: #3b82f6;
        }

        .stat-value.minimum {
            color: #ef4444;
        }

        .stat-value.maximum {
            color: #10b981;
        }

        .stat-value.value {
            color: #059669;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .card-action {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .card-action:hover {
            color: #2563eb;
        }

        .transactions-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.3s ease;
        }

        .transaction-item:hover {
            background: #f8fafc;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-info {
            flex: 1;
        }

        .transaction-type {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .transaction-type.purchase {
            background: #dcfce7;
            color: #166534;
        }

        .transaction-type.sale {
            background: #fee2e2;
            color: #991b1b;
        }

        .transaction-type.adjustment {
            background: #dbeafe;
            color: #1e40af;
        }

        .transaction-type.return {
            background: #fef3c7;
            color: #92400e;
        }

        .transaction-type.damage {
            background: #fecaca;
            color: #7f1d1d;
        }

        .transaction-type.transfer {
            background: #e0e7ff;
            color: #3730a3;
        }

        .transaction-type.initial {
            background: #f3e8ff;
            color: #581c87;
        }

        .transaction-type.correction {
            background: #fef2f2;
            color: #7f1d1d;
        }

        .transaction-date {
            font-size: 0.875rem;
            color: #64748b;
        }

        .transaction-quantity {
            text-align: right;
        }

        .quantity-value {
            font-weight: 700;
            font-size: 1.125rem;
        }

        .quantity-value.positive {
            color: #059669;
        }

        .quantity-value.negative {
            color: #dc2626;
        }

        .quantity-label {
            font-size: 0.75rem;
            color: #64748b;
        }

        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .action-button {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px solid transparent;
            border-radius: 12px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #e2e8f0;
        }

        .action-button-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .action-button-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .action-button-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .action-button-icon.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .action-button-content h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .action-button-content p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        .alerts-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .alert-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.3s ease;
        }

        .alert-item:hover {
            background: #f8fafc;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .alert-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.875rem;
        }

        .alert-priority {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
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

        .alert-message {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .alert-date {
            font-size: 0.75rem;
            color: #64748b;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .product-info {
                flex-direction: column;
                text-align: center;
            }

            .product-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .stock-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="product-stock-page">
        <!-- Page Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <a href="{{ route('stock-management.index') }}">Stock Management</a>
                <span class="breadcrumb-separator">/</span>
                <span>{{ $product->name }}</span>
            </div>
            <h1 class="page-title">{{ $product->name }}</h1>
            <p class="page-subtitle">Stock details and transaction history</p>
        </div>

        <div class="product-container">
            <!-- Product Overview -->
            <div class="product-overview">
                <div class="product-header">
                    <div class="product-info">
                        <div class="product-icon">📦</div>
                        <div class="product-details">
                            <h2>{{ $product->name }}</h2>
                            <p>{{ $product->description }}</p>
                            <span class="product-category">{{ $product->category->name }}</span>
                            <span class="stock-status {{ $product->getStockStatus() }}">
                                {{ ucfirst(str_replace('_', ' ', $product->getStockStatus())) }}
                            </span>
                        </div>
                    </div>

                    <div class="stock-stats">
                        <div class="stat-item">
                            <div class="stat-label">Current Stock</div>
                            <div class="stat-value current">{{ $product->current_stock }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Minimum Level</div>
                            <div class="stat-value minimum">{{ $product->min_stock_level }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Maximum Level</div>
                            <div class="stat-value maximum">{{ $product->max_stock_level }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Stock Value</div>
                            <div class="stat-value value">€{{ number_format($stockValue, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <div class="main-content">
                    <!-- Recent Transactions -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Transactions</h3>
                            <a href="{{ route('stock-management.transactions') }}?product_id={{ $product->id }}" class="card-action">View All</a>
                        </div>
                        <div class="transactions-list">
                            @if($recentTransactions->count() > 0)
                                @foreach($recentTransactions as $transaction)
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <span class="transaction-type {{ $transaction->transaction_type }}">
                                                {{ $transaction->getTransactionTypeLabel() }}
                                            </span>
                                            <div class="transaction-date">{{ $transaction->created_at->format('M d, Y H:i') }}</div>
                                        </div>
                                        <div class="transaction-quantity">
                                            <div class="quantity-value {{ $transaction->quantity >= 0 ? 'positive' : 'negative' }}">
                                                {{ $transaction->getFormattedQuantity() }} {{ $product->stock_unit }}
                                            </div>
                                            <div class="quantity-label">{{ $transaction->quantity_after }} total</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">📊</div>
                                    <p>No transactions found</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="sidebar">
                    <!-- Quick Actions -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="quick-actions">
                            <a href="{{ route('stock-management.adjust-stock', $product) }}" class="action-button">
                                <div class="action-button-icon blue">📝</div>
                                <div class="action-button-content">
                                    <h4>Adjust Stock</h4>
                                    <p>Update stock levels</p>
                                </div>
                            </a>

                            <a href="{{ route('products.edit', $product) }}" class="action-button">
                                <div class="action-button-icon green">⚙️</div>
                                <div class="action-button-content">
                                    <h4>Edit Product</h4>
                                    <p>Modify stock settings</p>
                                </div>
                            </a>

                            <a href="{{ route('stock-management.alerts') }}?product_id={{ $product->id }}" class="action-button">
                                <div class="action-button-icon red">⚠️</div>
                                <div class="action-button-content">
                                    <h4>View Alerts</h4>
                                    <p>Check notifications</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Active Alerts -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Active Alerts</h3>
                            <a href="{{ route('stock-management.alerts') }}?product_id={{ $product->id }}" class="card-action">View All</a>
                        </div>
                        <div class="alerts-list">
                            @if($activeAlerts->count() > 0)
                                @foreach($activeAlerts as $alert)
                                    <div class="alert-item">
                                        <div class="alert-header">
                                            <div class="alert-title">{{ $alert->title }}</div>
                                            <span class="alert-priority {{ $alert->priority }}">
                                                {{ ucfirst($alert->priority) }}
                                            </span>
                                        </div>
                                        <div class="alert-message">{{ $alert->message }}</div>
                                        <div class="alert-date">{{ $alert->created_at->format('M d, Y H:i') }}</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">✅</div>
                                    <p>No active alerts</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 