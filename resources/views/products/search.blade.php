@extends('layoutes.main')

@section('content')
<style>
    .search-results-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #2563eb;
        letter-spacing: 0.5px;
        animation: fadeInDown 0.7s cubic-bezier(.4,0,.2,1);
    }
    .product-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(37,99,235,0.08), 0 1.5px 6px rgba(0,0,0,0.04);
        overflow: hidden;
        transition: transform 0.25s cubic-bezier(.4,0,.2,1), box-shadow 0.25s cubic-bezier(.4,0,.2,1);
        background: #fff;
        animation: fadeInUp 0.7s cubic-bezier(.4,0,.2,1);
    }
    .product-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(37,99,235,0.16), 0 3px 12px rgba(0,0,0,0.08);
    }
.product-card img {
    height: 200px;
    object-fit: contain; /* تم تعديل هذه الخاصية */
    border-bottom: 1px solid #f3f4f6;
    transition: filter 0.3s;
    width: 100%;
    background: #f3f4f6;
}
    .product-card:hover img {
        filter: brightness(0.95) saturate(1.1);
    }
    .product-card .card-body {
        padding: 1rem 1.25rem;
        text-align: center;
    }
    .product-card h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1e293b;
        letter-spacing: 0.2px;
        transition: color 0.2s;
    }
    .product-card:hover h5 {
        color: #2563eb;
    }
    .product-card p {
        color: #16a34a;
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 0;
        letter-spacing: 0.1px;
    }
    .no-products {
        color: #ef4444;
        font-size: 1.15rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: center;
        animation: fadeIn 0.7s cubic-bezier(.4,0,.2,1);
    }
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(32px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-32px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeIn {
        from { opacity: 0;}
        to { opacity: 1;}
    }
    /* Responsive grid for cards */
    @media (max-width: 991px) {
        .col-md-3 { flex: 0 0 50%; max-width: 50%; }
    }
    @media (max-width: 575px) {
        .col-md-3 { flex: 0 0 100%; max-width: 100%; }
    }
</style>
<div class="container py-4">
    <h4 class="search-results-title">Search results for: "{{ $query }}"</h4>

    @if($products->count() > 0)
        <div class="row" style="display: flex; flex-wrap: wrap;">
            @foreach($products as $product)
                <div class="col-md-3 mb-4 d-flex align-items-stretch">
                    <div class="card product-card w-100">
                        <a href="{{Route('viewproducts', $product->id)}}">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ $product->price }} L.E</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    @else
        <p class="no-products">No products found.</p>
    @endif
</div>
@endsection
