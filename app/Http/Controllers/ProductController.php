<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->routeIs('admin.*')) {
            $products = Product::with('category')->latest()->paginate(12);
            return view('admin.products.index', compact('products'));
        }
        $products = Product::with('category')->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function showByCategory($categoryId)
    {
        $category = Category::with('products')->findOrFail($categoryId);
        $products = Product::where('category_id', $categoryId)->latest()->paginate(12);
        return view('products.category', compact('category', 'products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = \App\Models\Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price'       => ['required', 'numeric', 'min:0',],
        'stock'       => ['required', 'integer', 'min:0'],
        'category_id' => ['required', 'exists:categories,id'],
        'image'       => ['nullable', 'image'],
        'gallery_images.*' => ['nullable', 'image'],
        'brand_id'    => ['nullable', 'exists:brands,id'],
    ]);

    // ✅ صورة رئيسية
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // ✅ صور متعددة (Gallery)
    $gallery = [];
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $img) {
            $gallery[] = $img->store('products/gallery', 'public');
        }
    }

    $validated['gallery_images'] = $gallery; // نخزنها كـ JSON

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Product created');
}


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image'],
            'brand_id' => ['nullable', 'exists:brands,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }
    public function search(Request $request)
{
    $query = $request->input('q');

    if (!$query) {
        return redirect()->back()->with('error', 'Please enter a search term.');
    }

    $products = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->paginate(12);

    return view('products.search', compact('products', 'query'));
}

public function viewproduct(){
    $product = Product::with('category', 'reviews.user')->findOrFail($id ?? request()->route('id'));


       if (!is_array($product->gallery_images)) {
        $product->gallery_images = json_decode($product->gallery_images, true) ?? [];
    }

     $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id) 
        ->take(10) 
        ->get();

    return view('products.viewproduct', compact('product', 'relatedProducts'));


}

public function isOffer()
{
    $products = Product::with('activeOffer')
        ->whereHas('activeOffer')
        ->latest()
        ->paginate(12);
    return view('products.offers', compact('products'));
}

/*******  8fcc613f-9ebc-4507-9375-c7874a8ecdb2  *******/
public function filterByBrand($categoryId, $brandId)
{
    $category = Category::findOrFail($categoryId);
    $brand = \App\Models\Brand::findOrFail($brandId);

    $products = Product::where('category_id', $categoryId)
        ->where('brand_id', $brandId)
        ->latest()
        ->paginate(12);

    return view('products.category', compact('category', 'products', 'brand'));
}
public function priceRange()
{
    $products = Product::priceRange()->latest()->paginate(12);
    return view('products.pricerange', compact('products'));
}


}