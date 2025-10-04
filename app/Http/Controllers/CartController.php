<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     public function index()
    {
       $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    $items = $cart->items()->with('product')->get();

    // إجمالي الكارت
    $total = $items->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // إعادة حساب الخصم كل مرة حسب الإجمالي الجديد
    $discount = 0;
    if (session()->has('coupon')) {
        $coupon = session('coupon');
        if ($coupon['type'] === 'percent') {
            $discount = ($total * $coupon['value']) / 100;
        } elseif ($coupon['type'] === 'fixed') {
            $discount = $coupon['value'];
        }
    }

    $finalTotal = max(0, $total - $discount);

    return view('cart.index', compact('cart', 'items', 'total', 'discount', 'finalTotal'));


    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $id)->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $id,
                'quantity' => 1,
                'price' => $product->final_price,
            ]);
        }


        return redirect()->route('cart.index')->with('success', 'تمت إضافة المنتج للعربة!');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        if ($request->quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $request->quantity]);
        }


        return redirect()->route('cart.index');
    }

    public function remove($id)
    {

        $item = CartItem::findOrFail($id);
        $item->delete();
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }
        session()->forget('coupon');
        return redirect()->route('cart.index');
    }


}
