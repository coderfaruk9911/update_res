<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_moblie_number',
        'customer_points'
    ];
}
