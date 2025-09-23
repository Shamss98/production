<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Models\Order;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('index');

// Product routes (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{categoryId}', [ProductController::class, 'showByCategory'])->name('products.category');
Route::get('/products/category/{categoryId}/brand/{brandId}', [ProductController::class, 'filterByBrand'])->name('products.byBrand');
Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Admin-only dashboard and CRUD
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Category CRUD
    Route::resource('categories', CategoryController::class);

    // Brand CRUD
    Route::resource('brands', BrandController::class);
    // Product CRUD
    Route::resource('products', ProductController::class);

    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('contacts.index');


});



Route::get('viewproduct/{id}', [ProductController::class, 'viewproduct'])->name('viewproducts');


Route::fallback(function () {
    return view('errors.nigaerror');
});

// Cart routes

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/cartmessage', function () {
    return view('cart.cartmessage');
})->name('cartmessage');



Route::middleware('auth')->group(function () {
    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout.page');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
});

// Webhook callback
Route::post('/paymob/callback', function (Request $request) {
    $hmac = $request->header('hmac');

    // ⚠️ هنا ممكن تضيف التحقق من HMAC (حسب docs Paymob)
    $order = Order::find($request->merchant_order_id);

    if ($request->success) {
        $order->update(['status' => 'paid']);
    } else {
        $order->update(['status' => 'failed']);
    }

    return response()->json(['message' => 'ok']);
});

Route::middleware('auth')->group(function () {

    // دفع منتج واحد (بـ ID المنتج)
    Route::get('/checkout/{productId}', [CheckoutController::class, 'pay'])
        ->name('checkout.pay');

    // دفع السلة كلها
    Route::get('/checkout/cart', [CheckoutController::class, 'payCart'])
        ->name('checkout.cart');
});

Route::get('/offers', [ProductController::class, 'isOffer'])->name('offers');
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
