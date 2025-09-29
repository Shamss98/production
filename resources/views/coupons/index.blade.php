@extends('layoutes.main')

@section('content')
<style>
    .coupon-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .coupon-item {
        padding: 12px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.3s;
    }
    .coupon-item:hover {
        background: #f1f1f1;
    }
    .ads-section {
        margin: 30px auto;
        text-align: center;
    }
    .ads-section img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
</style>

<div class="coupon-container">
    <h1 style="text-align: center; color: #0208c5; margin-top: 20px; margin-bottom: 10px; padding-bottom: 10px; font-size: 30px;" class="mb-4">الكوبونات</h1>
    <h5 style="text-align: center; color: #9091a8; margin-top: 20px; margin-bottom: 10px; padding-bottom: 10px; font-size: 20px;" >خصم 30% على كل الطلبات </h5>
    <p style="text-align: center; color: #9091a8; margin-top: 20px; margin-bottom: 10px; padding-bottom: 10px; font-size: 15px;">ضيف هذا الكوبون فى الخانة المسموح بها فى السله لتحصل على الخصم</p>

    @forelse($coupons as $coupon)
        <div class="coupon-item">
            <strong>{{ $coupon->code }}</strong>
            <span>{{ $coupon->value }} @if($coupon->type === 'percent') % @else جنيه @endif</span>
        </div>
    @empty
        <p class="alert alert-warning">لا يوجد كوبونات متاحة.</p>
    @endforelse
</div>

{{-- ✅ قسم الإعلانات --}}
<div class="ads-section">
    <a href="#">
        <img src="https://mobile-cuisine.com/wp-content/uploads/2012/12/Discount-Coupons.jpg" alt="إعلان">
    </a>
</div>
@endsection
