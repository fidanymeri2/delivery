<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'allergy_info'];

    protected $table = 'allergies';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
