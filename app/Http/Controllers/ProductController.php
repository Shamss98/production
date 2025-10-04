<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll(request()->routeIs('admin.*'));
        return view(request()->routeIs('admin.*') ? 'admin.products.index' : 'products.index', compact('products'));
    }

    public function showByCategory($categoryId)
    {
        $data = $this->productService->getByCategory($categoryId);
        return view('products.category', $data);
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $brands     = \App\Models\Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->create($request->validated() + [
            'image'          => $request->file('image'),
            'gallery_images' => $request->file('gallery_images')
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        $brands     = \App\Models\Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->productService->update($product, $request->validated() + [
            'image'          => $request->file('image'),
            'gallery_images' => $request->file('gallery_images')
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }

    public function search(Request $request)
    {
        if (!$request->input('q')) {
            return back()->with('error', 'Please enter a search term.');
        }
        $products = $this->productService->search($request->input('q'));
        return view('products.search', ['products' => $products, 'query' => $request->input('q')]);
    }

    public function viewproduct($id)
    {
        $data = $this->productService->viewProduct($id);
        return view('products.viewproduct', $data);
    }

    public function isOffer()
    {
        $products = $this->productService->getOffers();
        return view('products.offers', compact('products'));
    }

    public function filterByBrand($categoryId, $brandId)
    {
        $data = $this->productService->filterByBrand($categoryId, $brandId);
        return view('products.category', $data);
    }

    public function priceRange()
    {
        $products = $this->productService->priceRange();
        return view('products.pricerange', compact('products'));
    }
}
