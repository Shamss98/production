<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(Cart_Item::class);
    }
}
