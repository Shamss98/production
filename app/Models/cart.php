<?php

namespace App\Models;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
