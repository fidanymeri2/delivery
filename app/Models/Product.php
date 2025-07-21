<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use HasFactory, SoftDeletes;


   protected $guarded =[];
    
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


}
