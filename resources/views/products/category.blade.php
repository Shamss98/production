@extends('layoutes.main')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" style="background: #f8f9fa; padding: 10px 15px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <ol class="breadcrumb mb-0" style="margin: 0; font-size: 16px;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" style="text-decoration: none; color: #007bff; font-weight: 500;">
                            الرئيسية
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.index') }}" style="text-decoration: none; color: #007bff; font-weight: 500;">
                            المنتجات
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #555; font-weight: 600;">
                        {{ $category->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">منتجات {{ $category->name }}</h1>
        </div>
    </div>

    <!-- ✅ البراندات -->
    <div class="d-flex flex-wrap gap-4 justify-content-center mb-4">
        @foreach($category->brands as $brandItem)
            <div class="text-center" style="flex: 1 1 120px; max-width: 200px;">
                <a href="{{ route('products.byBrand', [$category->id, $brandItem->id]) }}"
                class="d-block p-3 border rounded-3"
                style="transition: all 0.3s ease; {{ isset($brand) && $brand->id == $brandItem->id ? 'border-color:#007bff; background:#f0f8ff;' : '' }}">
                    <img src="{{ asset('storage/' . $brandItem->image) }}" 
                        alt="{{ $brandItem->name }}" 
                        class="img-fluid" 
                        style="max-height: 120px; object-fit: contain;">
                </a>
                <h3 class="mt-2 fs-6 fw-semibold text-dark">
                    {{ $brandItem->name }}
                </h3>
            </div>
        @endforeach
    </div>

    <hr>
    
    <div class="row mt-4">
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
        @endif
    </div>

    @if($products->count() > 0)
        {{ $products->links('vendor.pagination.custom') }}
    @endif

    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">
                العودة لجميع المنتجات
            </a>
            <a href="{{ route('index') }}" class="btn btn-primary">
                العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</div>

@if($products->count() == 0)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4>لا توجد منتجات</h4>
                <p>لا توجد منتجات في هذه الفئة حالياً</p>
            </div>
        </div>
    </div>
@endif

@endsection
