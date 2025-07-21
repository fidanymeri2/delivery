<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'status', 'changed_by'];

    public function changedBy()
{
    return $this->belongsTo(User::class, 'changed_by');
}

}
