<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\StockManagementService;
use Illuminate\Console\Command;

class SetupStockManagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:setup {--product-id= : Specific product ID to setup} {--enable-all : Enable stock tracking for all products}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup stock management for products';

    protected $stockService;

    /**
     * Create a new command instance.
     */
    public function __construct(StockManagementService $stockService)
    {
        parent::__construct();
        $this->stockService = $stockService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Setting up Stock Management System...');
        $this->newLine();

        if ($this->option('product-id')) {
            $this->setupSingleProduct($this->option('product-id'));
        } elseif ($this->option('enable-all')) {
            $this->setupAllProducts();
        } else {
            $this->interactiveSetup();
        }

        $this->info('✅ Stock management setup completed!');
    }

    /**
     * Setup a single product
     */
    private function setupSingleProduct($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            $this->error("Product with ID {$productId} not found!");
            return;
        }

        $this->setupProductStock($product);
    }

    /**
     * Setup all products
     */
    private function setupAllProducts()
    {
        $products = Product::where('requires_stock', false)->get();
        
        if ($products->isEmpty()) {
            $this->info('No products found that need stock setup.');
            return;
        }

        $this->info("Found {$products->count()} products without stock tracking.");
        
        if (!$this->confirm('Do you want to enable stock tracking for all products?')) {
            return;
        }

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        foreach ($products as $product) {
            $this->setupProductStock($product, false);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    /**
     * Interactive setup
     */
    private function interactiveSetup()
    {
        $products = Product::where('requires_stock', false)->get();
        
        if ($products->isEmpty()) {
            $this->info('All products already have stock tracking enabled!');
            return;
        }

        $this->info("Found {$products->count()} products without stock tracking.");
        $this->newLine();

        $choices = [
            '1' => 'Setup specific product',
            '2' => 'Setup all products',
            '3' => 'Exit'
        ];

        $choice = $this->choice('What would you like to do?', $choices);

        switch ($choice) {
            case '1':
                $this->setupSpecificProduct($products);
                break;
            case '2':
                $this->setupAllProducts();
                break;
            case '3':
                $this->info('Setup cancelled.');
                return;
        }
    }

    /**
     * Setup specific product interactively
     */
    private function setupSpecificProduct($products)
    {
        $productChoices = $products->pluck('name', 'id')->toArray();
        $productId = $this->choice('Select a product to setup:', $productChoices);
        
        $product = Product::find($productId);
        $this->setupProductStock($product);
    }

    /**
     * Setup stock for a single product
     */
    private function setupProductStock($product, $interactive = true)
    {
        if ($interactive) {
            $this->info("Setting up stock for: {$product->name}");
            $this->newLine();
        }

        // Enable stock tracking
        $product->update(['requires_stock' => true]);

        if ($interactive) {
            // Get stock unit
            $unitChoices = [
                'copë' => 'copë (pieces)',
                'porcion' => 'porcion (portions)',
                'artikull' => 'artikull (items)',
                'gram' => 'gram (g)',
                'kilogram' => 'kilogram (kg)',
                'litër' => 'litër (L)',
                'mililitër' => 'mililitër (ml)',
                'decilitër' => 'decilitër (dl)',
                'shishe' => 'shishe (bottles)',
                'kuti' => 'kuti (boxes)',
                'thes' => 'thes (bags)',
                'lugë' => 'lugë (spoons)',
                'filxhan' => 'filxhan (cups)',
                'gotë' => 'gotë (glasses)'
            ];

            $stockUnit = $this->choice('Select stock unit:', $unitChoices);
            
            // Get current stock
            $currentStock = $this->ask('Enter current stock quantity:', 0);
            
            // Get minimum stock level
            $minStock = $this->ask('Enter minimum stock level (for alerts):', 5);
            
            // Get maximum stock level
            $maxStock = $this->ask('Enter maximum stock level (optional, press Enter to skip):', null);
            
            // Enable low stock alerts
            $enableAlerts = $this->confirm('Enable low stock alerts?', true);

            $product->update([
                'stock_unit' => $stockUnit,
                'current_stock' => $currentStock,
                'min_stock_level' => $minStock,
                'max_stock_level' => $maxStock ?: null,
                'low_stock_alert' => $enableAlerts
            ]);

            // Create initial stock transaction if stock > 0
            if ($currentStock > 0) {
                $this->stockService->addStock($product, $currentStock, [
                    'transaction_type' => 'initial',
                    'notes' => 'Initial stock setup via command'
                ]);
            }

            $this->info("✅ Stock setup completed for {$product->name}");
            $this->info("   Unit: {$stockUnit}");
            $this->info("   Current Stock: {$currentStock}");
            $this->info("   Min Level: {$minStock}");
            if ($maxStock) {
                $this->info("   Max Level: {$maxStock}");
            }
            $this->info("   Alerts: " . ($enableAlerts ? 'Enabled' : 'Disabled'));
        } else {
            // Default setup for bulk operations
            $product->update([
                'stock_unit' => 'copë',
                'current_stock' => 0,
                'min_stock_level' => 5,
                'low_stock_alert' => true
            ]);
        }
    }
} 