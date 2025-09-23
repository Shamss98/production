@extends('layoutes.main')

@section('content')
<!-- Animations CSS -->
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 40px, 0);
    }
    to {
        opacity: 1;
        transform: none;
    }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
.animated-fadeInUp {
    animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) both;
}
.animated-fadeIn {
    animation: fadeIn 1.2s ease both;
}
.category-card {
    transition: transform 0.2s, box-shadow 0.2s;
    will-change: transform;
}
.category-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 32px rgba(37,99,235,0.13);
}
.btn-animated {
    transition: background 0.3s, transform 0.18s;
}
.btn-animated:hover {
    transform: scale(1.06) translateY(-2px);
    background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
}
.category-image {
    width: 100%;
    height: 200px;
    object-fit: contain;
    border-radius: 14px 14px 0 0;
}
</style>

<div class="container mt-5 animated-fadeIn" style="background: #f9fafb; border-radius: 18px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); padding: 2.5rem 2rem;">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5 animated-fadeInUp" style="font-weight: bold; color: #2563eb; letter-spacing: 1px;">
                مرحباً بكم في متجرنا
            </h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 animated-fadeInUp" style="color: #374151; font-size: 1.6rem; font-weight: 600;">
                تصفح حسب الفئة
            </h2>
        </div>
    </div>
    
    <div class="row">
        @if($categories->count() > 0)
            @foreach($categories as $i => $category)
                <div class="col-md-4 col-lg-2 mb-4">
                    <a href="{{ route('products.category', $category->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm category-card animated-fadeInUp" style="border-radius: 14px; border: none; animation-delay: {{ 0.1 + $i*0.08 }}s;">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="category-image"
                                     onerror="this.style.display='none'">
                            @endif
                            <div class="card-body text-center" style="padding: 2rem 1rem;">
                                <h5 class="card-title" style="font-size: 1.25rem; font-weight: 700; color: #1e293b;">
                                    {{ $category->name }}
                                </h5>
                                @if($category->description)
                                    <p class="card-text text-muted" style="font-size: 0.98rem; min-height: 2.2em;">
                                        {{ Str::limit($category->description, ) }}
                                    </p>
                                @endif
                                <span 
                                   class="btn btn-primary btn-animated"
                                   style="margin-top: 1rem; padding: 0.6rem 1.5rem; font-weight: 500; border-radius: 8px; background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%); border: none; pointer-events: none;">
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
    
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('products.index') }}" 
               class="btn btn-success btn-lg btn-animated animated-fadeInUp"
               style="font-size: 1.2rem; font-weight: 600; padding: 0.8rem 2.5rem; border-radius: 10px; background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%); border: none; animation-delay: 0.3s;">
                عرض جميع المنتجات
            </a>
        </div>
    </div>
</div>
<!-- Animations JS for staggered effect (optional, for more advanced stagger) -->
<script>
    // Optionally, you can add JS for more advanced staggered animation if needed
    // But the above uses CSS animation-delay inline for each card
</script>
@endsection