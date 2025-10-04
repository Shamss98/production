<?php

namespace App\Services\Coupon;

use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    public function apply(string $code, float $cartTotal): array
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return ['status' => 'error', 'message' => 'الكوبون غير صحيح.'];
        }

        if (!$coupon->isValid($cartTotal)) {
            return [
                'status' => 'error',
                'message' => 'لا يمكن استخدام هذا الكوبون. الحد الأدنى للطلب هو ' . $coupon->min_order_value . ' جنيه.'
            ];
        }

        if (session()->has('coupon')) {
            return ['status' => 'error', 'message' => 'تم تطبيق كوبون بالفعل.'];
        }

        if ($coupon->users()->where('user_id', Auth::id())->exists()) {
            return ['status' => 'error', 'message' => 'لا يمكن استخدام هذا الكوبون.'];
        }

        $newTotal = $coupon->applyDiscount($cartTotal);

        session()->put('coupon', [
            'code'             => $coupon->code,
            'type'             => $coupon->type,
            'value'            => $coupon->value,
            'discounted_total' => $newTotal,
        ]);

        $coupon->users()->attach(Auth::id());
        $coupon->increment('used');

        return [
            'status'    => 'success',
            'message'   => "تم تطبيق الكوبون. الإجمالي الجديد: $newTotal",
            'new_total' => $newTotal
        ];
    }

    public function remove(): array
    {
        if (session()->has('coupon')) {
            session()->forget('coupon');
            return ['status' => 'success', 'message' => 'تم إلغاء الكوبون.'];
        }

        return ['status' => 'error', 'message' => 'لا يوجد كوبون لتلغيه.'];
    }

    public function getCoupons()
    {
        return Coupon::latest()->paginate(10);
    }
    public function store(array $data)
    {

        return Coupon::create($data);
    }
    public function update(array $data, Coupon $coupon)
    {
        return $coupon->update($data);
    }
    public function destroy(Coupon $coupon)
    {
        return $coupon->delete();
    }
    public function getCoupon()
    {
        return Coupon::where('code', 'SHAMS10')->get();
    }
}
