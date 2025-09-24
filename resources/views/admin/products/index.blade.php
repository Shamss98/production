@extends('layoutes.main')

@section('title', 'Manage Products')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
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
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td class="d-flex align-items-center gap-2">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="40" height="40" style="object-fit:cover;border-radius:6px;">
                        @endif
                        {{ $product->name }}
                    </td>
                    <td>{{ $product->category?->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->created_at?->diffForHumans() }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@if ($products->hasPages())
    <ul class="pagination" style="list-style:none; display:flex; gap:4px; padding:0; margin:0; justify-content:center; font-size:12px;">
        
        {{-- Previous Page Link --}}
        @if ($products->onFirstPage())
            <li style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#aaa;">‹</li>
        @else
            <li>
                <a href="{{ $products->previousPageUrl() }}" rel="prev" 
                   style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#333; text-decoration:none;">
                   ‹
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($products->links()->elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#aaa;">
                    {{ $element }}
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $products->currentPage())
                        <li style="padding:4px 8px; border:1px solid #007bff; border-radius:4px; background:#007bff; color:#fff; font-weight:bold;">
                            {{ $page }}
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" 
                               style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#333; text-decoration:none;">
                               {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($products->hasMorePages())
            <li>
                <a href="{{ $products->nextPageUrl() }}" rel="next" 
                   style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#333; text-decoration:none;">
                   ›
                </a>
            </li>
        @else
            <li style="padding:4px 8px; border:1px solid #ddd; border-radius:4px; color:#aaa;">›</li>
        @endif
    </ul>
@endif
@endsection


