<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativecost extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'name',
        'amount',
    ];
}
