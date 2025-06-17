<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cloth extends Model
{
    protected $table = 'cloths';
    use HasFactory;
    use SoftDeletes;
    // public function category()
    // {
    //     return $this->hasOne('Category');
    // }

    // public function brands()
    // {
    //     return $this->hasOne(brand::class);
    // }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_items::class, 'product_id', 'id');
    }

    // public function cart()
    // {
    //     return $this->belongsToMany('cart');
    // }
    protected $fillable = [
        'product_name',
        'product_description',
        'QuantityInWareHouse',
        'product_price',
        'category_id',
        'brand_id',
        'product_image_url',
    ];

    protected $dates = ['deleted_at'];



    public function collections()
    {
        return $this->belongsToMany(collections::class)
            ->withPivot('sort_order')
            ->orderBy('collection_product.sort_order');
    }
}
