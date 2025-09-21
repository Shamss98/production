@extends('layoutes.main')

@section('content')
<style>
    .offer-card {
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
    }
    .offer-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0,0,0,0.18);
    }
    .offer-img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        transition: filter 0.3s;
    }
    .offer-card:hover .offer-img {
        filter: brightness(0.95) saturate(1.2);
    }
    .offer-price {
        color: #e63946;
        font-weight: bold;
        font-size: 1.2rem;
        margin-right: 8px;
        animation: pulse 1.2s infinite alternate;
    }
    @keyframes pulse {
        to { color: #ff6f61; }
    }
    .no-offers {
        text-align: center;
        color: #888;
        font-size: 1.2rem;
        margin-top: 40px;
        animation: fadeIn 1s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="container">
    <h1 class="mb-4 text-center">Special Offers</h1>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4 d-flex align-items-stretch">
                <div class="card offer-card w-100 h-100 position-relative">
                    <!-- Offer Badge -->
                    <span class="badge bg-danger position-absolute" style="top: 12px; left: 12px; z-index: 2; font-size: 1rem; padding: 0.5em 1em;">
                        Offer
                    </span>
                    <a href="{{ route('viewproducts', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="card-img-top offer-img" 
                         alt="{{ $product->name }}">
                         </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text flex-grow-1">{{ $product->description }}</p>
                        <p class="card-text">
                            <span class="offer-price">${{ $product->offer_price }}</span>
                            <del class="text-muted">${{ $product->original_price }}</del>
                        </p>
                        <a href="{{ route('viewproducts', $product->id) }}" class="btn btn-primary mt-auto">View Product</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="no-offers">No offers available at the moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection