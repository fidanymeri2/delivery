<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurant Tables') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/tables-canvas.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="page-header">
                        <h3 class="page-title">Restaurant Tables</h3>
                        <div class="header-actions">
                            <a href="{{ route('table-categories.index') }}" class="header-btn secondary">
                                Manage Categories
                            </a>
                            <a href="{{ route('restaurant-tables.create') }}" class="header-btn primary">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add New Table
                            </a>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('restaurant-tables.index') }}" class="flex space-x-3">
                            <select name="category" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Filter
                            </button>
                            @if(request('category'))
                                <a href="{{ route('restaurant-tables.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tables Canvas -->
                    <div class="tables-container">
                        @php
                            $groupedTables = $tables->groupBy('table_category_id');
                        @endphp
                        
                        @foreach($groupedTables as $categoryId => $categoryTables)
                            @php
                                $category = $categories->firstWhere('id', $categoryId);
                            @endphp
                            
                            <div class="category-section">
                                <div class="category-header">
                                    <div class="category-header-left">
                                        <span class="category-indicator"></span>
                                        {{ $category ? $category->name : 'Unknown Category' }}
                                        <span class="category-count">({{ $categoryTables->count() }} tables)</span>
                                    </div>
                                    <a href="{{ route('restaurant-tables.show-category', $categoryId) }}" 
                                       class="show-all-btn">
                                        Show All Tables
                                    </a>
                                </div>
                                
                                <div class="tables-grid">
                                    @foreach($categoryTables as $table)
                                        <div class="table-card {{ $table->status }}">
                                            <!-- Table Header -->
                                            <div class="table-header">
                                                <div class="table-header-content">
                                                    <h4 class="table-number">{{ $table->table_number }}</h4>
                                                    <span class="status-dot {{ $table->status }}"></span>
                                                </div>
                                            </div>
                                            
                                            <!-- Table Body -->
                                            <div class="table-body">
                                                <div class="table-info">
                                                    <div class="info-row">
                                                        <svg class="info-icon" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ $table->capacity }} seats
                                                    </div>
                                                    <div class="status-text {{ $table->status }}">
                                                        {{ ucfirst($table->status) }}
                                                    </div>
                                                    @if($table->notes)
                                                        <div class="table-notes" title="{{ $table->notes }}">
                                                            {{ Str::limit($table->notes, 20) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Hover Actions -->
                                            <div class="hover-actions">
                                                <a href="{{ route('restaurant-tables.edit', $table) }}" 
                                                   class="action-btn edit">
                                                    Edit
                                                </a>
                                                <form action="{{ route('restaurant-tables.destroy', $table) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="action-btn delete"
                                                            onclick="return confirm('Are you sure you want to delete this table?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Add New Table Card for this Category -->
                                    <a href="{{ route('restaurant-tables.create', ['category' => $categoryId]) }}" 
                                       class="add-table-card">
                                        <div class="add-table-content">
                                            <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <span class="add-text">Add Table</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Empty State -->
                        @if($tables->isEmpty())
                            <div class="empty-state">
                                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <h3 class="empty-title">No tables found</h3>
                                <p class="empty-description">Get started by creating a new table.</p>
                                <a href="{{ route('restaurant-tables.create') }}" class="empty-action">
                                    Add New Table
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 