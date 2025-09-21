@extends('layoutes.main')

@section('title', 'Edit Category')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control">
            @error('slug')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
            @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            @if($category->image)
                <div class="mb-2"><img src="{{ asset('storage/'.$category->image) }}" alt="" width="120" style="object-fit:cover;border-radius:6px;"></div>
            @endif
            <input type="file" name="image" class="form-control">
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection


