<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes; 
    protected $guarded = [];
    
    protected $table = 'orders';

    protected $casts = [
        'status_of_payment' => 'string',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
   // In the Order model:
public function takenByUser()
{
    return $this->belongsTo(User::class, 'taken_by');
}

    
    public function itemOptions()
    {
        return $this->hasManyThrough(OrderItemOption::class, OrderItem::class, 'order_id', 'order_item_id');
    }

    public function deletedBy()
    {
    return $this->belongsTo(User::class, 'deleted_by');
    }

    public function updatedBy()
    {
    return $this->belongsTo(User::class, 'updated_by');
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
    
    public function shouldShowEmailButton()
    {
        return $this->shipping_status === 'new' && !$this->confirm_email;
    }

    public function deliveryUser()
{
    return $this->belongsTo(User::class, 'taken_by');
}

}
