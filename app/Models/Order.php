<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'invoice_number',
        'table_number',
        'total_amount',
        'paid_amount',
        'discount_amount',
        'paid_status',
        'delivery_charge',
        'cus_contact_number',
        'customer_points',
    ];
}
