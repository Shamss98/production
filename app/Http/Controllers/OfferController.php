<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferStoreRequest;
use App\Http\Requests\OfferUpdateRequest;
use App\Models\Activity;
use App\Models\Offer;
use App\Models\Product;
use App\Services\Offer\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    protected $OfferService;

    public function __construct(OfferService $OfferService)
    {
        $this->OfferService = $OfferService;
    }
    public function index()
    {
        $this->OfferService->getOffers();
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.offers.create', compact('products'));
    }

    public function store(OfferStoreRequest $request)
    {
        $this->OfferService->store($request->validated());

        return redirect()->route('admin.offers.index')
            ->with('success', 'تم إضافة العرض بنجاح');
    }

    public function edit(Offer $offer)
    {
        $products = Product::all();
        return view('admin.offers.edit', compact('offer','products'));
    }

    public function update(OfferUpdateRequest $request, Offer $offer)
    {
        $this->OfferService->update($request->validated(), $offer);

        return redirect()->route('admin.offers.index')
            ->with('success', 'تم تحديث العرض بنجاح');
    }

    public function destroy(Offer $offer)
    {
        $this->OfferService->destroy($offer);
        return redirect()->route('admin.offers.index')
            ->with('success', 'تم حذف العرض بنجاح');
    }
}
