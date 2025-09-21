@extends('layoutes.main') <!-- أو أي Layout تستخدمه -->

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <div class="mb-3">
                <!-- Main Image -->
                <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}" 
                    alt="{{ $product->name }}" 
                    class="img-fluid rounded border" 
                    style="max-height: 400px;">
            </div>
            <div class="d-flex gap-2">
                <!-- Main thumbnail -->
                <img src="{{ asset('storage/' . $product->image) }}" 
                    alt="Main" 
                    class="img-thumbnail product-thumb" 
                    style="width: 70px; height: 70px; cursor:pointer;" 
                    onclick="changeMainImage(this)">
                
                <!-- Gallery Images -->
                @foreach($product->gallery_images as $galleryImage)
                    <img src="{{ asset('storage/' . $galleryImage) }}" 
                        alt="Gallery" 
                        class="img-thumbnail product-thumb" 
                        style="width: 70px; height: 70px; cursor:pointer;" 
                        onclick="changeMainImage(this)">
                @endforeach
            </div>
        </div>
        <!-- Product Details -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <h4 class="text-success mb-3">${{ number_format($product->price, 2) }}</h4>
            <p>{{ $product->description }}</p>
            
            <div class="mb-3">
                <strong>Stock:</strong>
                <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger fw-bold' }}">
                    {{ $product->stock > 0 ? $product->stock : 'Out of stock' }}
                </span>
            </div>

            <div class="d-flex gap-2">
                <!-- Add to Cart -->
                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $product->stock < 1 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus"></i> اضف إلى السلة
                        </button>
                    </form>
                @else
                    <a href="{{ route('cartmessage') }}" class="btn btn-primary">
                        <i class="fas fa-cart-plus"></i> اضف إلى السلة
                    </a>
                @endauth

                <a href="{{ route('checkout.pay', $product->id) }}" class="btn btn-primary">
    ادفع المنتج
</a>
            </div>
        </div>
    </div>
    <hr>
       <!-- ✅ Related Products Section -->
    <div class="mt-5">
        <h3>منتجات ذات صلة</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
                <div class="col-md-3 mb-4">
                    <div class="">
                        <a href="{{ route('viewproducts', $related->id) }}">
                            <img src="{{ asset('storage/' . $related->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $related->name }}" 
                                 style="min-height: 200px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $related->name }}</h5>
                            <p class="text-success">${{ number_format($related->price, 2) }}</p>
                            <a href="{{ route('viewproducts', $related->id) }}" class="btn btn-outline-primary btn-sm">
                                عرض المنتج
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End Related Products -->
</div>
<hr>
<!-- Reviews Section -->
@auth
    <div class="d-flex gap-4 flex-wrap">
        <div class="card shadow-sm mb-4 animate__animated animate__fadeInUp" style="max-width: 600px; flex: 1 1 350px;">
            <div class="card-body">
                <h3 class="card-title mb-3 text-primary">أضف مراجعتك</h3>
                <form action="{{ route('products.reviews.store', $product) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">التقييم:</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" name="rating" min="1" max="5" required class="form-control w-auto" style="transition: box-shadow 0.3s;" onfocus="this.style.boxShadow='0 0 0 0.2rem #0d6efd33'" onblur="this.style.boxShadow='none'">
                            <span class="text-warning fs-4" id="starPreview"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">التعليق:</label>
                        <textarea name="comment" required class="form-control" rows="3" style="transition: box-shadow 0.3s;" onfocus="this.style.boxShadow='0 0 0 0.2rem #0d6efd33'" onblur="this.style.boxShadow='none'"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success px-4 animate__animated animate__pulse animate__infinite">إرسال المراجعة</button>
                </form>
            </div>
        </div>
        <div style="min-width: 300px; flex: 1 1 300px;">
            <h2 class="mb-3" style="font-weight: bold; color: #0d6efd;">التعليقات ({{ $product->reviews->count() }})</h2>
            @forelse($product->reviews as $review)
            <div class="review-box mb-3 p-3 rounded shadow-sm animate__animated animate__fadeIn" style="background: #f8f9fa;">
                <div class="d-flex align-items-center mb-2">
                <strong class="me-2" style="color: #198754;">{{ $review->user->name ?? 'مستخدم غير معروف' }}</strong>
                <span class="badge bg-warning text-dark ms-auto">
                    <span style="font-size: 1.1em;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                </span>
                </div>
                <p class="mb-1" style="color: #333;">{{ $review->comment }}</p>
                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
            @empty
            <div class="alert alert-info mt-3" style="font-size: 1.1em;">
                لا توجد تعليقات حتى الآن. كن أول من يكتب تعليقاً!
            </div>
            @endforelse
        </div>
        <style>
            .review-box {
            border-left: 4px solid #0d6efd;
            transition: box-shadow 0.2s;
            }
            .review-box:hover {
            box-shadow: 0 2px 16px #0d6efd22;
            }
        </style>
    </div>
    <style>
        /* Animate.css CDN for animation classes */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    </style>
    <script>
        // Live star preview for rating input
        document.addEventListener('DOMContentLoaded', function() {
            const ratingInput = document.querySelector('input[name="rating"]');
            const starPreview = document.getElementById('starPreview');
            if (ratingInput && starPreview) {
                ratingInput.addEventListener('input', function() {
                    let val = parseInt(this.value) || 0;
                    val = Math.max(1, Math.min(5, val));
                    starPreview.innerHTML = '★'.repeat(val) + '☆'.repeat(5-val);
                });
                ratingInput.dispatchEvent(new Event('input'));
            }
        });
    </script>
@endauth



<!-- Script لتغيير الصورة الرئيسية عند الضغط على أي صورة مصغرة -->
<script>
    function changeMainImage(img) {
        document.getElementById('mainProductImage').src = img.src;
    }
</script>
@endsection
