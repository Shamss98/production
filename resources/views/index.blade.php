@extends('layoutes.main')

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate3d(0, 40px, 0); }
        to { opacity: 1; transform: none; }
    }
    @keyframes fadeIn { 
        from { opacity: 0; } 
        to { opacity: 1; } 
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translate3d(-50px, 0, 0); }
        to { opacity: 1; transform: none; }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translate3d(50px, 0, 0); }
        to { opacity: 1; transform: none; }
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .animated-fadeInUp { animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) both; }
    .animated-fadeIn { animation: fadeIn 1.2s ease both; }
    .animated-slideInLeft { animation: slideInLeft 0.8s ease both; }
    .animated-slideInRight { animation: slideInRight 0.8s ease both; }
    .animated-pulse { animation: pulse 2s infinite; }
    
    .hero-section {
        background: linear-gradient(135deg, #2246e4 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 3rem 2rem;
        margin: 2rem 0;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
        background-size: cover;
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .hero-subtitle {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    .hero-btn {
        background: rgba(255,255,255,0.2);
        border: 2px solid white;
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    .hero-btn:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .category-card, .product-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        background: white;
    }
    .category-card:hover, .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(37,99,235,0.15);
    }
    .category-image, .product-image {
        width: 100%;
        height: 200px;
        object-fit: contain;
        transition: transform 0.5s ease;
        background: #f8fafc;
        padding: 1rem;
    }
    .category-card:hover .category-image, .product-card:hover .product-image {
        transform: scale(1.1);
    }
    .category-content, .product-content {
        padding: 1.5rem 1rem;
        text-align: center;
        position: relative;
    }
    .category-title, .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .category-description, .product-category {
        font-size: 0.9rem;
        color: #64748b;
        margin-bottom: 1rem;
        min-height: 2.5em;
    }
    .category-btn, .product-btn {
        display: inline-block;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
    }
    .category-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }
    .product-btn {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    .category-btn:hover, .product-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .price-section {
        margin: 1rem 0;
    }
    .current-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ef4444;
    }
    .original-price {
        font-size: 1rem;
        color: #94a3b8;
        text-decoration: line-through;
        margin-right: 0.5rem;
    }
    .regular-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #3b82f6;
    }
    
    .ads-section {
        margin: 2rem 0;
    }
    .ad-card {
        /* border-radius: 12px; */
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        height: 100%;
        background: white;
    }
    .ad-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }
    .ad-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .ad-card:hover .ad-image {
        transform: scale(1.05);
    }
    .ad-title {
        padding: 10px;
        font-weight: 800;
        color: #211e3b;
        text-align: center;
        font-size: 1.2rem;
        font-family: 'Cairo', sans-serif;
    }
    
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        text-align: center;
        margin: 3rem 0 2rem;
        position: relative;
        color: #1e293b;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        border-radius: 2px;
    }
    .categories-title {
        color: #1e293b;
    }
    .offers-title {
        color: #f59e0b;
    }
    
    .slider-container {
        position: relative;
        margin: 2rem 0;
    }
    .slider-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        scrollbar-width: thin;
        scrollbar-color: #3b82f6 #f1f5f9;
        border-radius: 16px;
        padding: 10px 0;
    }
    .slider-wrapper::-webkit-scrollbar {
        height: 8px;
    }
    .slider-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .slider-wrapper::-webkit-scrollbar-thumb {
        background: #3b82f6;
        border-radius: 10px;
    }
    .slider {
        display: flex;
        gap: 1.5rem;
        padding: 0 10px;
        width: max-content;
    }
    .slider-item {
        flex: 0 0 auto;
        width: 280px;
    }
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: white;
        border: 2px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
        color: #3b82f6;
        font-size: 1.2rem;
        cursor: pointer;
    }
    .slider-btn:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        transform: translateY(-50%) scale(1.1);
    }
    .slider-btn-prev {
        left: -20px;
    }
    .slider-btn-next {
        right: -20px;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background: #f8fafc;
        border-radius: 16px;
        margin: 2rem 0;
    }
    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }
    .empty-text {
        font-size: 1.2rem;
        color: #64748b;
        margin-bottom: 1.5rem;
    }
    
    .divider {
        height: 3px;
        background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        margin: 3rem 0;
        border: none;
    }
    
    @media (max-width: 1200px) {
        .slider-item { width: 250px; }
    }
    @media (max-width: 992px) {
        .slider-item { width: 220px; }
        .hero-title { font-size: 2rem; }
        .category-image, .product-image { height: 160px; }
        .slider-btn {
            width: 40px;
            height: 40px;
        }
        .slider-btn-prev { left: -15px; }
        .slider-btn-next { right: -15px; }
    }
    @media (max-width: 768px) {
        .slider-item { width: 200px; }
        .hero-section { padding: 2rem 1rem; }
        .hero-title { font-size: 1.8rem; }
        .hero-subtitle { font-size: 1rem; }
        .category-image, .product-image { height: 140px; }
        .ad-image { height: 140px; }
        .slider-btn {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
        .slider-btn-prev { left: -10px; }
        .slider-btn-next { right: -10px; }
    }
    @media (max-width: 576px) {
        .section-title { font-size: 1.6rem; }
        .slider-item { width: 180px; }
        .category-image, .product-image { height: 120px; }
        .ad-image { height: 120px; }
        .category-content, .product-content { padding: 1rem 0.5rem; }
        .category-title, .product-title { font-size: 1rem; }
        .slider-btn {
            display: none; /* إخفاء الأزرار على الشاشات الصغيرة */
        }
    }
</style>

<div class="container" style="max-width: 98%; padding: 0 15px;">
    <!-- Hero Section -->
    <div class="hero-section animated-fadeIn">
        <div class="hero-content">
            <h1 class="hero-title">مرحباً بك في متجرنا</h1>
            <p class="hero-subtitle">اكتشف أحدث المنتجات والعروض الحصرية</p>
            <a href="{{ route('products.index') }}" class="hero-btn animated-pulse">استكشف الآن</a>
        </div>
    </div>

    <!-- Ads Section -->
    @if($ads->count() > 0)
    <div class="ads-section">
        <h2 class="section-title animated-slideInLeft">إعلانات مميزة</h2>
        <div class="row g-4">
            @foreach ($ads as $ad)
                @if($ad->status)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="ad-card animated-fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" style="text-decoration: none;">
                                <img src="{{ asset('storage/' . $ad->image) }}" 
                                    alt="{{ $ad->title }}" 
                                    class="ad-image"
                                    loading="lazy">
                                <div class="ad-title">{{ $ad->title }}</div>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <hr class="divider">

    <!-- Categories Section -->
    <div id="categories">
        <h2 class="section-title categories-title animated-slideInRight">
            <i class="fa fa-th-large"></i> جميع الأقسام
        </h2>
        
        @if($categories->count() > 0)
        <div class="slider-container">
            <button class="slider-btn slider-btn-prev" id="categoriesPrev">
                <i class="fa fa-chevron-right"></i>
            </button>
            <button class="slider-btn slider-btn-next" id="categoriesNext">
                <i class="fa fa-chevron-left"></i>
            </button>
            
            <div class="slider-wrapper" id="categoriesWrapper">
                <div class="slider" id="categoriesSlider">
                    @foreach($categories as $category)
                    <div class="slider-item">
                        <a href="{{ route('products.category', $category->id) }}" class="text-decoration-none">
                            <div class="card category-card animated-fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                        alt="{{ $category->name }}" 
                                        class="category-image"
                                        onerror="this.style.display='none'">
                                @else
                                    <div class="category-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="fa fa-folder-open fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="category-content">
                                    <h5 class="category-title">{{ $category->name }}</h5>
                                    @if($category->description)
                                        <p class="category-description">{{ Str::limit($category->description, 60) }}</p>
                                    @endif
                                    <span class="category-btn">استعرض المنتجات</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="empty-state animated-fadeIn">
            <div class="empty-icon">📁</div>
            <h3 class="empty-text">لا توجد أقسام متاحة حالياً</h3>
            <a href="#" class="hero-btn" style="background: #3b82f6; border-color: #3b82f6;">العودة للرئيسية</a>
        </div>
        @endif
    </div>

    <hr class="divider">

    <!-- Featured Products Section -->
    @if($products->count() > 0)
    <div>
        <h2 class="section-title offers-title animated-slideInLeft">
            <i class="fa fa-bolt"></i> العروض المميزة
        </h2>
        
        <div class="slider-container">
            <button class="slider-btn slider-btn-prev" id="productsPrev">
                <i class="fa fa-chevron-right"></i>
            </button>
            <button class="slider-btn slider-btn-next" id="productsNext">
                <i class="fa fa-chevron-left"></i>
            </button>
            
            <div class="slider-wrapper" id="productsWrapper">
                <div class="slider" id="productsSlider">
                    @foreach($products as $product)
                    <div class="slider-item">
                        <a href="{{ route('viewproducts', $product->id) }}" class="text-decoration-none">
                            <div class="card product-card animated-fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        class="product-image"
                                        onerror="this.style.display='none'">
                                @else
                                    <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="fa fa-cube fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="product-content">
                                    <h5 class="product-title">{{ Str::limit($product->name, 25) }}</h5>
                                    
                                    <div class="price-section">
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
                                    
                                    @if($product->category)
                                        <p class="product-category">القسم: {{ $product->category->name }}</p>
                                    @endif
                                    
                                    <span class="product-btn">عرض التفاصيل</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Categories Slider
        const categoriesWrapper = document.getElementById('categoriesWrapper');
        const categoriesSlider = document.getElementById('categoriesSlider');
        const categoriesPrev = document.getElementById('categoriesPrev');
        const categoriesNext = document.getElementById('categoriesNext');
        
        if(categoriesSlider && categoriesPrev && categoriesNext) {
            const scrollAmount = 300; // كمية التمرير
            
            categoriesNext.addEventListener('click', function() {
                categoriesWrapper.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
            
            categoriesPrev.addEventListener('click', function() {
                categoriesWrapper.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });
            
            // إظهار/إخفاء الأزرار بناءً على موضع التمرير
            categoriesWrapper.addEventListener('scroll', function() {
                const maxScroll = categoriesSlider.scrollWidth - categoriesWrapper.clientWidth;
                
                if(categoriesWrapper.scrollLeft <= 0) {
                    categoriesPrev.style.opacity = '0.5';
                    categoriesPrev.style.pointerEvents = 'none';
                } else {
                    categoriesPrev.style.opacity = '1';
                    categoriesPrev.style.pointerEvents = 'auto';
                }
                
                if(categoriesWrapper.scrollLeft >= maxScroll - 10) {
                    categoriesNext.style.opacity = '0.5';
                    categoriesNext.style.pointerEvents = 'none';
                } else {
                    categoriesNext.style.opacity = '1';
                    categoriesNext.style.pointerEvents = 'auto';
                }
            });
            
            // التهيئة الأولية للأزرار
            categoriesWrapper.dispatchEvent(new Event('scroll'));
        }
        
        // Products Slider
        const productsWrapper = document.getElementById('productsWrapper');
        const productsSlider = document.getElementById('productsSlider');
        const productsPrev = document.getElementById('productsPrev');
        const productsNext = document.getElementById('productsNext');
        
        if(productsSlider && productsPrev && productsNext) {
            const scrollAmount = 300; // كمية التمرير
            
            productsNext.addEventListener('click', function() {
                productsWrapper.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
            
            productsPrev.addEventListener('click', function() {
                productsWrapper.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });
            
            // إظهار/إخفاء الأزرار بناءً على موضع التمرير
            productsWrapper.addEventListener('scroll', function() {
                const maxScroll = productsSlider.scrollWidth - productsWrapper.clientWidth;
                
                if(productsWrapper.scrollLeft <= 0) {
                    productsPrev.style.opacity = '0.5';
                    productsPrev.style.pointerEvents = 'none';
                } else {
                    productsPrev.style.opacity = '1';
                    productsPrev.style.pointerEvents = 'auto';
                }
                
                if(productsWrapper.scrollLeft >= maxScroll - 10) {
                    productsNext.style.opacity = '0.5';
                    productsNext.style.pointerEvents = 'none';
                } else {
                    productsNext.style.opacity = '1';
                    productsNext.style.pointerEvents = 'auto';
                }
            });
            
            // التهيئة الأولية للأزرار
            productsWrapper.dispatchEvent(new Event('scroll'));
        }
        
        // دعم السحب بالإصبع للشاشات التي تعمل باللمس
        function enableTouchScroll(element) {
            let isDown = false;
            let startX;
            let scrollLeft;
            
            element.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - element.offsetLeft;
                scrollLeft = element.scrollLeft;
            });
            
            element.addEventListener('mouseleave', () => {
                isDown = false;
            });
            
            element.addEventListener('mouseup', () => {
                isDown = false;
            });
            
            element.addEventListener('mousemove', (e) => {
                if(!isDown) return;
                e.preventDefault();
                const x = e.pageX - element.offsetLeft;
                const walk = (x - startX) * 2;
                element.scrollLeft = scrollLeft - walk;
            });
            
            // دعم اللمس
            element.addEventListener('touchstart', (e) => {
                isDown = true;
                startX = e.touches[0].pageX - element.offsetLeft;
                scrollLeft = element.scrollLeft;
            });
            
            element.addEventListener('touchend', () => {
                isDown = false;
            });
            
            element.addEventListener('touchmove', (e) => {
                if(!isDown) return;
                const x = e.touches[0].pageX - element.offsetLeft;
                const walk = (x - startX) * 2;
                element.scrollLeft = scrollLeft - walk;
            });
        }
        
        // تفعيل السحب للإصبع على جميع الشرائح
        if(categoriesWrapper) enableTouchScroll(categoriesWrapper);
        if(productsWrapper) enableTouchScroll(productsWrapper);
    });
</script>
@endsection