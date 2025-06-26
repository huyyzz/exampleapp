<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'cloth_id',
        'name',
    ];

    public function cloth()
    {
        return $this->belongsTo(Cloth::class);
    }

    public function optionValues()
    {
        return $this->hasMany(OptionValue::class);
    }
}
