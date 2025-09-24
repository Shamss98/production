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
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                @foreach($product->gallery_images as $galleryImage)
                    <img src="{{ asset('storage/' . $galleryImage) }}" 
                        alt="Gallery" 
                        class="img-thumbnail product-thumb" 
                        style="
                            width:70px; 
                            height:70px; 
                            object-fit:cover; 
                            border-radius:8px; 
                            transition:transform 0.2s ease, box-shadow 0.2s ease; 
                            cursor:pointer;
                        " 
                        onclick="changeMainImage(this)">
                @endforeach
            </div>

            <style>
                /* عند المرور بالماوس */
                .product-thumb:hover {
                    transform: scale(1.1);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                }

                /* شاشة الموبايل */
                @media (max-width: 576px) {
                    .product-thumb {
                        width: 50px !important;
                        height: 50px !important;
                    }
                }

                /* تابلت */
                @media (min-width: 577px) and (max-width: 768px) {
                    .product-thumb {
                        width: 60px !important;
                        height: 60px !important;
                    }
                }
        </style>

                <!-- End Gallery Images -->
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
<div class="mt-5" style="margin-top: 3rem;">
    <h3>منتجات ذات صلة</h3>
    <div class="row" style="display: flex; flex-wrap: wrap; margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach($relatedProducts as $related)
            <div class="col-md-3 mb-4" style="flex: 0 0 25%; max-width: 25%; padding-left: 0.5rem; padding-right: 0.5rem; margin-bottom: 1.5rem;">
                <div style="height: 400px; border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(37, 99, 235, 0.08), 0 1.5px 6px rgba(0, 0, 0, 0.04); overflow: hidden; transition: transform 0.25s cubic-bezier(.4, 0, .2, 1), box-shadow 0.25s cubic-bezier(.4, 0, .2, 1); background: #fff; animation: fadeInUp 0.7s cubic-bezier(.4, 0, .2, 1);">
                    <a href="{{ route('viewproducts', $related->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset('storage/' . $related->image) }}" 
                            class="card-img-top" 
                            alt="{{ $related->name }}" 
                            style="width: 100%; height: 200px; object-fit: contain; border-bottom: 1px solid #f3f4f6; transition: filter 0.3s; background: #f3f4f6;">
                    </a>

                    <div class="card-body" style="padding: 1rem;">
                    <h5 class="card-title" 
                        title="{{ $related->name }}"
                        style="font-size: 1.25rem; font-weight: 500; margin-bottom: 0.5rem;
                            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
                            max-width: 100%; display: block; cursor: pointer;">
                        {{ $related->name }}
                    </h5>
                        <p class="text-success" style="color: #28a745; font-size: 1rem; font-weight: 600;">${{ number_format($related->price, 2) }}</p>
                    <!--Rating-->
                    <x-rating/>
                    <!--End Rating-->
                        <a href="{{ route('viewproducts', $related->id) }}" class="btn btn-outline-primary btn-sm" style=" margin-top: 5px; display: inline-block; font-weight: 400; color: #007bff; text-align: center; vertical-align: middle; user-select: none; background-color: transparent; border: 1px solid #007bff; padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
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
