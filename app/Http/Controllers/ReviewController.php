<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
      public function store(Request $request, Product $product)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // حفظ المراجعة
        $review = new Review();
        $review->user_id = Auth::id(); // معرف المستخدم الحالي
        $review->product_id = $product->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return back()->with('success', 'تمت إضافة مراجعتك بنجاح!');
    }
}
