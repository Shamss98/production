<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    protected $table = 'cart_items';
    
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
