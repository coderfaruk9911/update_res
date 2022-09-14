<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'item_id',
        'item_quantity',
        'unit_price',
        'price',
    ];
}
