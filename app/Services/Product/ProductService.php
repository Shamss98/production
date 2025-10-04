<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getAll($isAdmin = false)
    {
        $query = Product::with('category')->latest();
        return $query->paginate($isAdmin ? 12 : 12);
    }

    public function getByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products()->latest()->paginate(12);

        return compact('category', 'products');
    }

    public function create(array $data)
    {
        // صورة رئيسية
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        // جاليري صور
        $gallery = [];
        if (isset($data['gallery_images'])) {
            foreach ($data['gallery_images'] as $img) {
                $gallery[] = $img->store('products/gallery', 'public');
            }
        }
        $data['gallery_images'] = $gallery;

        $product = Product::create($data);

        Activity::create([
            'user_id'  => Auth::id(),
            'activity' => 'Product created',
            'status'   => 'Success',
        ]);

        return $product;
    }

    public function update(Product $product, array $data)
    {
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        if (isset($data['gallery_images'])) {
            $gallery = [];
            foreach ($data['gallery_images'] as $img) {
                $gallery[] = $img->store('products/gallery', 'public');
            }
            $data['gallery_images'] = $gallery;
        }

        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function search(string $query)
    {
        return Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(12);
    }

    public function viewProduct($id)
    {
        $product = Product::with('category', 'reviews.user')->findOrFail($id);

        if (!is_array($product->gallery_images)) {
            $product->gallery_images = json_decode($product->gallery_images, true) ?? [];
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return compact('product', 'relatedProducts');
    }

    public function getOffers()
    {
        return Product::with('activeOffer')
            ->whereHas('activeOffer')
            ->latest()
            ->paginate(12);
    }

    public function filterByBrand($categoryId, $brandId)
    {
        $category = Category::findOrFail($categoryId);
        $brand    = \App\Models\Brand::findOrFail($brandId);

        $products = Product::where('category_id', $categoryId)
            ->where('brand_id', $brandId)
            ->latest()
            ->paginate(12);

        return compact('category', 'products', 'brand');
    }

    public function priceRange()
    {
        return Product::priceRange()->latest()->paginate(12);
    }
}
