@extends('layoutes.main')

@section('content')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translate3d(0, 40px, 0);}
    to { opacity: 1; transform: none;}
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
.animated-fadeInUp { animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) both; }
.animated-fadeIn { animation: fadeIn 1.2s ease both; }
.category-card {
    transition: transform 0.2s, box-shadow 0.2s;
    will-change: transform;
}
.category-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 32px rgba(37,99,235,0.13);
}
.btn-animated { transition: background 0.3s, transform 0.18s; }
.btn-animated:hover {
    transform: scale(1.06) translateY(-2px);
    background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
}
.category-image {
    width: 100%;
    height: 180px;
    object-fit: contain;
    border-radius: 14px 14px 0 0;
}
@media (max-width: 991.98px) {
    .category-image { height: 140px; }
}
@media (max-width: 767.98px) {
    .category-image { height: 100px; }
}
@media (max-width: 575.98px) {
    .category-image { height: 70px; }
}
.ads-section {
    margin-top: 1rem;
    margin-bottom: 1rem;
}
.ad-card {
    width: 350px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(37,99,235,0.07);
    transition: box-shadow 0.2s, transform 0.2s;
    padding: 10px 8px 6px 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    margin: 0 auto;
}
.ad-card:hover {
    box-shadow: 0 8px 32px rgba(37,99,235,0.13);
    transform: translateY(-4px) scale(1.03);
}
.ad-img {
    width: 100%;
    max-width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 10px;
    background: #f3f4f6;
    transition: box-shadow 0.2s;
}
@media (max-width: 991.98px) {
    .ad-card { height: 140px; }
    .ad-img { height: 120px; }
}
@media (max-width: 767.98px) {
    .ad-card { height: 100px; min-height: 80px; padding: 6px 4px 4px 4px;}
    .ad-img { height: 80px; }
}
@media (max-width: 575.98px) {
    .ad-card { height: 70px; min-height: 60px; padding: 4px 2px 2px 2px;}
    .ad-img { height: 50px; }
}
.category-scroll-wrapper {
    position: relative;
    margin-bottom: 1.2rem;
}
.category-scroll {
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    padding-bottom: 10px;
    scrollbar-width: thin;
    scrollbar-color: #2563eb #e5e7eb;
    -webkit-overflow-scrolling: touch;
}
.category-scroll-item {
    flex: 0 0 210px;
    max-width: 210px;
    min-width: 180px;
    display: inline-block;
}
@media (max-width: 991.98px) {
    .category-scroll-item { flex: 0 0 170px; max-width: 170px; min-width: 140px; }
}
@media (max-width: 767.98px) {
    .category-scroll-item { flex: 0 0 130px; max-width: 130px; min-width: 110px; }
}
@media (max-width: 575.98px) {
    .category-scroll-item { flex: 0 0 100px; max-width: 100px; min-width: 90px; }
}
.category-scroll::-webkit-scrollbar { height: 8px; }
.category-scroll::-webkit-scrollbar-thumb { background: #2563eb; border-radius: 6px; }
.category-scroll::-webkit-scrollbar-track { background: #e5e7eb; border-radius: 6px; }
</style>

<div class="container" style="max-width: 1750px;">
    <div class="" style=" padding: 1.2rem 0.7rem; margin: 1.2rem auto;">
        <!-- Ads Section -->
        <div class="row g-2 ads-section">
            @foreach ($ads as $ad)
                @if($ad->status)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                        <h6 dir="rtl" class="mb-2" style="text-align:right; font-weight:600; color:#2563eb; letter-spacing:0.5px; font-size:1.01rem;">
                            {{ $ad->title }}
                        </h6>
                        <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" style="text-decoration:none;">
                            <div class="ad-card">
                                <img src="{{ asset('storage/' . $ad->image) }}"
                                    alt="{{ $ad->title }}"
                                    class="ad-img"
                                    loading="lazy">
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- End Ads Section -->

        <!-- Category Slider -->
        <div class="row" style="margin-bottom: 1rem; margin-top: 1.2rem;">
            <div class="col-12 px-0">
                <h2 class="mb-3 text-center" style="font-weight:700; color:#2b292a;">
                    <i class="fa fa-th-large"></i> كل الاقسام
                </h2>
            </div>
        </div>
        <div class="category-scroll-wrapper">
            <div 
                class="category-scroll d-flex flex-row gap-2 animated-fadeInUp"
                id="categoryScroll"
            >
                @if($categories->count() > 0)
                <!-- Scroll buttons for categories -->
                <button 
                    id="categorySliderLeft"   
                    type="button" 
                    class="btn btn-light shadow position-absolute d-flex align-items-center justify-content-center"
                    style="top: 50%; left: 1px; transform: translateY(-50%); z-index: 2; width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e5e7eb; background: #fff; font-size: 1.1rem;"
                    aria-label="سابق"
                >
                    <i class="fa fa-chevron-right"></i>
                </button>
                <button 
                    id="categorySliderRight" 
                    type="button" 
                    class="btn btn-light shadow position-absolute d-flex align-items-center justify-content-center"
                    style="top: 50%; right: 1px; transform: translateY(-50%); z-index: 2; width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e5e7eb; background: #fff; font-size: 1.1rem;"
                    aria-label="التالي"
                >
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div id="categorySlider" class="category-scroll d-flex gap-3 overflow-auto pb-2" style="scroll-behavior: smooth;">
                    <!-- End Scroll buttons for categories -->
                    @foreach($categories as $i => $category)
                        <div class="category-scroll-item">
                            <a href="{{ route('products.category', $category->id) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm category-card animated-fadeInUp" style="border-radius: 14px; border: none; animation-delay: {{ 0.1 + $i*0.08 }}s;">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" 
                                            alt="{{ $category->name }}" 
                                            class="category-image"
                                            onerror="this.style.display='none'">
                                    @endif
                                    <div class="card-body text-center" style="padding: 1.2rem 0.5rem;">
                                        <h5 class="card-title" style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
                                            {{ $category->name }}
                                        </h5>
                                        @if($category->description)
                                            <p class="card-text text-muted" style="font-size: 0.92rem; min-height: 2em;">
                                                {{ Str::limit($category->description, 50) }}
                                            </p>
                                        @endif
                                        <span 
                                            class="btn btn-primary btn-animated"
                                            style="margin-top: 0.7rem; padding: 0.5rem 1.1rem; font-weight: 500; border-radius: 8px; background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%); border: none; pointer-events: none;">
                                            عرض المنتجات
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center animated-fadeInUp" style="font-size: 1.1rem; border-radius: 10px;">
                            لا توجد فئات متاحة حالياً
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
        <!-- End Category Slider -->

        @if($products->count() > 0)
        <div class="mt-4 position-relative">
            <h2 class="mb-3 text-center" style="font-weight:700; color:#eab308;">
                <i class="fa fa-bolt"></i> العروض المميزة
            </h2>
            <!-- Scroll buttons for offers -->
            <button 
                id="offersSliderLeft" 
                type="button" 
                class="btn btn-light shadow position-absolute d-flex align-items-center justify-content-center"
                style="top: 50%; left: 1px; transform: translateY(-50%); z-index: 2; width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e5e7eb; background: #fff; font-size: 1.1rem;"
                aria-label="سابق"
            >
                <i class="fa fa-chevron-right"></i>
            </button>
            <button 
                id="offersSliderRight" 
                type="button" 
                class="btn btn-light shadow position-absolute d-flex align-items-center justify-content-center"
                style="top: 50%; right: 1px; transform: translateY(-50%); z-index: 2; width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e5e7eb; background: #fff; font-size: 1.1rem;"
                aria-label="التالي"
            >
                <i class="fa fa-chevron-left"></i>
            </button>
            <div id="offersSlider" class="category-scroll d-flex gap-3 overflow-auto pb-2" style="scroll-behavior: smooth;">
                <!-- End Scroll buttons for offers -->
                @foreach($products as $i => $product)
                    <div class="category-scroll-item">
                        <a href="{{ route('viewproducts', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm category-card animated-fadeInUp" style="border-radius: 14px; border: none; animation-delay: {{ 0.1 + $i*0.08 }}s;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        class="category-image"
                                        style="max-height:90px; object-fit:contain;"
                                        onerror="this.style.display='none'">
                                @endif
                                <div class="card-body text-center" style="padding: 1.2rem 0.5rem;">
                                    <h5 class="card-title" style="font-size: 0.98rem; font-weight: 700; color: #1e293b;">
                                        {{ Str::limit($product->name, 18) }}
                                    </h5>
                                    <p class="card-text text-primary" style="font-size: 1rem; font-weight:600;">
                                        {{ number_format($product->price, 2) }} ريال
                                    </p>
                                    @if($product->category)
                                        <p class="card-text mb-1" style="font-size: 0.85rem;">
                                            <small class="text-info">الفئة: {{ $product->category->name }}</small>
                                        </p>
                                    @endif
                                    <span 
                                        class="btn btn-warning btn-animated"
                                        style="margin-top: 0.7rem; padding: 0.4rem 1rem; font-weight: 500; border-radius: 8px; background: linear-gradient(90deg, #facc15 0%, #eab308 100%); border: none; pointer-events: none;">
                                        عرض خاص
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script> 
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('categorySlider');
        const btnLeft = document.getElementById('categorySliderLeft');
        const btnRight = document.getElementById('categorySliderRight');
        if(slider && btnLeft && btnRight) {
            btnLeft.addEventListener('click', function() {
                slider.scrollBy({ left: -220, behavior: 'smooth' });
            });
            btnRight.addEventListener('click', function() {
                slider.scrollBy({ left: 220, behavior: 'smooth' });
            });
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('offersSlider');
        const btnLeft = document.getElementById('offersSliderLeft');
        const btnRight = document.getElementById('offersSliderRight');
        if(slider && btnLeft && btnRight) {
            btnLeft.addEventListener('click', function() {
                slider.scrollBy({ left: -220, behavior: 'smooth' });
            });
            btnRight.addEventListener('click', function() {
                slider.scrollBy({ left: 220, behavior: 'smooth' });
            });
        }
    });
    // Enable mouse drag to scroll for the category row
    (function() {
        const scrollContainer = document.getElementById('categoryScroll');
        let isDown = false;
        let startX;
        let scrollLeft;
        if(scrollContainer) {
            scrollContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                scrollContainer.classList.add('active');
                startX = e.pageX - scrollContainer.offsetLeft;
                scrollLeft = scrollContainer.scrollLeft;
                e.preventDefault();
            });
            scrollContainer.addEventListener('mouseleave', () => {
                isDown = false;
                scrollContainer.classList.remove('active');
            });
            scrollContainer.addEventListener('mouseup', () => {
                isDown = false;
                scrollContainer.classList.remove('active');
            });
            scrollContainer.addEventListener('mousemove', (e) => {
                if(!isDown) return;
                e.preventDefault();
                const x = e.pageX - scrollContainer.offsetLeft;
                const walk = (x - startX) * 1.2;
                scrollContainer.scrollLeft = scrollLeft - walk;
            });
        }
    })();
</script>
@endsection