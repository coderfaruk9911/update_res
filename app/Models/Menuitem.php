<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'price',
        'discount_percentage',
        'discount_price',
    ];
}
