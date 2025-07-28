<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'table_category_id',
        'table_number',
        'status',
        'capacity',
        'notes',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'capacity' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(TableCategory::class, 'table_category_id');
    }

    public function orders()
    {
        return $this->hasMany(TableOrder::class, 'restaurant_table_id');
    }

    public function activeOrder()
    {
        return $this->hasOne(TableOrder::class, 'restaurant_table_id')
                    ->where('status', 'open');
    }

    public function positions()
    {
        return $this->hasMany(TablePosition::class);
    }

    public function positionForCategory($categoryId)
    {
        return $this->positions()->where('table_category_id', $categoryId)->first();
    }
}
