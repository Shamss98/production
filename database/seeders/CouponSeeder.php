<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'code' => 'SHAMS10',
            'type' => 'percent',
            'value' => 30,
            'min_order_value' => 50,
            'max_uses' => 100,
            'used' => 0,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'status' => true,
        ]);
        Coupon::create([
            'code' => 'ISLAM55',
            'type' => 'fixed',
            'value' => 450,
            'min_order_value' => 20,
            'max_uses' => 50,
            'used' => 0,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'status' => true,
        ]);

        Coupon::create([
            'code' => 'WELCOME5',
            'type' => 'fixed',
            'value' => 300,
            'min_order_value' => 2000,
            'max_uses' => 5,
            'used' => 0,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'status' => true,
        ]);
    }
}
