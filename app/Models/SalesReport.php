<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    use HasFactory;

    protected $fillable = ['report_date', 'total_sales', 'total_orders'];
    protected $table = 'sales_reports';

    public $timestamps = true; 
}
