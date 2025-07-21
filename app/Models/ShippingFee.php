<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    use HasFactory;

    protected $fillable = ['name','postal_code', 'fee','minimal_fee'];
    protected $table = 'shipping_fees';

    public $timestamps = false;
}
