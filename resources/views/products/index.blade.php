@extends('layoutes.main')

@section('title', 'جميع المنتجات')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">جميع المنتجات</h1>
        </div>
    </div>
    
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <div class="card h-100 d-flex flex-column" style="background-color: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: transform 0.3s, box-shadow 0.3s; min-height: 300px; max-width: 200px; margin: 0 auto;">
                        @if($product->image) 
                            <a href="{{ route('viewproducts', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                    alt="{{ $product->name }}" 
                                    class="card-img-top"
                                    style="max-width: 100%; max-height: 90px; object-fit: contain; cursor:pointer; margin-top: 10px;"
                                    onerror="this.style.display='none'">
                            </a>
                        @endif
                        <div class="card-body text-center d-flex flex-column justify-content-between p-2" style="flex: 1 1 auto;">
                            <h6 class="card-title text-truncate" style="max-width: 100%; font-size: 0.95rem; cursor: pointer;" title="{{ $product->name }}">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $product->name }}">
                                    {{ Str::limit($product->name, 15) }}
                                </span>
                            </h6>
                            @push('scripts')
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                                        new bootstrap.Tooltip(tooltipTriggerEl);
                                    });
                                });
                            </script>
                            @endpush
                            <p class="card-text mb-1" style="font-size: 0.93rem;">
                                <strong class="text-primary">{{ number_format($product->price, 2) }} ريال</strong>
                            </p>
                            <p class="card-text mb-1" style="font-size: 0.85rem;">
                                <small class="text-muted">المخزون: {{ $product->stock }}</small>
                            </p>
                            @if($product->category)
                                <p class="card-text mb-1" style="font-size: 0.85rem;">
                                    <small class="text-info">الفئة: {{ $product->category->name }}</small>
                                </p>
                            @endif
                            <!-- Rating -->
                            <x-rating/>
                            <!-- End Rating -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm w-100 mt-1" style="font-size: 0.85rem; padding: 2px 0;">
                                    أضف إلى السلة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    لا توجد منتجات متاحة حالياً
                </div>
            </div>
        @endif
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





    
<div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('index') }}" class="btn btn-secondary">
                العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</div>
@endsection
