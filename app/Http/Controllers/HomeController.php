<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ads = Ad::where('status', 1)->get();
        $categories = Category::all();
        $products = Product::isOffer()->get();
        return view('index', compact('categories', 'products', 'ads'));
    }

}
