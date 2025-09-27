@extends('layoutes.main')

@section('content')
<div class="container py-5" style="background-color: #f7f9fc; border-radius: 15px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <div class="row">
        
        <div class="col-md-6" style="padding-left: 20px; padding-right: 20px;">
            <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); background-color: #fff;">
                <img id="mainProductImage" 
                     src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     style="width: 100%; height: 450px; object-fit: contain; padding: 15px; background-color: #ffffff; transition: opacity 0.3s;">
            </div>
            
            <div class="d-flex gap-2 mt-3 justify-content-start" style="overflow-x: auto; padding-bottom: 10px;">
                
                {{-- Main thumbnail --}}
                <img src="{{ asset('storage/' . $product->image) }}" 
                    alt="Main" 
                    class="product-thumb active-thumb" 
                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 3px solid #007bff; cursor:pointer; transition: all 0.2s ease;" 
                    onclick="changeMainImage(this)">
                
                {{-- Gallery Images --}}
                @foreach($product->gallery_images ?? [] as $galleryImage)
                    <img src="{{ asset('storage/' . $galleryImage) }}" 
                        alt="Gallery" 
                        class="product-thumb" 
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 3px solid transparent; cursor:pointer; transition: all 0.2s ease;" 
                        onclick="changeMainImage(this)">
                @endforeach
            </div>
        </div>
        
        <div class="col-md-6" style="padding-left: 20px; padding-right: 20px;">
            <h1 style="font-size: 2.2rem; font-weight: 700; color: #343a40; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
                {{ $product->name }}
            </h1>
            
             @php($activeOffer = $product->activeOffer()->first())
                @if($product->activeOffer)
                <div class="mb-3" style="background-color: #fff3cd; border-radius: 8px; padding: 10px;">
                    <span style="color: #dc3545; font-size: 2rem; font-weight: 700; margin-left: 10px;">L.E {{ number_format($product->final_price, 2) }}</span>
                    <del style="color: #6c757d; font-size: 1.2rem; font-weight: 400;">L.E {{ number_format($product->activeOffer->old_price, 2) }}</del>
                    <span style="color: #dc3545; font-weight: 600; font-size: 0.9rem;">(عرض خاص!)</span>
                </div>
            @else
                <h4 class="text-success mb-3" style="color: #28a745; font-size: 2rem; font-weight: 700;">${{ number_format($product->price, 2) }}</h4>
            @endif
            
            <p style="color: #555; line-height: 1.7;">{{ $product->description }}</p>
            
            <div class="d-flex align-items-center mb-4 gap-4" style="border-top: 1px solid #eee; padding-top: 15px;">
                <div style="font-weight: 600; color: #343a40;">
                    المخزون: 
                    <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger fw-bold' }}" style="font-weight: 700; color: {{ $product->stock > 0 ? '#28a745' : '#dc3545' }};">
                        {{ $product->stock > 0 ? $product->stock : 'نفذت الكمية' }}
                    </span>
                </div>
                <div style="font-size: 1.1rem; color: #ffc107;">
                    <x-rating/>
                </div>
            </div>
            
            <div class="d-flex gap-3 flex-wrap">
                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" 
                                style="background-color: #007bff; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; font-size: 1.1rem; transition: background-color 0.2s; cursor: {{ $product->stock < 1 ? 'not-allowed' : 'pointer' }}; opacity: {{ $product->stock < 1 ? 0.6 : 1 }};"
                                onmouseover="this.style.backgroundColor='#0056b3'"
                                onmouseout="this.style.backgroundColor='{{ $product->stock < 1 ? '#007bff' : '#007bff' }}'"
                                {{ $product->stock < 1 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus me-2"></i> اضف إلى السلة
                        </button>
                    </form>
                @else
                    <a href="{{ route('cartmessage') }}" 
                       style="background-color: #007bff; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; font-size: 1.1rem; text-decoration: none; transition: background-color 0.2s;"
                       onmouseover="this.style.backgroundColor='#0056b3'"
                       onmouseout="this.style.backgroundColor='#007bff'">
                        <i class="fas fa-cart-plus me-2"></i> اضف إلى السلة
                    </a>
                @endauth

                <a href="{{ route('checkout.pay', $product->id) }}" 
                   style="background-color: #28a745; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; font-size: 1.1rem; text-decoration: none; transition: background-color 0.2s;"
                   onmouseover="this.style.backgroundColor='#1e7e34'"
                   onmouseout="this.style.backgroundColor='#28a745'">
                    ادفع المنتج الآن
                </a>
            </div>
        </div>
    </div>
    
    <hr style="margin-top: 40px; margin-bottom: 40px; border-top: 1px solid #ddd;">
    
    <div class="mt-5">
        <h3 style="font-weight: 700; color: #343a40; margin-bottom: 25px;">منتجات ذات صلة</h3>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @forelse($relatedProducts as $related)
                <div class="col">
                    <div style="height: 100%; border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s; background: #fff;"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0, 0, 0, 0.15)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.08)'">
                        
                        <a href="{{ route('viewproducts', $related->id) }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('storage/' . $related->image) }}" 
                                alt="{{ $related->name }}" 
                                style="width: 100%; height: 180px; object-fit: contain; border-bottom: 1px solid #f3f4f6; background: #f8f9fa; padding: 10px;">
                        </a>

                        <div style="padding: 1rem; text-align: center;">
                            <h5 title="{{ $related->name }}"
                                style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #343a40;">
                                {{ $related->name }}
                            </h5>
                            
                            @php($activeOffer = $related->activeOffer()->first())
                            @if($activeOffer)
                                <p style="font-size: 1rem; font-weight: 700; margin-bottom: 10px;">
                                    <span style="color: #dc3545;">${{ number_format($related->effective_price, 2) }}</span>
                                    <del style="color: #6c757d; margin-right:6px; font-weight: 400;">${{ number_format($related->price, 2) }}</del>
                                </p>
                            @else
                                <p style="color: #28a745; font-size: 1rem; font-weight: 700; margin-bottom: 10px;">${{ number_format($related->price, 2) }}</p>
                            @endif
                            
                            <div style="margin-bottom: 10px;"><x-rating/></div>
                            
                            <a href="{{ route('viewproducts', $related->id) }}" 
                               style="display: inline-block; font-weight: 500; color: #007bff; background-color: #fff; border: 1px solid #007bff; padding: 6px 12px; font-size: 0.9rem; border-radius: 6px; text-decoration: none; transition: all 0.2s;"
                               onmouseover="this.style.backgroundColor='#007bff'; this.style.color='#fff';"
                               onmouseout="this.style.backgroundColor='#fff'; this.style.color='#007bff';">
                                عرض المنتج
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb;">
                        لا توجد منتجات ذات صلة حالياً.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    
    <hr style="margin-top: 40px; margin-bottom: 40px; border-top: 1px solid #ddd;">
    
    @auth
        <div class="d-flex gap-4 flex-wrap justify-content-center">
            
            <div style="max-width: 500px; flex: 1 1 350px;">
                <div style="background-color: #ffffff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #0d6efd; margin-bottom: 20px;">أضف مراجعتك</h3>
                    <form action="{{ route('products.reviews.store', $product) }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 15px;">
                            <label for="rating" style="display: block; margin-bottom: 5px; font-weight: 500;">التقييم:</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" name="rating" min="1" max="5" required 
                                       style="width: 80px; padding: 8px 10px; border: 1px solid #ced4da; border-radius: 6px; transition: box-shadow 0.3s;" 
                                       onfocus="this.style.boxShadow='0 0 0 0.2rem #0d6efd33'" 
                                       onblur="this.style.boxShadow='none'">
                                <span class="text-warning fs-4" id="starPreview" style="font-size: 1.5rem; color: #ffc107;"></span>
                            </div>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label for="comment" style="display: block; margin-bottom: 5px; font-weight: 500;">التعليق:</label>
                            <textarea name="comment" required 
                                      rows="3" 
                                      style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; transition: box-shadow 0.3s; resize: vertical;"
                                      onfocus="this.style.boxShadow='0 0 0 0.2rem #0d6efd33'" 
                                      onblur="this.style.boxShadow='none'"></textarea>
                        </div>
                        <button type="submit" 
                                style="width: 100%; background-color: #198754; color: #fff; border: none; padding: 10px; border-radius: 6px; font-weight: 600; font-size: 1.1rem; transition: background-color 0.2s;"
                                onmouseover="this.style.backgroundColor='#157347'"
                                onmouseout="this.style.backgroundColor='#198754'">
                            إرسال المراجعة
                        </button>
                    </form>
                </div>
            </div>
            
            <div style="min-width: 300px; flex: 1 1 300px;">
                <h2 style="font-size: 1.8rem; font-weight: bold; color: #0d6efd; margin-bottom: 20px;">التعليقات ({{ $product->reviews->count() }})</h2>
                @forelse($product->reviews as $review)
                <div class="review-box mb-3 p-3 rounded shadow-sm" 
                     style="background: #ffffff; border-left: 5px solid #0d6efd; border-radius: 8px; transition: box-shadow 0.2s; margin-bottom: 15px;"
                     onmouseover="this.style.boxShadow='0 2px 16px #0d6efd22'"
                     onmouseout="this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)'">
                    <div class="d-flex align-items-center mb-2">
                        <strong style="color: #198754; font-size: 1.1rem; margin-left: 10px;">{{ $review->user->name ?? 'مستخدم غير معروف' }}</strong>
                        <span style="font-size: 1.2rem; color: #ffc107; margin-right: auto;">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </div>
                    <p style="color: #444; margin-bottom: 5px; font-size: 1rem;">{{ $review->comment }}</p>
                    <small style="color: #6c757d; font-size: 0.85rem;">{{ $review->created_at->diffForHumans() }}</small>
                </div>
                @empty
                <div class="alert alert-info mt-3" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-size: 1.1em; border-radius: 8px;">
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
        
        // Remove active class/style from all thumbnails
        document.querySelectorAll('.product-thumb').forEach(thumb => {
            thumb.style.border = '3px solid transparent';
        });
        
        // Add active style to the clicked thumbnail
        img.style.border = '3px solid #007bff';
    }

    /**
     * Live star preview for rating input on the review form.
     */
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInput = document.querySelector('input[name="rating"]');
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