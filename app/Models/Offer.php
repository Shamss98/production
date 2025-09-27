<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'product_id',
        'old_price',
        'new_price',
        'start_date',
        'end_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
        public function getDiscountPercentageAttribute()
    {
        if ($this->old_price > $this->new_price) {
            return round((($this->old_price - $this->new_price) / $this->old_price) * 100);
        }
        return null;
    }
    public function isActive()
    {
        $today = now()->toDateString();
        return (!$this->start_date || $this->start_date <= $today) &&
               (!$this->end_date || $this->end_date >= $today);
    }
}
