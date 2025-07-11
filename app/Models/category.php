<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
   

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    // Relationship with Cloth model
    public function cloths()
    {
        return $this->hasMany(Cloth::class);
    }
    
}
