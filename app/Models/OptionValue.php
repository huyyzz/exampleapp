<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_id',
        'value',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function skuvalue()
    {
        return $this->hasMany(SkuValue::class);
    }
}
