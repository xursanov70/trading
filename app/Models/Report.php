<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_count',
        'original_price',
        'sale_price',
        'benefit',
        'sale_date',
    ];
}
