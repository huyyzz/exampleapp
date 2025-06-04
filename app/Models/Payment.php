<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payment';
    use HasFactory;


    protected $fillable = [
        'date',
        'description',
        'order_id',
        'status',
        'sub_total'
    ];
}
