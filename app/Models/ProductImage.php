<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['cloth_id', 'image_url', 'is_main'];

    public function cloth()
    {
        return $this->belongsTo(Cloth::class);
    }
}
