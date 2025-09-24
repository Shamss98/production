<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
   
}



