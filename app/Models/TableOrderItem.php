<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'table_order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'special_instructions',
        'status',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'status' => 'string',
    ];

    public function order()
    {
        return $this->belongsTo(TableOrder::class, 'table_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
