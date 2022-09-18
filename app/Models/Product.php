<?php

namespace App\Models;

use App\Models\Scopes\Storescope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id', 'store_id', 'price', 'compare_price', 'status'];

    protected static function booted()
    {
        static::addGlobalScope('store', new Storescope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,//Related Model
            'product_tag',//Pivot table name
            'product_id',//FK in pivot table for the current model
            'tag_id', //FK in pivot table for the related table
            'id',//PK current model
            'id',//PK related model
        );
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    //Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('defaultProduct.jpg');
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentageDiscountAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }

        return round(100 * $this->price / $this->compare_price, 1) - 100. . '%';
    }

}
