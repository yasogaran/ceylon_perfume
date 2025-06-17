<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function shipping()
    {
        return $this->hasOne(ProductShipping::class);
    }

    public function images()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
