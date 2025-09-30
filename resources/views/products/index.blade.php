@extends('layoutes.main')

@section('title', 'جميع المنتجات')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5" style="color: #343a40; font-weight: 700;">جميع المنتجات</h1>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        @if($products->count() > 0)
            @foreach($products as $product)
                {{-- Product Card Container --}}
                <div class="col">
                    <div class="card h-100 d-flex flex-column" 
                        style="background-color: #ffffff; border: 1px solid #e9ecef; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease-in-out; overflow: hidden; height: 100%; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px) scale(1.02)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'"
                        onmouseout="this.style.transform='translateY(0) scale(1.0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'">
                        
                        {{-- Product Image Section --}}
                        @if($product->image) 
                            <a href="{{ route('viewproducts', $product->id) }}" style="text-decoration: none;">
                                <div style="height: 120px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        style="max-width: 90%; max-height: 100px; object-fit: contain; padding: 10px;"
                                        onerror="this.style.display='none'">
                                </div>
                            </a>
                        @endif

                        {{-- Card Body Section --}}
                        <div class="card-body text-center d-flex flex-column p-3" style="flex: 1 1 auto; justify-content: space-between;">
                            
                            {{-- Product Name --}}
                            <h6 class="card-title text-truncate mb-2" 
                                style="font-size: 1rem; font-weight: 600; color: #343a40; max-width: 100%;" 
                                title="{{ $product->name }}">
                                <a href="{{ route('viewproducts', $product->id) }}" 
                            style="text-decoration: none; color: inherit;">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $product->name }}">
                                        {{ Str::limit($product->name, 25) }}
                                    </span>
                                </a>
                            </h6>
                            
                            {{-- Price Information --}}
                            <div class="mb-2">
                                @php($activeOffer = $product->activeOffer()->first())
                                @if($product->activeOffer)
                                    <p>
                                        <del class="text-success mb-3" style="color: #28a745; font-size: 0.9rem; font-weight: 700; ">{{ number_format($product->activeOffer->old_price, 2) }} L.E</del>
                                        <span style="color: rgb(201, 31, 1); font-size: 0.9rem; font-weight: 700;">{{ number_format($product->final_price, 2) }} L.E</span>
                                    </p>
                                @else
                                    <p style="color: #28a745; font-size: 0.9rem; font-weight: 700;">{{ number_format($product->price, 2) }} L.E</p>
                                @endif
                            </div>

                            {{-- Category and Stock Info --}}
                            <p class="card-text mb-1" style="font-size: 0.8rem; color: #6c757d;">
                                @if($product->category)
                                    <small style="color: #17a2b8; font-weight: 500;">الفئة: {{ $product->category->name }}</small>
                                    <span style="margin: 0 5px;">|</span>
                                @endif
                                <small>المخزون: {{ $product->stock }}</small>
                            </p>
                            
                            {{-- Rating Component --}}
                            <div class="mb-2">
                                <x-rating/>
                            </div>
                            
                            {{-- Add to Cart Form --}}
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:block;">
                                @csrf
                                <button type="submit" 
                                    class="btn w-100" 
                                    style="background-color: #28a745; color: #ffffff; border: none; font-size: 0.9rem; padding: 8px 0; border-radius: 6px; font-weight: 600; transition: background-color 0.2s;"
                                    onmouseover="this.style.backgroundColor='#218838'"
                                    onmouseout="this.style.backgroundColor='#28a745'">
                                    أضف إلى السلة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-size: 1.1rem;">
                    لا توجد منتجات متاحة حالياً
                </div>
            </div>
        @endif
    </div>

    {{-- Tooltip Script --}}
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



    {{-- Pagination Links --}}
    @if ($products->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <ul class="pagination" style="list-style:none; display:flex; gap:4px; padding:0; margin:0; justify-content:center; font-size:14px; flex-wrap: wrap;">
                
                {{-- Previous Page Link --}}
                @if ($products->onFirstPage())
                    <li style="padding: 6px 12px; border: 1px solid #ddd; border-radius: 6px; color: #aaa; margin: 2px;">
                        <span style="display: block;">&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $products->previousPageUrl() }}" rel="prev" 
                        style="padding: 6px 12px; border: 1px solid #ddd; border-radius: 6px; color: #333; text-decoration:none; display: block; transition: background-color 0.2s;"
                        onmouseover="this.style.backgroundColor='#f8f9fa'"
                        onmouseout="this.style.backgroundColor='transparent'">
                        &lsaquo;
                        </a>
                    </li>
                @endif

{{ $products->links('vendor.pagination.custom') }}
    @endif

    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('index') }}" 
            class="btn btn-secondary"
            style="background-color: #6c757d; color: #fff; border-color: #6c757d; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background-color 0.2s;"
            onmouseover="this.style.backgroundColor='#5a6268'"
            onmouseout="this.style.backgroundColor='#6c757d'">
            العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</div>
@endsection