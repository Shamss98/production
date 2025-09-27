@extends('layoutes.main')

@section('title', 'Price Range Products')

@section('content')
<style>
    /* -------------------------------------- */
    /* 1. General Page Styling */
    /* -------------------------------------- */
    body {
        background-color: #f7f9fc; /* خلفية فاتحة وناعمة */
    }
    
    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .main-title {
        color: #007bff; /* اللون الأساسي */
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 2.5rem;
        position: relative;
        padding-bottom: 10px;
        text-align: center;
    }
    .main-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #007bff;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* -------------------------------------- */
    /* 2. Product Card Styling */
    /* -------------------------------------- */
    .product-card {
        border: 1px solid #e0e6f1;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* ظل خفيف */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden; /* لضمان أن الصورة تبقى داخل الحدود */
    }

    .product-card:hover {
        transform: translateY(-5px); /* رفع البطاقة قليلاً عند التمرير */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* ظل أوضح */
    }

    .product-img {
        height: 200px;
        margin: 10px auto;
        object-fit: contain;
        padding: 10px;
        display: block; /* لضمان أن margin: auto يعمل */
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .product-price {
        color: #28a745; /* استخدام لون أخضر للدلالة على السعر (أكثر جاذبية) */
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 15px;
    }

    .stock-info {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .btn-product-view {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .btn-product-view:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    
    /* -------------------------------------- */
    /* 3. Custom Pagination Styling (Cleaned up from inline) */
    /* -------------------------------------- */
    .custom-pagination {
        list-style: none;
        display: flex;
        gap: 5px; /* زيادة التباعد قليلاً */
        padding: 0;
        margin: 0;
        justify-content: center;
        font-size: 15px;
        flex-wrap: wrap;
    }

    .custom-pagination li {
        margin: 2px;
        display: block;
    }

    .custom-pagination a,
    .custom-pagination span {
        padding: 8px 14px; /* زيادة حجم منطقة الضغط */
        border: 1px solid #dee2e6;
        border-radius: 8px; /* حواف أكثر دائرية */
        color: #495057;
        text-decoration: none;
        display: block;
        transition: background-color 0.2s, border-color 0.2s, color 0.2s;
    }

    .custom-pagination a:hover {
        background-color: #e9ecef;
        border-color: #ced4da;
    }

    .custom-pagination .active-page span {
        background: #007bff;
        border-color: #007bff;
        color: #fff;
        font-weight: bold;
    }
    
    .custom-pagination .disabled-page span {
        color: #aaa;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        cursor: not-allowed;
    }

    /* -------------------------------------- */
    /* 4. Not Found Message */
    /* -------------------------------------- */
    .not-found-message {
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        color: #6c757d;
        font-size: 1.2rem;
        font-weight: 500;
    }
</style>

<div class="container">
    <h2 class="main-title">منتجات حسب السعر</h2>
    
    {{-- Search/Filter Bar can be added here if needed --}}
    {{-- <div class="row mb-4">...</div> --}}

    <div class="row">
        @forelse ($products as $product)
            {{-- Col-lg-3 for 4 products on large screens, col-md-4 for 3 on medium, col-sm-6 for 2 on small --}}
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="card h-100 product-card">
                    <a href="{{ route('viewproducts', $product->id) }}">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            class="card-img-top product-img" 
                            alt="{{ $product->name }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        
                        <p class="stock-info">
                            <small>المخزون: {{ $product->stock }}</small>
                        </p>
                        
                        <p class="card-text product-price">
                            {{ number_format($product->price, 2) }} L.E
                        </p>
                        
                        <a href="{{ route('viewproducts', $product->id) }}" class="btn btn-product-view mt-auto">
                            عرض المنتج
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="not-found-message">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    عذراً، لم يتم العثور على أي منتجات في هذا النطاق السعري.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($products->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <ul class="custom-pagination">
                
                {{-- Previous Page Link --}}
                @if ($products->onFirstPage())
                    <li class="disabled-page">
                        <span>&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $products->previousPageUrl() }}" rel="prev">
                            &lsaquo;
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($products->links()->elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled-page">
                            <span>{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $products->currentPage())
                                <li class="active-page">
                                    <span>{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}">
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
                        <a href="{{ $products->nextPageUrl() }}" rel="next">
                            &rsaquo;
                        </a>
                    </li>
                @else
                    <li class="disabled-page">
                        <span>&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    @endif
    
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('index') }}" class="btn btn-secondary px-4 py-2">
                <i class="fas fa-arrow-right me-2"></i> العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</div>
@endsection