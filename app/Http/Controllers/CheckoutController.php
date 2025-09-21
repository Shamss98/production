<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * دفع منتج واحد
     */
    public function pay(Request $request, $productId)
    {
        $user = Auth::user();
        $product = \App\Models\Product::findOrFail($productId);

        $amount = $product->price;

        // 1️⃣ Auth Request
        $authResponse = Http::post("https://accept.paymob.com/api/auth/tokens", [
            "api_key" => config('services.paymob.token')
        ]);

        $authData = $authResponse->json();
        if (!isset($authData['token'])) {
            dd("Auth Error:", $authData);
        }
        $authToken = $authData['token'];

        // 2️⃣ Create Order
        $orderResponse = Http::post("https://accept.paymob.com/api/ecommerce/orders", [
            "auth_token" => $authToken,
            "delivery_needed" => "false",
            "amount_cents" => $amount * 100,
            "currency" => "EGP",
            "items" => [],
        ]);

        $orderData = $orderResponse->json();
        if (!isset($orderData['id'])) {
            dd("Order Error:", $orderData);
        }
        $paymobOrderId = $orderData['id'];

        // 3️⃣ Payment Key
        $paymentResponse = Http::post("https://accept.paymob.com/api/acceptance/payment_keys", [
            "auth_token" => $authToken,
            "amount_cents" => $amount * 100,
            "currency" => "EGP",
            "order_id" => $paymobOrderId,
            "billing_data" => [
                "apartment" => "NA",
                "email" => $user->email ?? "test@example.com",
                "floor" => "NA",
                "first_name" => $user->name ?? "Test",
                "street" => "NA",
                "building" => "NA",
                "phone_number" => "01000000000",
                "shipping_method" => "NA",
                "postal_code" => "NA",
                "city" => "Cairo",
                "country" => "EG",
                "last_name" => "User",
                "state" => "NA",
            ],
            "integration_id" => config('services.paymob.integration_id'),
        ]);

        $paymentData = $paymentResponse->json();
        if (!isset($paymentData['token'])) {
            dd("Payment Key Error:", $paymentData);
        }
        $paymentKey = $paymentData['token'];

        // 4️⃣ Save order in DB
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => $amount,
            'paymob_order_id' => $paymobOrderId,
        ]);

        // 5️⃣ Redirect to Paymob iframe
        return redirect("https://accept.paymob.com/api/acceptance/iframes/" . config('services.paymob.iframe_id') . "?payment_token=$paymentKey");
    }

    /**
     * دفع محتويات السلة
     */
    public function payCart()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'السلة فارغة');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1️⃣ Auth Request
        $authResponse = Http::post("https://accept.paymob.com/api/auth/tokens", [
            "api_key" => config('services.paymob.token')
        ]);

        $authData = $authResponse->json();
        if (!isset($authData['token'])) {
            dd("Auth Error:", $authData);
        }
        $authToken = $authData['token'];

        // 2️⃣ Create Order
        $orderResponse = Http::post("https://accept.paymob.com/api/ecommerce/orders", [
            "auth_token" => $authToken,
            "delivery_needed" => "false",
            "amount_cents" => $total * 100,
            "currency" => "EGP",
            "items" => [],
        ]);

        $orderData = $orderResponse->json();
        if (!isset($orderData['id'])) {
            dd("Order Error:", $orderData);
        }
        $paymobOrderId = $orderData['id'];

        // 3️⃣ Payment Key
        $paymentResponse = Http::post("https://accept.paymob.com/api/acceptance/payment_keys", [
            "auth_token" => $authToken,
            "amount_cents" => $total * 100,
            "currency" => "EGP",
            "order_id" => $paymobOrderId,
            "billing_data" => [
                "apartment" => "NA",
                "email" => $user->email ?? "test@example.com",
                "floor" => "NA",
                "first_name" => $user->name ?? "Test",
                "street" => "NA",
                "building" => "NA",
                "phone_number" => "01000000000",
                "shipping_method" => "NA",
                "postal_code" => "NA",
                "city" => "Cairo",
                "country" => "EG",
                "last_name" => "User",
                "state" => "NA",
            ],
            "integration_id" => config('services.paymob.integration_id'),
        ]);

        $paymentData = $paymentResponse->json();
        if (!isset($paymentData['token'])) {
            dd("Payment Key Error:", $paymentData);
        }
        $paymentKey = $paymentData['token'];

        // 4️⃣ Save order in DB
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => $total,
            'paymob_order_id' => $paymobOrderId,
        ]);

        // 5️⃣ Redirect to Paymob iframe
        return redirect("https://accept.paymob.com/api/acceptance/iframes/" . config('services.paymob.iframe_id') . "?payment_token=$paymentKey");
    }
}
