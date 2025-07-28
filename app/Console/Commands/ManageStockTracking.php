<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;

class ManageStockTracking extends Command
{
    protected $signature = 'stock:manage {action : Action to perform (list, disable, enable, setup)} {--product-id= : Specific product ID} {--category-id= : Category ID to affect all products in that category} {--all : Affect all products}';

    protected $description = 'Manage stock tracking for products';

    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listProducts();
                break;
            case 'disable':
                $this->disableStockTracking();
                break;
            case 'enable':
                $this->enableStockTracking();
                break;
            case 'setup':
                $this->interactiveSetup();
                break;
            default:
                $this->error('Invalid action. Use: list, disable, enable, or setup');
                return 1;
        }

        return 0;
    }

    private function listProducts()
    {
        $this->info('📋 Product Stock Tracking Status:');
        $this->newLine();

        $products = Product::with('category')->get(['id', 'name', 'category_id', 'requires_stock', 'current_stock']);

        $headers = ['ID', 'Name', 'Category', 'Stock Tracking', 'Current Stock'];
        $rows = [];

        foreach ($products as $product) {
            $rows[] = [
                $product->id,
                $product->name,
                $product->category ? $product->category->name : 'N/A',
                $product->requires_stock ? '✅ Yes' : '❌ No',
                $product->requires_stock ? $product->current_stock . ' copë' : 'N/A'
            ];
        }

        $this->table($headers, $rows);
    }

    private function disableStockTracking()
    {
        $productId = $this->option('product-id');
        $categoryId = $this->option('category-id');
        $all = $this->option('all');

        if ($productId) {
            $product = Product::find($productId);
            if (!$product) {
                $this->error("Product with ID {$productId} not found.");
                return;
            }
            
            $product->update([
                'requires_stock' => false,
                'current_stock' => 0,
                'min_stock_level' => 0,
                'max_stock_level' => null,
                'stock_unit' => null,
                'low_stock_alert' => false
            ]);
            
            $this->info("✅ Disabled stock tracking for: {$product->name}");
        } elseif ($categoryId) {
            $category = Category::find($categoryId);
            if (!$category) {
                $this->error("Category with ID {$categoryId} not found.");
                return;
            }

            $count = Product::where('category_id', $categoryId)->update([
                'requires_stock' => false,
                'current_stock' => 0,
                'min_stock_level' => 0,
                'max_stock_level' => null,
                'stock_unit' => null,
                'low_stock_alert' => false
            ]);

            $this->info("✅ Disabled stock tracking for {$count} products in category: {$category->name}");
        } elseif ($all) {
            if (!$this->confirm('Are you sure you want to disable stock tracking for ALL products?')) {
                $this->info('Operation cancelled.');
                return;
            }

            $count = Product::query()->update([
                'requires_stock' => false,
                'current_stock' => 0,
                'min_stock_level' => 0,
                'max_stock_level' => null,
                'stock_unit' => null,
                'low_stock_alert' => false
            ]);

            $this->info("✅ Disabled stock tracking for {$count} products.");
        } else {
            $this->error('Please specify --product-id, --category-id, or --all');
        }
    }

    private function enableStockTracking()
    {
        $productId = $this->option('product-id');
        $categoryId = $this->option('category-id');
        $all = $this->option('all');

        if ($productId) {
            $product = Product::find($productId);
            if (!$product) {
                $this->error("Product with ID {$productId} not found.");
                return;
            }
            
            $product->update(['requires_stock' => true]);
            $this->info("✅ Enabled stock tracking for: {$product->name}");
        } elseif ($categoryId) {
            $category = Category::find($categoryId);
            if (!$category) {
                $this->error("Category with ID {$categoryId} not found.");
                return;
            }

            $count = Product::where('category_id', $categoryId)->update(['requires_stock' => true]);
            $this->info("✅ Enabled stock tracking for {$count} products in category: {$category->name}");
        } elseif ($all) {
            if (!$this->confirm('Are you sure you want to enable stock tracking for ALL products?')) {
                $this->info('Operation cancelled.');
                return;
            }

            $count = Product::query()->update(['requires_stock' => true]);
            $this->info("✅ Enabled stock tracking for {$count} products.");
        } else {
            $this->error('Please specify --product-id, --category-id, or --all');
        }
    }

    private function interactiveSetup()
    {
        $this->info('🎯 Interactive Stock Tracking Setup');
        $this->newLine();

        // Show categories
        $categories = Category::all();
        $this->info('Available Categories:');
        foreach ($categories as $category) {
            $productCount = $category->products()->count();
            $stockCount = $category->products()->where('requires_stock', true)->count();
            $this->line("  {$category->id}. {$category->name} ({$productCount} products, {$stockCount} with stock tracking)");
        }

        $this->newLine();
        $this->info('Choose an option:');
        $this->line('1. Disable stock tracking for specific products');
        $this->line('2. Disable stock tracking for entire category');
        $this->line('3. Enable stock tracking for specific products');
        $this->line('4. Enable stock tracking for entire category');
        $this->line('5. View current status');

        $choice = $this->choice('Select option', ['1', '2', '3', '4', '5']);

        switch ($choice) {
            case '1':
                $this->disableSpecificProducts();
                break;
            case '2':
                $this->disableCategoryProducts();
                break;
            case '3':
                $this->enableSpecificProducts();
                break;
            case '4':
                $this->enableCategoryProducts();
                break;
            case '5':
                $this->listProducts();
                break;
        }
    }

    private function disableSpecificProducts()
    {
        $this->info('Select products to disable stock tracking:');
        
        $products = Product::where('requires_stock', true)->with('category')->get();
        
        if ($products->isEmpty()) {
            $this->info('No products with stock tracking enabled.');
            return;
        }

        $choices = [];
        foreach ($products as $product) {
            $choices[$product->id] = "{$product->name} ({$product->category?->name}) - Current: {$product->current_stock} copë";
        }

        $selectedIds = $this->choice('Select products to disable stock tracking (use space to select multiple):', $choices, null, null, true);

        if (empty($selectedIds)) {
            $this->info('No products selected.');
            return;
        }

        $count = Product::whereIn('id', $selectedIds)->update([
            'requires_stock' => false,
            'current_stock' => 0,
            'min_stock_level' => 0,
            'max_stock_level' => null,
            'stock_unit' => null,
            'low_stock_alert' => false
        ]);

        $this->info("✅ Disabled stock tracking for {$count} products.");
    }

    private function disableCategoryProducts()
    {
        $categories = Category::all();
        $choices = [];
        foreach ($categories as $category) {
            $stockCount = $category->products()->where('requires_stock', true)->count();
            if ($stockCount > 0) {
                $choices[$category->id] = "{$category->name} ({$stockCount} products with stock tracking)";
            }
        }

        if (empty($choices)) {
            $this->info('No categories have products with stock tracking enabled.');
            return;
        }

        $categoryId = $this->choice('Select category to disable stock tracking:', $choices);

        $category = Category::find($categoryId);
        $count = Product::where('category_id', $categoryId)->where('requires_stock', true)->update([
            'requires_stock' => false,
            'current_stock' => 0,
            'min_stock_level' => 0,
            'max_stock_level' => null,
            'stock_unit' => null,
            'low_stock_alert' => false
        ]);

        $this->info("✅ Disabled stock tracking for {$count} products in category: {$category->name}");
    }

    private function enableSpecificProducts()
    {
        $this->info('Select products to enable stock tracking:');
        
        $products = Product::where('requires_stock', false)->with('category')->get();
        
        if ($products->isEmpty()) {
            $this->info('All products already have stock tracking enabled.');
            return;
        }

        $choices = [];
        foreach ($products as $product) {
            $choices[$product->id] = "{$product->name} ({$product->category?->name})";
        }

        $selectedIds = $this->choice('Select products to enable stock tracking (use space to select multiple):', $choices, null, null, true);

        if (empty($selectedIds)) {
            $this->info('No products selected.');
            return;
        }

        $count = Product::whereIn('id', $selectedIds)->update(['requires_stock' => true]);
        $this->info("✅ Enabled stock tracking for {$count} products.");
    }

    private function enableCategoryProducts()
    {
        $categories = Category::all();
        $choices = [];
        foreach ($categories as $category) {
            $noStockCount = $category->products()->where('requires_stock', false)->count();
            if ($noStockCount > 0) {
                $choices[$category->id] = "{$category->name} ({$noStockCount} products without stock tracking)";
            }
        }

        if (empty($choices)) {
            $this->info('All categories already have stock tracking enabled for their products.');
            return;
        }

        $categoryId = $this->choice('Select category to enable stock tracking:', $choices);

        $count = Product::where('category_id', $categoryId)->where('requires_stock', false)->update(['requires_stock' => true]);

        $category = Category::find($categoryId);
        $this->info("✅ Enabled stock tracking for {$count} products in category: {$category->name}");
    }
} 