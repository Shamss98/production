<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
      public function store(ReviewStoreRequest $request, Product $product)
    {
      $data = $request->validated();
        $review = Review::create($data);
        $review->user_id = Auth::id(); 
        $review->product_id = $product->id;
        $review->rating = $data['rating'];  
        $review->comment = $data['comment'];
        $review->save();

        return back()->with('success', 'تمت إضافة مراجعتك بنجاح!');
    }
}
