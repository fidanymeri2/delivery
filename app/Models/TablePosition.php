<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_table_id',
        'table_category_id',
        'x_position',
        'y_position',
        'width',
        'height',
        'z_index',
        'is_active'
    ];

    protected $casts = [
        'x_position' => 'integer',
        'y_position' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'z_index' => 'integer',
        'is_active' => 'boolean'
    ];

    public function restaurantTable()
    {
        return $this->belongsTo(RestaurantTable::class);
    }

    public function tableCategory()
    {
        return $this->belongsTo(TableCategory::class);
    }
}
