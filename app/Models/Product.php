<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    protected $casts = [
        'requires_stock' => 'boolean',
        'low_stock_alert' => 'boolean',
        'current_stock' => 'integer',
        'min_stock_level' => 'integer',
        'max_stock_level' => 'integer',
        'last_stock_update' => 'datetime',
        'new_product' => 'boolean',
        'new_offers' => 'boolean',
        'suggested' => 'boolean',
        'status' => 'boolean'
    ];
    
    // Relationship with the ProductSize model
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // Relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Stock management relationships
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function stockAlerts()
    {
        return $this->hasMany(StockAlert::class);
    }

    // Method to get price for a specific size
    public function getPriceForSize($size)
    {
        $sizeEntry = $this->sizes()->where('size', $size)->first();
        return $sizeEntry ? $sizeEntry->price : null;
    }

    public function extraProducts()
    {
        return $this->belongsToMany(ExtraProduct::class, 'product_extra', 'product_id', 'extra_product_id');
    }

    // Stock management methods
    public function isLowStock()
    {
        if (!$this->requires_stock || !$this->low_stock_alert) {
            return false;
        }
        return $this->current_stock <= $this->min_stock_level;
    }

    public function isOutOfStock()
    {
        if (!$this->requires_stock) {
            return false;
        }
        return $this->current_stock <= 0;
    }

    public function isOverstock()
    {
        if (!$this->requires_stock || !$this->max_stock_level) {
            return false;
        }
        return $this->current_stock > $this->max_stock_level;
    }

    public function getStockStatus()
    {
        if (!$this->requires_stock) {
            return 'no_tracking';
        }

        if ($this->isOutOfStock()) {
            return 'out_of_stock';
        }

        if ($this->isLowStock()) {
            return 'low_stock';
        }

        if ($this->isOverstock()) {
            return 'overstock';
        }

        return 'normal';
    }

    public function getStockStatusColor()
    {
        $colors = [
            'no_tracking' => 'text-gray-500',
            'out_of_stock' => 'text-red-600',
            'low_stock' => 'text-orange-600',
            'overstock' => 'text-blue-600',
            'normal' => 'text-green-600'
        ];

        return $colors[$this->getStockStatus()] ?? 'text-gray-500';
    }

    public function getStockStatusLabel()
    {
        $labels = [
            'no_tracking' => 'No Stock Tracking',
            'out_of_stock' => 'Out of Stock',
            'low_stock' => 'Low Stock',
            'overstock' => 'Overstock',
            'normal' => 'In Stock'
        ];

        return $labels[$this->getStockStatus()] ?? 'Unknown';
    }

    public function canSell($quantity = 1)
    {
        if (!$this->requires_stock) {
            return true;
        }
        return $this->current_stock >= $quantity;
    }

    public function getAvailableStock()
    {
        return $this->requires_stock ? $this->current_stock : null;
    }

    /**
     * Get stock percentage (for progress bars)
     */
    public function getStockPercentage()
    {
        if (!$this->requires_stock || !$this->max_stock_level) {
            return null;
        }
        return min(100, ($this->current_stock / $this->max_stock_level) * 100);
    }

    /**
     * Get stock status for display
     */
    public function getStockStatusBadge()
    {
        $status = $this->getStockStatus();
        $badges = [
            'no_tracking' => '<span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">No Tracking</span>',
            'out_of_stock' => '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Out of Stock</span>',
            'low_stock' => '<span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">Low Stock</span>',
            'overstock' => '<span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Overstock</span>',
            'normal' => '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">In Stock</span>'
        ];

        return $badges[$status] ?? $badges['no_tracking'];
    }

    /**
     * Get formatted stock display
     */
    public function getFormattedStock()
    {
        if (!$this->requires_stock) {
            return 'No Stock Tracking';
        }

        $stock = $this->current_stock;
        $unit = $this->stock_unit;

        if ($this->isOutOfStock()) {
            return "0 {$unit} (Out of Stock)";
        }

        if ($this->isLowStock()) {
            return "{$stock} {$unit} (Low Stock)";
        }

        if ($this->isOverstock()) {
            return "{$stock} {$unit} (Overstock)";
        }

        return "{$stock} {$unit}";
    }

    /**
     * Get stock value based on average price
     */
    public function getStockValue()
    {
        if (!$this->requires_stock) {
            return 0;
        }

        $avgPrice = $this->sizes->avg('price') ?? 0;
        return $this->current_stock * $avgPrice;
    }

    /**
     * Check if stock needs reordering
     */
    public function needsReorder()
    {
        return $this->requires_stock && $this->low_stock_alert && $this->isLowStock();
    }

    /**
     * Get days until out of stock (estimated)
     */
    public function getDaysUntilOutOfStock($dailyUsage = null)
    {
        if (!$this->requires_stock || $this->current_stock <= 0) {
            return 0;
        }

        if ($dailyUsage === null) {
            // Estimate based on recent sales
            $recentSales = $this->stockTransactions()
                ->where('transaction_type', 'sale')
                ->where('created_at', '>=', now()->subDays(7))
                ->sum('quantity');
            
            $dailyUsage = $recentSales / 7;
        }

        if ($dailyUsage <= 0) {
            return 999; // No usage, won't run out soon
        }

        return floor($this->current_stock / $dailyUsage);
    }

    /**
     * Get stock movement trend
     */
    public function getStockTrend()
    {
        $recentTransactions = $this->stockTransactions()
            ->where('created_at', '>=', now()->subDays(30))
            ->get();

        if ($recentTransactions->isEmpty()) {
            return 'stable';
        }

        $totalIn = $recentTransactions->where('quantity', '>', 0)->sum('quantity');
        $totalOut = abs($recentTransactions->where('quantity', '<', 0)->sum('quantity'));

        if ($totalIn > $totalOut) {
            return 'increasing';
        } elseif ($totalOut > $totalIn) {
            return 'decreasing';
        } else {
            return 'stable';
        }
    }
}
