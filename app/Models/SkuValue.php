<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_sku_id',
        'option_id',
        'option_value_id',
    ];

    public function clothSku()
{
    return $this->belongsTo(ProductSku::class, 'product_sku_id');
}

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }
}
