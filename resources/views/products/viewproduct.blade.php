@extends('layoutes.main')

@section('content')
<style>
    /*
    * ======================================
    * Custom Product Page Styles
    * ======================================
    */

    /* Main Container */
    .product-page-container {
        background-color: #f7f9fc;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    /* Product Image Card */
    .product-image-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        background-color: #fff;
    }

    /* Main Product Image */
    #mainProductImage {
        width: 100%;
        height: 450px;
        object-fit: contain;
        padding: 15px;
        background-color: #ffffff;
        transition: opacity 0.3s;
    }

    /* Thumbnails */
    .product-thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 3px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .product-thumb.active-thumb {
        border: 3px solid #007bff; /* Active thumbnail border color */
    }

    /* Product Title */
    .product-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #343a40;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    /* Offer Price */
    .offer-price-box {
        background-color: #fff3cd;
        border-radius: 8px;
        padding: 10px;
    }

    .offer-final-price {
        color: #dc3545;
        font-size: 2rem;
        font-weight: 700;
        margin-left: 10px;
    }

    .offer-old-price {
        color: #6c757d;
        font-size: 1.2rem;
        font-weight: 400;
    }

    .offer-tag {
        color: #dc3545;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Regular Price */
    .regular-price {
        color: #28a745;
        font-size: 2rem;
        font-weight: 700;
    }

    /* Product Description */
    .product-description {
        color: #555;
        line-height: 1.7;
    }

    /* Stock Status */
    .stock-label {
        font-weight: 600;
        color: #343a40;
    }

    .stock-value {
        font-weight: 700;
    }
    .stock-value.text-success { color: #28a745 !important; }
    .stock-value.text-danger { color: #dc3545 !important; font-weight: bold; }

    /* Action Buttons */
    .action-button {
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: background-color 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .add-to-cart-btn {
        background-color: #007bff;
        color: #fff;
    }
    .add-to-cart-btn:hover { background-color: #0056b3; color: #fff; }
    .add-to-cart-btn[disabled] { cursor: not-allowed; opacity: 0.6; }

    .checkout-btn {
        background-color: #28a745;
        color: #fff;
    }
    .checkout-btn:hover { background-color: #1e7e34; color: #fff; }

    /* Related Products */
    .related-products-title {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 25px;
    }

    .related-product-card {
        height: 100%;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fff;
    }
    .related-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .related-product-img {
        width: 100%;
        height: 180px;
        object-fit: contain;
        border-bottom: 1px solid #f3f4f6;
        background: #f8f9fa;
        padding: 10px;
    }

    .related-product-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #343a40;
    }

    .related-price-final {
        color: #dc3545;
    }

    .related-price-del {
        color: #6c757d;
        margin-right:6px;
        font-weight: 400;
    }

    .view-product-btn {
        display: inline-block;
        font-weight: 500;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #007bff;
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .view-product-btn:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Reviews Section */
    .review-form-card {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .review-form-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 20px;
    }

    .form-control-custom {
        padding: 8px 10px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        transition: box-shadow 0.3s;
    }
    .form-control-custom:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem #0d6efd33;
    }
    .form-control-textarea {
        resize: vertical;
    }

    .submit-review-btn {
        width: 100%;
        background-color: #198754;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: background-color 0.2s;
    }
    .submit-review-btn:hover { background-color: #157347; }

    /* Review Comments */
    .comments-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #0d6efd;
        margin-bottom: 20px;
    }

    .review-box {
        background: #ffffff;
        border-left: 5px solid #0d6efd;
        border-radius: 8px;
        transition: box-shadow 0.2s;
        margin-bottom: 15px;
    }
    .review-box:hover {
        box-shadow: 0 2px 16px #0d6efd22 !important;
    }

    .review-user-name {
        color: #198754;
        font-size: 1.1rem;
        margin-left: 10px;
    }

    .review-rating-stars {
        font-size: 1.2rem;
        color: #ffc107;
        margin-right: auto;
    }

    .review-comment-text {
        color: #444;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .review-date {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .no-reviews-alert {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
        font-size: 1.1em;
        border-radius: 8px;
    }
</style>

<div class="container py-5 product-page-container">
    <div class="row">

        <div class="col-md-6 px-4"> {{-- px-4 for padding-left and padding-right --}}
            <div class="product-image-card">
                <img id="mainProductImage"
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}">
            </div>

            <div class="d-flex gap-2 mt-3 justify-content-start overflow-auto pb-2">

                {{-- Main thumbnail --}}
                <img src="{{ asset('storage/' . $product->image) }}"
                    alt="Main"
                    class="product-thumb active-thumb"
                    onclick="changeMainImage(this)">

                {{-- Gallery Images --}}
                @foreach($product->gallery_images ?? [] as $galleryImage)
                    <img src="{{ asset('storage/' . $galleryImage) }}"
                        alt="Gallery"
                        class="product-thumb"
                        onclick="changeMainImage(this)">
                @endforeach
            </div>
        </div>

        <div class="col-md-6 px-4">
            <h1 class="product-title">
                {{ $product->name }}
            </h1>

            @php($activeOffer = $product->activeOffer()->first())
                @if($product->activeOffer)
                <div class="mb-3 offer-price-box">
                    <span class="offer-final-price">L.E {{ number_format($product->final_price, 2) }}</span>
                    <del class="offer-old-price">L.E {{ number_format($product->activeOffer->old_price, 2) }}</del>
                    <span class="offer-tag">(عرض خاص!)</span>
                </div>
            @else
                <h4 class="mb-3 regular-price">{{ number_format($product->price, 2) }} L.E</h4>
            @endif

            <p class="product-description">{{ $product->description }}</p>

            <div class="d-flex align-items-center mb-4 gap-4 border-top pt-3"> {{-- Replaced inline style with classes --}}
                <div class="stock-label">
                    المخزون:
                    <span class="stock-value {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $product->stock > 0 ? $product->stock : 'نفذت الكمية' }}
                    </span>
                </div>
                <div class="text-warning">
                    <x-rating/>
                </div>
            </div>

            <div class="d-flex gap-3 flex-wrap">
                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                                class="action-button add-to-cart-btn"
                                {{ $product->stock < 1 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus me-2"></i> اضف إلى السلة
                        </button>
                    </form>
                @else
                    <a href="{{ route('cartmessage') }}" class="action-button add-to-cart-btn">
                        <i class="fas fa-cart-plus me-2"></i> اضف إلى السلة
                    </a>
                @endauth

                <a href="{{ route('checkout.pay', $product->id) }}" class="action-button checkout-btn">
                    ادفع المنتج الآن
                </a>
            </div>
        </div>
    </div>

    <hr class="my-5 border-top border-secondary-subtle"> {{-- Added classes for hr styling --}}

    <div class="mt-5">
        <h3 class="related-products-title">منتجات ذات صلة</h3>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @forelse($relatedProducts as $related)
                <div class="col">
                    <div class="related-product-card">

                        <a href="{{ route('viewproducts', $related->id) }}" class="text-decoration-none text-dark">
                            <img src="{{ asset('storage/' . $related->image) }}"
                                alt="{{ $related->name }}"
                                class="related-product-img">
                        </a>

                        <div class="p-3 text-center">
                            <h5 title="{{ $related->name }}" class="related-product-title">
                                {{ $related->name }}
                            </h5>

                            @php($activeOffer = $related->activeOffer()->first())
                            @if($activeOffer)
                                <p class="fs-6 fw-bold mb-2">
                                    <span class="related-price-final">
                                        {{ number_format($related->final_price, 2) }} L.E
                                    </span>
                                    <del class="related-price-del">
                                        {{ number_format($activeOffer->old_price ?? $related->price, 2) }} L.E
                                    </del>
                                </p>
                            @else
                                <p class="text-success fs-6 fw-bold mb-2">
                                    {{ number_format($related->price, 2) }} L.E
                                </p>
                            @endif

                            <div class="mb-2"><x-rating/></div>

                            <a href="{{ route('viewproducts', $related->id) }}" class="view-product-btn">
                                عرض المنتج
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert text-center no-reviews-alert">
                        لا توجد منتجات ذات صلة حالياً.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <hr class="my-5 border-top border-secondary-subtle">

    @auth
        <div class="d-flex gap-4 flex-wrap justify-content-center">

            <div class="flex-grow-1" style="max-width: 500px; min-width: 350px;">
                <div class="review-form-card">
                    <h3 class="review-form-title">أضف مراجعتك</h3>
                    <form action="{{ route('products.reviews.store', $product) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="d-block mb-1 fw-medium">التقييم:</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" name="rating" id="rating" min="1" max="5" required
                                        class="form-control-custom" style="width: 80px;">
                                <span class="text-warning" id="starPreview" style="font-size: 1.5rem;"></span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="d-block mb-1 fw-medium">التعليق:</label>
                            <textarea name="comment" id="comment" required
                                    rows="3"
                                    class="form-control-custom form-control-textarea"></textarea>
                        </div>
                        <button type="submit" class="submit-review-btn">
                            إرسال المراجعة
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex-grow-1" style="min-width: 300px;">
                <h2 class="comments-title">التعليقات ({{ $product->reviews->count() }})</h2>
                @forelse($product->reviews as $review)
                <div class="review-box p-3 shadow-sm">
                    <div class="d-flex align-items-center mb-2">
                        <strong class="review-user-name">{{ $review->user->name ?? 'مستخدم غير معروف' }}</strong>
                        <span class="review-rating-stars">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </div>
                    <p class="review-comment-text">{{ $review->comment }}</p>
                    <small class="review-date">{{ $review->created_at->diffForHumans() }}</small>
                </div>
                @empty
                <div class="alert mt-3 no-reviews-alert">
                    لا توجد تعليقات حتى الآن. كن أول من يكتب تعليقاً!
                </div>
                @endforelse
            </div>
        </div>
    @endauth
</div>

<script>
    /**
     * Changes the main product image and updates the active thumbnail border.
     * @param {HTMLImageElement} img - The clicked thumbnail image element.
     */
    function changeMainImage(img) {
        // Update main image source
        document.getElementById('mainProductImage').src = img.src;

        // Remove active style from all thumbnails
        document.querySelectorAll('.product-thumb').forEach(thumb => {
            thumb.classList.remove('active-thumb');
        });

        // Add active style to the clicked thumbnail
        img.classList.add('active-thumb');
    }

    /**
     * Live star preview for rating input on the review form.
     */
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInput = document.getElementById('rating'); // Changed selector to use ID
        const starPreview = document.getElementById('starPreview');

        if (ratingInput && starPreview) {
            ratingInput.addEventListener('input', function() {
                let val = parseInt(this.value) || 0;
                // Clamp value between 1 and 5
                val = Math.max(1, Math.min(5, val));
                this.value = val; // Set the clamped value back to the input
                starPreview.innerHTML = '★'.repeat(val) + '☆'.repeat(5-val);
            });
            // Initial call to set the stars if there's a default value
            ratingInput.dispatchEvent(new Event('input'));
        }
    });
</script>
@endsection
