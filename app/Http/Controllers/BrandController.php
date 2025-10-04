<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Activity;
use App\Models\Brand;
use App\Models\Category;
use App\Services\Brand\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    protected $BrandService;

    public function __construct(BrandService $BrandService)
    {
        $this->BrandService = $BrandService;
    }
    public function index()
    {
        $brands = $this->BrandService->getBrands();
        return view('admin.brands.index', compact('brands'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.brands.create', compact('categories'));


    }

    public function store(BrandStoreRequest $request)
    {
        $this->BrandService->store(
        $request->validated() + [
        'image' => $request->file('image')->store('brands', 'public')
    ]
);
        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully');
    }
    public function edit(Brand $brand)
    {
        $categories = Category::all();
        return view('admin.brands.edit', compact('brand', 'categories'));
    }



    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully');
    }
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully');
    }
}
