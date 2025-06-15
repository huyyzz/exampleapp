<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    use HasFactory;


    protected $fillable = [
        'description',
        'order_id',
        'status',
        'sub_total',
        'payment_type',
        'p_note',
        'p_vnp_response_code',
        'p_code_vnpay',
        'p_code_bank',
        'p_time',
    ];
}
