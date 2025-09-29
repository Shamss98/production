<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if($coupon->users()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'لا يمكن استخدام هذا الكوبون.');
            
        }

        $newTotal = $coupon->applyDiscount($cartTotal);

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'discounted_total' => $newTotal,
        ]);

        $coupon->users()->attach(Auth::id());

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

public function report()
{
    $coupons = Coupon::with('users')->get();

    return view('admin.coupons.report', compact('coupons'));
}
public function index()
{
    $coupons = Coupon::with('users')->latest()->paginate(10);
    return view('admin.coupons.index', compact('coupons'));
}
public function create()
{
    return view('admin.coupons.create');
    
}
public function store(Request $request)
{
    $request->validate([
        'code' => 'required|string|unique:coupons',
        'type' => 'required|string',
        'value' => 'required|numeric',
        'min_order_value' => 'required|numeric',
        'max_uses' => 'required|numeric',
    ]);
    $coupon = Coupon::create($request->all());
    return redirect()->route('admin.coupons.index')->with('success', 'تم اضافة الكوبون بنجاح');
}
public function edit(Coupon $coupon)
{
    return view('admin.coupons.edit', compact('coupon'));
}
public function update(Request $request, Coupon $coupon)
{
    $request->validate([
        'code' => 'required|string|unique:coupons,code,' . $coupon->id,
        'type' => 'required|string',
        'value' => 'required|numeric',
        'min_order_value' => 'required|numeric',
        'max_uses' => 'required|numeric',
    ]);
    $coupon->update($request->all());
    return redirect()->route('admin.coupons.index')->with('success', 'تم تعديل الكوبون بنجاح');
}
public function destroy(Coupon $coupon)
{
    $coupon->delete();
    return redirect()->route('admin.coupons.index')->with('success', 'تم حذف الكوبون بنجاح');
}
public function getCoupon()
{
    $coupons = Coupon::where('code', 'SHAMS10')->get(); 
    return view('coupons.index')->with('coupons', $coupons);
}
}