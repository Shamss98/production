@extends('layoutes.main')

@section('content')
<style>
    /* -------------------------------------- */
    /* 1. Page and Title Styling */
    /* -------------------------------------- */
    body {
        background-color: #f7f9fc; /* خلفية فاتحة للموقع */
    }

    .main-offer-title {
        font-weight: 800;
        font-size: 2.8rem;
        color: #d9534f; /* لون أحمر/مشتعل يناسب العروض */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 1.5rem;
        margin-bottom: 3rem;
        position: relative;
    }
    .main-offer-title::after {
        /* content: '🔥';  */
        font-size: 1.5rem;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(100%);
    }

    /* -------------------------------------- */
    /* 2. Offer Card Styling */
    /* -------------------------------------- */
    .offer-card {
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.4s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #eee; 
    }
    .offer-card:hover {
        transform: translateY(-10px); /* رفع أعلى قليلاً */
        box-shadow: 0 15px 30px rgba(0,0,0,0.25);
    }
    
    .offer-badge {
        background-color: #dc3545 !important; /* أحمر واضح */
        top: 15px !important; 
        left: 15px !important; 
        font-size: 1rem;
        font-weight: 700;
        padding: 0.4em 1em;
        border-radius: 50px; 
        z-index: 9999;
    }

    .offer-img {
        height: 220px; /* زيادة ارتفاع الصورة قليلاً */
        width: 100%;
        object-fit: contain;
        padding: 10px;
        transition: transform 0.5s;
    }
    .offer-card:hover .offer-img {
        transform: scale(1.05); /* تكبير الصورة عند التمرير */
        filter: none;
    }

    /* -------------------------------------- */
    /* 3. Price and Text Styling */
    /* -------------------------------------- */
    .card-title {
        font-weight: 700;
        color: #333;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }
    
    .limited-time-text {
        color: #d9534f;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 10px;
    }
    
    .price-container {
        display: flex;
        align-items: baseline;
        margin-top: 5px;
        margin-bottom: 15px;
    }
    
    /* New Price (Offer) */
    .offer-price {
        color: #ff6f61; /* لون جديد ومشرق للخصم */
        font-weight: 900;
        font-size: 1.5rem; /* حجم أكبر */
        margin-right: 15px;
        animation: pulse 1.5s infinite alternate; /* إبطاء الوميض قليلاً */
    }
    @keyframes pulse {
        0% { transform: scale(1); color: #e63946; }
        100% { transform: scale(1.05); color: #ff6f61; }
    }
    
    /* Old Price */
    .old-price {
        color: #999;
        font-size: 1rem;
        text-decoration: line-through;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* -------------------------------------- */
    /* 4. No Offers Message */
    /* -------------------------------------- */
    .no-offers {
        padding: 50px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        color: #6c757d;
        font-size: 1.5rem;
        font-weight: 500;
        margin-top: 40px;
        animation: fadeIn 1s;
    }

</style>

<div class="container">
    <h1 class="main-offer-title text-center">افضل الخصومات الحالية</h1>
    <div class="row">
        @forelse($products as $product)
            {{-- Col-md-3 for 4 products on large/medium screens --}}
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                <div class="card offer-card w-100 h-100 position-relative">
                    
                    <span class="badge offer-badge position-absolute">
                        عرض خاص
                    </span>
                    
                    <a href="{{ route('viewproducts', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                        class="card-img-top offer-img" 
                        alt="{{ $product->name }}">
                    </a>
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        
                        <p class="limited-time-text">
                            <i class="fas fa-clock me-1"></i> عرض لفترة محدودة!
                        </p>
                        
                        <div class="price-container mt-auto">
                            @php($activeOffer = $product->activeOffer)
                            @if ($activeOffer)
                                <span class="offer-price">{{ number_format($activeOffer->new_price, 2) }} L.E</span>
                                <del class="old-price">{{ number_format($activeOffer->old_price, 2) }} L.E</del>
                            @else
                                {{-- Fallback to regular price if no active offer is found, but the card is displayed --}}
                                <span class="offer-price" style="animation: none;">{{ number_format($product->price, 2) }} L.E</span>
                            @endif
                        </div>
                        
                        <a href="{{ route('viewproducts', $product->id) }}" class="btn btn-primary">
                            شاهد التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="no-offers">
                    <i class="fas fa-search me-2"></i> عذراً، لا توجد عروض متوفرة حالياً. 
                </p>
            </div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center mt-5 mb-5">
    @if ($products->hasPages())
        {{ $products->links('pagination::bootstrap-4') }} 
        {{-- يفضل استخدام تنسيق Bootstrap 4 أو 5 للظهور بشكل أفضل --}}
    @endif
</div>
@endsection