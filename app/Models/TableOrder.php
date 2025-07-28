<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_table_id',
        'waiter_id',
        'status',
        'payment_status',
        'payment_method',
        'total_amount',
        'paid_amount',
        'notes',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'status' => 'string',
        'payment_status' => 'string',
        'payment_method' => 'string',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id');
    }

    public function waiter()
    {
        return $this->belongsTo(Waiter::class, 'waiter_id');
    }

    public function items()
    {
        return $this->hasMany(TableOrderItem::class, 'table_order_id');
    }

    public function calculateTotal()
    {
        return $this->items()->sum('total_price');
    }
}
