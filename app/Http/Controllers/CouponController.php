<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return back()->with('error', 'الكوبون غير صحيح.');
        }


        $cartTotal =  $request->cart_total;

        if (!$coupon->isValid($cartTotal)) {
        return back()->with('error', 'لا يمكن استخدام هذا الكوبون. الحد الأدنى للطلب هو ' . $coupon->min_order_value . ' جنيه.');
        }



        if (session()->has('coupon')) {
            return back()->with('error', 'تم تطبيق كوبون بالفعل.');
        }

        $newTotal = $coupon->applyDiscount($cartTotal);

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'discounted_total' => $newTotal,
        ]);

        $coupon->increment('used');

        return back()->with('success', "تم تطبيق الكوبون. الإجمالي الجديد: $newTotal");
    }

    public function remove()
    {
        if (session()->has('coupon')) {
            session()->forget('coupon');
            return back()->with('success', 'تم إلغاء الكوبون.');
        }

        return back()->with('error', 'لا يوجد كوبون لتلغيه.');
    }
}
