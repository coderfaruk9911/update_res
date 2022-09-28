<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplierpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'supplier_id',
        'invoice_number',
        'paid_amount',
    ];
}
