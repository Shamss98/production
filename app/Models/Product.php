<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $casts = [
        'gallery_images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeisOffer($Query)
    {
        return $Query->where('price', '>', 20) ->where('price', '<', 200);

    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}



