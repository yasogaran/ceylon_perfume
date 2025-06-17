<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'ordered_product_ids' => 'array',
    ];
}