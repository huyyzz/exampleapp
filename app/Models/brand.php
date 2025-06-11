<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'name',
    ];
    protected $primaryKey = 'id';
    public function cloth()
    {
        return $this->hasMany(Cloth::class);
    }



    
    use HasFactory;
}
