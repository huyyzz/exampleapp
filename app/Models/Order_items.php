<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    use HasFactory;
//    public function cloths()
//    {
//        return $this->hasOne(Cloth::class,'id');
//    }

    public function cloths()
    {
        return $this->belongsTo(Cloth::class, 'product_id', 'id');
    }


    

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'product_price',
    ];
}
