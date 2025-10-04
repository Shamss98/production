<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyCouponRequest;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\cart;
use App\Models\Coupon;
use App\Services\Coupon\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    public function apply(ApplyCouponRequest $request)
    {
        $data = $request->validated();

        $result = $this->couponService->apply($data['code'], $data['cart_total']);

        return back()->with($result['status'], $result['message']);
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
public function store(CouponStoreRequest $request)
{
    $this->couponService->store($request->validated());
    return redirect()->route('admin.coupons.index')->with('success', 'تم اضافة الكوبون بنجاح');
}
public function edit(Coupon $coupon)
{
    return view('admin.coupons.edit', compact('coupon'));
}
public function update(CouponUpdateRequest $request, Coupon $coupon)
{
    $this->couponService->update($request->validated(), $coupon);
    return redirect()->route('admin.coupons.index')->with('success', 'تم تعديل الكوبون بنجاح');
}
public function destroy(Coupon $coupon)
{
    $this->couponService->destroy($coupon);
    return redirect()->route('admin.coupons.index')->with('success', 'تم حذف الكوبون بنجاح');
}
public function getCoupon()
{
   $coupons =  $this->couponService->getCoupon();
    return view('coupons.index')->with('coupons', $coupons);
}
}
