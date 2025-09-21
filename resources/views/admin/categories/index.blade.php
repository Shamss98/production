@extends('layoutes.main')

@section('title', 'Manage Categories')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="d-flex align-items-center gap-2">
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" width="40" height="40" style="object-fit:cover;border-radius:6px;">
                        @endif
                        {{ $category->name }}
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->created_at?->diffForHumans() }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $categories->links() }}
</div>
@endsection


