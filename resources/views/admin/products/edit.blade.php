@extends('layoutes.main')

@section('title', 'Edit Product')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)==$category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
            @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required>
            @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            @if($product->image)
                <div class="mb-2"><img src="{{ asset('storage/'.$product->image) }}" alt="" width="120" style="object-fit:cover;border-radius:6px;"></div>
            @endif
            <input type="file" name="image" class="form-control">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection


