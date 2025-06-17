<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Carbon\Carbon;

class collections extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'show_on_homepage',
        'start_date',
        'end_date',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_homepage' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }

    public function products()
    {
        return $this->belongsToMany(Cloth::class, 'collection_product', 'collection_id', 'cloth_id') // explicit pivot + foreign keys
        ->withPivot('sort_order')
        ->orderBy('collection_product.sort_order');
    }

    public function activeProducts()
    {
        return $this->belongsToMany(Cloth::class, 'collection_product')
            ->withPivot('sort_order')
            ->whereNull('cloths.deleted_at')
            ->where('cloths.QuantityInWareHouse', '>', 0)
            ->orderBy('collection_product.sort_order');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getIsCurrentAttribute()
    {
        $today = Carbon::today();
        
        if ($this->start_date && $this->end_date) {
            return $today->between($this->start_date, $this->end_date);
        }
        
        if ($this->start_date) {
            return $today->greaterThanOrEqualTo($this->start_date);
        }
        
        if ($this->end_date) {
            return $today->lessThanOrEqualTo($this->end_date);
        }
        
        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        $today = Carbon::today();
        
        return $query->where(function ($q) use ($today) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', $today);
        })->where(function ($q) use ($today) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', $today);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
