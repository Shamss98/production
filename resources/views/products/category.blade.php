@extends('layoutes.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
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
<div class="brands d-flex gap-3 mb-4">
    @foreach($category->brands as $brandItem)
        <div style="text-align: center;">
            <a href="{{ route('products.byBrand', [$category->id, $brandItem->id]) }}"
               style="display: inline-block; padding: 10px; border: 2px solid #ddd; border-radius: 10px; transition: all 0.3s ease; {{ isset($brand) && $brand->id == $brandItem->id ? 'border-color:#007bff; background:#f0f8ff;' : '' }}">
                <img src="{{ asset('storage/' . $brandItem->image) }}" 
                     alt="{{ $brandItem->name }}" 
                     width="100" 
                     style="display: block; margin: 0 auto; max-height: 120px; object-fit: contain;">
            </a>
            <h3 class="mt-2" style="font-size: 20px; font-weight: 600; color: #333;">
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
                    <h4>لا توجد منتجات</h4>
                    <p>لا توجد منتجات في هذه الفئة حالياً</p>
                </div>
            </div>
        @endif
    </div>
    
    @if($products->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
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
@endsection
