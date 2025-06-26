<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    protected $table = "product_skus";
    protected $fillable = [
        'cloth_id',
        'sku',
        'price',
        'quantity',
    ];

    public function cloth()
    {
        return $this->belongsTo(Cloth::class);
    }

    public function skuValues()
    {
        return $this->hasMany(SkuValue::class);
    }
}
