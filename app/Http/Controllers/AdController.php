<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::latest()->get();
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url'
        ]);

        $path = $request->file('image')->store('ads', 'public');

        Ad::create([
            'title' => $request->title,
            'image' => $path,
            'link'  => $request->link,
            'status'=> $request->status ?? 1,
        ]);

        return redirect()->route('admin.ads.index')->with('success', 'تمت إضافة الإعلان بنجاح');
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url'
        ]);

        $data = $request->only(['title','link','status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ads', 'public');
        }

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('success', 'تم تعديل الإعلان بنجاح');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'تم حذف الإعلان بنجاح');
    }
}