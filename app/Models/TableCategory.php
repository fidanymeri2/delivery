<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function tables()
    {
        return $this->hasMany(RestaurantTable::class, 'table_category_id');
    }
}
