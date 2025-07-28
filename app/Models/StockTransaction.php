<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'table_order_id',
        'transaction_type',
        'quantity',
        'quantity_before',
        'quantity_after',
        'unit_cost',
        'total_cost',
        'reference_number',
        'supplier_name',
        'notes',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'quantity_before' => 'integer',
        'quantity_after' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tableOrder()
    {
        return $this->belongsTo(TableOrder::class);
    }

    // Scopes
    public function scopePurchases($query)
    {
        return $query->where('transaction_type', 'purchase');
    }

    public function scopeSales($query)
    {
        return $query->where('transaction_type', 'sale');
    }

    public function scopeAdjustments($query)
    {
        return $query->where('transaction_type', 'adjustment');
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Helper methods
    public function isInbound()
    {
        return in_array($this->transaction_type, ['purchase', 'return', 'initial', 'correction']) && $this->quantity > 0;
    }

    public function isOutbound()
    {
        return in_array($this->transaction_type, ['sale', 'damage', 'transfer']) || $this->quantity < 0;
    }

    public function getFormattedQuantity()
    {
        $sign = $this->quantity >= 0 ? '+' : '';
        return $sign . $this->quantity;
    }

    public function getTransactionTypeLabel()
    {
        $labels = [
            'purchase' => 'Purchase',
            'sale' => 'Sale',
            'adjustment' => 'Adjustment',
            'return' => 'Return',
            'damage' => 'Damage/Loss',
            'transfer' => 'Transfer',
            'initial' => 'Initial Stock',
            'correction' => 'Correction'
        ];

        return $labels[$this->transaction_type] ?? ucfirst($this->transaction_type);
    }
} 