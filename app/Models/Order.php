<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static function allstatus()
    {
        return array_column(self::cases(),'status');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    protected $fillable = [
        'customer_id',
        'status',
        'sub_total',
        'shipping_fee',
        'isPaid',
        'isOnlinePaid',
        'shipping_address',
        'shipping_phone',
    ];
}
