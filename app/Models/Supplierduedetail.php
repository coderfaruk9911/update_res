<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplierduedetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'supplier_id',
        'due_amount',
        'total_amount',
        'paid_amount',
        'advanced_amount',
    ];
}
