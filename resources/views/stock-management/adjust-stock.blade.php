<x-app-layout>
    <style>
        .adjust-stock-page {
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

        .adjustment-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .product-card {
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

        .stock-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stock-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .stock-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stock-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-value.current {
            color: #3b82f6;
        }

        .stock-value.minimum {
            color: #ef4444;
        }

        .stock-value.maximum {
            color: #10b981;
        }

        .stock-value.unit {
            color: #64748b;
            font-size: 1rem;
        }

        .adjustment-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 100px;
            transition: border-color 0.3s ease;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .quantity-preview {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            border: 1px solid #e2e8f0;
        }

        .preview-label {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .preview-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .preview-value.positive {
            color: #059669;
        }

        .preview-value.negative {
            color: #dc2626;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #fecaca;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #bbf7d0;
        }

        @media (max-width: 768px) {
            .product-info {
                flex-direction: column;
                text-align: center;
            }

            .product-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .stock-overview {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="adjust-stock-page">
        <!-- Page Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <a href="{{ route('stock-management.index') }}">{{ __('stock-management.stock_management_dashboard') }}</a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('stock-management.product-stock', $product) }}">{{ $product->name }}</a>
                <span class="breadcrumb-separator">/</span>
                <span>{{ __('stock-management.adjust_stock') }}</span>
            </div>
            <h1 class="page-title">{{ __('stock-management.adjust_stock') }}</h1>
            <p class="page-subtitle">{{ __('stock-management.adjust_product_inventory') }}</p>
        </div>

        <div class="adjustment-container">
            <!-- Product Information -->
            <div class="product-card">
                <div class="product-header">
                    <div class="product-info">
                        <div class="product-icon">📦</div>
                        <div class="product-details">
                            <h2>{{ $product->name }}</h2>
                            <p>{{ $product->description }}</p>
                            <span class="product-category">{{ $product->category->name }}</span>
                        </div>
                    </div>

                    <div class="stock-overview">
                        <div class="stock-item">
                            <div class="stock-label">{{ __('stock-management.current_stock_level') }}</div>
                            <div class="stock-value current">{{ $product->current_stock }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label">{{ __('stock-management.minimum_stock_level') }}</div>
                            <div class="stock-value minimum">{{ $product->min_stock_level }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label">Maximum Level</div>
                            <div class="stock-value maximum">{{ $product->max_stock_level }} {{ $product->stock_unit }}</div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-label">{{ __('stock-management.stock_unit') }}</div>
                            <div class="stock-value unit">{{ $product->stock_unit }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adjustment Form -->
            <div class="adjustment-form">
                <h3 class="form-title">{{ __('stock-management.adjust_stock') }}</h3>

                @if($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('stock-management.process-adjustment', $product) }}">
                    @csrf
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">{{ __('stock-management.adjustment_type') }}</label>
                            <select name="transaction_type" class="form-select" required>
                                <option value="">{{ __('stock-management.select_type') }}</option>
                                <option value="purchase" {{ old('transaction_type') == 'purchase' ? 'selected' : '' }}>{{ __('stock-management.purchase') }}</option>
                                <option value="sale" {{ old('transaction_type') == 'sale' ? 'selected' : '' }}>{{ __('stock-management.sale') }}</option>
                                <option value="adjustment" {{ old('transaction_type') == 'adjustment' ? 'selected' : '' }}>{{ __('stock-management.adjustment') }}</option>
                                <option value="return" {{ old('transaction_type') == 'return' ? 'selected' : '' }}>{{ __('stock-management.return') }}</option>
                                <option value="damage" {{ old('transaction_type') == 'damage' ? 'selected' : '' }}>{{ __('stock-management.damage') }}</option>
                                <option value="transfer" {{ old('transaction_type') == 'transfer' ? 'selected' : '' }}>{{ __('stock-management.transfer') }}</option>
                                <option value="correction" {{ old('transaction_type') == 'correction' ? 'selected' : '' }}>{{ __('stock-management.correction') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('stock-management.adjustment_quantity') }}</label>
                            <input type="number" name="quantity" class="form-input" step="0.01" value="{{ old('quantity') }}" required>
                            <small class="text-gray-500">{{ __('stock-management.quantity_help_text') }}</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('stock-management.unit_cost') }} ({{ __('stock-management.currency_symbol') }})</label>
                            <input type="number" name="unit_cost" class="form-input" step="0.01" value="{{ old('unit_cost', 0) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('stock-management.reference_number') }}</label>
                            <input type="text" name="reference_number" class="form-input" value="{{ old('reference_number') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('stock-management.supplier_name') }}</label>
                            <input type="text" name="supplier_name" class="form-input" value="{{ old('supplier_name') }}">
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">{{ __('stock-management.notes') }}</label>
                            <textarea name="notes" class="form-textarea" placeholder="{{ __('stock-management.notes_placeholder') }}">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Quantity Preview -->
                    <div class="quantity-preview">
                        <div class="preview-label">{{ __('stock-management.stock_after_adjustment') }}:</div>
                        <div class="preview-value" id="stock-preview">
                            {{ $product->current_stock }} {{ $product->stock_unit }}
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">{{ __('stock-management.apply_adjustment') }}</button>
                        <a href="{{ route('stock-management.product-stock', $product) }}" class="btn btn-secondary">{{ __('stock-management.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Live preview of stock after adjustment
        document.querySelector('input[name="quantity"]').addEventListener('input', function() {
            const currentStock = {{ $product->current_stock }};
            const quantity = parseFloat(this.value) || 0;
            const newStock = currentStock + quantity;
            const unit = '{{ $product->stock_unit }}';
            
            const preview = document.getElementById('stock-preview');
            preview.textContent = newStock + ' ' + unit;
            
            if (newStock < 0) {
                preview.className = 'preview-value negative';
            } else if (newStock < {{ $product->min_stock_level }}) {
                preview.className = 'preview-value negative';
            } else {
                preview.className = 'preview-value positive';
            }
        });
    </script>
</x-app-layout> 