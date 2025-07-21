<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'item_name', 'item_price', 'item_parent_id','item_select'];

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'item_parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'item_parent_id');
    }
}
