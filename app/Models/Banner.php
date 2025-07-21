<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['image_url', 'status','title','description']; 

    protected $table = 'banners';

    protected $casts = [
        'status' => 'boolean',
    ];
    
    public $timestamps = true;
}
