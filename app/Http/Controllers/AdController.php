<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use App\Services\Ad\AdService;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected $AdService;

    public function __construct(AdService $AdService)
    {
        $this->AdService = $AdService;
    }
    public function index()
    {
        $ads = $this->AdService->getAds();
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(AdStoreRequest $request)
    {
    $this->AdService->store($request->validated() + ['image' => $request->file('image')->store('ads', 'public')]);

        return redirect()->route('admin.ads.index')->with('success', 'تمت إضافة الإعلان بنجاح');
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(AdUpdateRequest $request, Ad $ad)
        {
        $this->AdService->update($request->validated() + ['image' => $request->file('image')->store('ads', 'public')]);

        return redirect()->route('admin.ads.index')->with('success', 'تم تعديل الإعلان بنجاح');
    }

    public function destroy(Ad $ad)
    {
        $this->AdService->destroy($ad);
        return redirect()->route('admin.ads.index')->with('success', 'تم حذف الإعلان بنجاح');
    }
}
