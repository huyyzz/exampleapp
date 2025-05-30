<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    protected $table = 'cloths';
    use HasFactory;
    public function category()
    {
        return $this->hasOne('Category');
    }

    public function brands()
    {
        return $this->belongsTo(brand::class);
    }

    public function order_items()
    {
        return $this->belongsToMany(Order_items::class,'product_id');
    }

    public function cart()
    {
        return $this->belongsToMany('cart');
    }
    protected $fillable = [
        'product_name',
        'product_description',
        'QuantityInWareHouse',
        'product_price',
        'category_id',
        'brand_id',
        'product_image_url',
    ];
}
