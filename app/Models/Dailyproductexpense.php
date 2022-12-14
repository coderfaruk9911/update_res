<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyproductexpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_date',
        'product_name',
        'product_id',
        'quantity',
    ];
}
