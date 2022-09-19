<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablelist extends Model
{
    use HasFactory;

    protected $fillable = [
        'tb_name',
        'table_number',
    ];
}
