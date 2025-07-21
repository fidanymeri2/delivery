<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemOption extends Model
{
    // Define the table associated with the model if it's not the pluralized version of the model name
    protected $table = 'order_item_options';

    // If you're using timestamps
    public $timestamps = true;

    // Define the fillable properties
         protected $guarded =[];

    // Define any relationships if necessary
}
