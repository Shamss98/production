@extends('layoutes.main')

@section('title', 'Add Product')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Add Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
    <label class="form-label">Brand</label>
    <select name="brand_id" class="form-select" required>
        <option value="">Select brand</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @selected(old('brand_id')==$brand->id)>{{ $brand->name }}</option>
        @endforeach
    </select>
    @error('brand_id')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control" required>
            @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control" required>
            @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
    <label for="gallery_images" class="form-label">صور إضافية</label>
    <input type="file" name="gallery_images[]" id="gallery_images" multiple class="form-control">
</div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection


