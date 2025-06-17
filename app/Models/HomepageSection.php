<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    // protected $table = 'homepage_sections';
    protected $fillable = ['title', 'enabled', 'order', 'category_id', 'product_limit'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')->where('enabled', true)->orderBy('sort_order');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
