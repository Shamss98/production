<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_value',
        'max_uses',
        'used',
        'start_date',
        'end_date',
        'status',
    ];

    public function isValid($orderTotal)
    {
        $today = now()->toDateString();
        
        return $this->status
        && (!$this->start_date|| $this->start_date <= $today)
        && (!$this->end_date || $this->end_date >= $today)
        && (!$this->min_order_value || $orderTotal >= $this->min_order_value)
        && (!$this->max_uses || $this->used < $this->max_uses);
    }

    public function applyDiscount($orderTotal)
    {
        if ($this->type === 'fixed') {
            return max(0, $orderTotal - $this->value);
        } elseif ($this->type === 'percent') {
            return max(0, $orderTotal - ($orderTotal * ($this->value / 100)));
        }
        return $orderTotal;
    }
public function users()
{
    return $this->belongsToMany(User::class, 'coupon_user')->withTimestamps();
}

}
