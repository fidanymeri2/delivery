<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waiter extends Model
{
    use HasFactory, SoftDeletes; 

    // Specify the table if it's not the plural form of the model name
    protected $table = 'waiters';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'pin_code',
    ];

    public function tableOrders()
    {
        return $this->hasMany(TableOrder::class, 'waiter_id');
    }

    public function activeOrders()
    {
        return $this->hasMany(TableOrder::class, 'waiter_id')
                    ->where('status', 'open');
    }
}
