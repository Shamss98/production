<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }
    public function index()
    {
        $categories = $this->CategoryService->getCategories();
        if (request()->routeIs('admin.*')) {
            return view('admin.categories.index', compact('categories'));
        }
        return view('products.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request )
    {
        $this->CategoryService->store($request->validated() + 
        ['image' => $request->file('image')->store('categories', 'public')]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category, $data)
    {
    $this->CategoryService->update($request->validated() +
    ['image' => $request->file('image')->store('categories', 'public')], $category);

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $this->CategoryService->destroy($category);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted');
    }
}

