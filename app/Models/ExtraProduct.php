<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'extra_products';

     protected $guarded =[];

    public function category()
    {
        return $this->belongsTo(ExtraCategory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_extra');
    }
}