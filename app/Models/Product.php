<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function scopePriceRange($Query)
    {
        return $Query->where('price', '>', 20)->where('price', '<', 500);

    }/*******  e5b8323a-3c37-4a5c-83a8-3c626127ad16 *******/
    public function scopeisOffer($Query)
    {
        return $Query->where('price', '>', 20)->where('price', '<', 500);

    }/*******  e5b8323a-3c37-4a5c-83a8-3c626127ad16  *******/
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function offers()
    {
        return $this->hasOne(Offer::class);
    }
public function activeOffer()
{
    return $this->hasOne(Offer::class, 'product_id')
        ->where(function ($q) {
            $today = now()->toDateString();
            $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
        })
        ->where(function ($q) {
            $today = now()->toDateString();
            $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
        });
}

public function getFinalPriceAttribute(): float
{
    $activeOffer = $this->activeOffer()->first();

    if ($activeOffer && $activeOffer->new_price > 0) {
        return (float) $activeOffer->new_price;
    }

    return (float) $this->price;
}

}


