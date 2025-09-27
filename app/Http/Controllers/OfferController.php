<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('product')->latest()->paginate(10);
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.offers.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'old_price'  => 'required|numeric|min:0',
            'new_price'  => 'required|numeric|min:0|lt:old_price',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        Offer::create($request->all());

        return redirect()->route('admin.offers.index')
            ->with('success', 'تم إضافة العرض بنجاح');
    }

    public function edit(Offer $offer)
    {
        $products = Product::all();
        return view('admin.offers.edit', compact('offer','products'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'old_price'  => 'required|numeric|min:0',
            'new_price'  => 'required|numeric|min:0|lt:old_price',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $offer->update($request->all());

        return redirect()->route('admin.offers.index')
            ->with('success', 'تم تحديث العرض بنجاح');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offers.index')
            ->with('success', 'تم حذف العرض بنجاح');
    }
}
