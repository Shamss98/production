@extends('layoutes.main')

@section('content')
<style>
    body {
        font-family: 'Cairo', Arial, sans-serif;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        color: #333;
    }
    
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    h2 {
        text-align: center;
        color: #2c3e50;
        margin: 30px 0;
        font-weight: 700;
        font-size: 32px;
        position: relative;
        padding-bottom: 15px;
    }
    
    h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #007bff 0%, #28a745 100%);
        border-radius: 2px;
    }
    
    h3 {
        text-align: center;
        color: #2c3e50;
        margin: 20px 0;
        font-weight: 600;
    }
    
    .cart-table {
        width: 100%;
        margin: 30px auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
        animation: fadeIn 0.8s ease;
    }
    
    .cart-table th {
        background: #007bff;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-weight: 600;
        font-size: 16px;
    }
    
    .cart-table td {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }
    
    .cart-table tr:last-child td {
        border-bottom: none;
    }
    
    .cart-table tr:hover {
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }
    
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 8px;
        border: 1px solid #eee;
        padding: 5px;
        transition: transform 0.3s ease;
    }
    
    .product-image:hover {
        transform: scale(1.05);
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .product-name:hover {
        color: #007bff;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .quantity-input {
        width: 70px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-align: center;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .quantity-input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }
    
    .update-btn {
        background: #17a2b8;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .update-btn:hover {
        background: #138496;
        transform: translateY(-2px);
    }
    
    .price {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 14px;
        margin-left: 5px;
    }
    
    .discount-price {
        color: #28a745;
        font-weight: bold;
        font-size: 16px;
    }
    
    .remove-btn {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .remove-btn:hover {
        background: #c82333;
        transform: translateY(-2px);
    }
    
    .cart-summary {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 25px;
        margin: 30px auto;
        max-width: 800px;
    }
    
    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px dashed #ddd;
    }
    
    .total-label {
        font-weight: 600;
        color: #495057;
        font-size: 18px;
    }
    
    .total-value {
        font-weight: 700;
        color: #2c3e50;
        font-size: 20px;
    }
    
    .discounted-total {
        color: #28a745;
        font-size: 24px;
    }
    
    .coupon-section {
        display: flex;
        gap: 10px;
        margin: 25px 0;
        justify-content: center;
        align-items: center;
    }
    
    .coupon-input {
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        width: 250px;
        transition: all 0.3s ease;
    }
    
    .coupon-input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }
    
    .apply-coupon-btn {
        background: #ffc107;
        color: #212529;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .apply-coupon-btn:hover {
        background: #e0a800;
        transform: translateY(-2px);
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .clear-cart-btn {
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .clear-cart-btn:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    
    .checkout-btn {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(40,167,69,0.2);
    }
    
    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40,167,69,0.3);
        color: white;
        text-decoration: none;
    }
    
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin: 30px auto;
        max-width: 800px;
    }
    
    .empty-cart-icon {
        font-size: 64px;
        margin-bottom: 20px;
        color: #dee2e6;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @media (max-width: 768px) {
        .cart-container {
            padding: 10px;
        }
        
        h2 {
            font-size: 24px;
            margin: 20px 0;
        }
        
        .cart-table {
            display: block;
            overflow-x: auto;
        }
        
        .cart-table th,
        .cart-table td {
            padding: 12px;
        }
        
        .quantity-control {
            flex-direction: column;
            gap: 5px;
        }
        
        .coupon-section {
            flex-direction: column;
        }
        
        .coupon-input {
            width: 100%;
            max-width: 300px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .clear-cart-btn,
        .checkout-btn {
            width: 100%;
            max-width: 300px;
        }
    }
    
    @media (max-width: 480px) {
        .cart-table th,
        .cart-table td {
            padding: 8px;
            font-size: 14px;
        }
        
        .quantity-input {
            width: 60px;
            padding: 8px;
        }
        
        .update-btn,
        .remove-btn {
            padding: 8px 12px;
            font-size: 12px;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
        }
    }
</style>

<div class="cart-container">
    <h2>سلة التسوق</h2>

    @if(count($items) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>الصورة</th>
                    <th>المنتج</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الإجمالي</th>
                    <th>إجراء</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($items as $item)
                    @php 
                        $itemTotal = $item->price * $item->quantity;
                        $total += $itemTotal;
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('viewproducts', $item->product->id) }}">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="product-image">
                            </a>
                        </td>
                        <td>
                            <a class="product-name" href="{{ route('viewproducts', $item->product->id) }}">
                                {{ Str::limit(  $item->product->name , 10) }}
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-control">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="quantity-input form-control">
                                <button type="submit" class="update-btn btn btn-sm btn-outline-primary">تحديث</button>
                            </form>
                        </td>
                        <td class="price">
                            @if($item->product->activeOffer)
                                <span class="old-price">{{ $item->product->activeOffer->old_price }}</span>
                                <span class="discount-price">{{ $item->product->final_price }}</span>
                            @else
                                {{ $item->product->price }}
                            @endif
                        </td>
                        <td class="price">{{ $itemTotal }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="remove-btn">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- رسائل نجاح أو خطأ --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @php
            // خصم الكوبون
            $discount = 0;
            if(session()->has('coupon')) {
                $coupon = session('coupon');
                if($coupon['type'] == 'fixed') {
                    $discount = $coupon['value'];
                } elseif($coupon['type'] == 'percent') {
                    $discount = ($total * $coupon['value']) / 100;
                }
            }

            $finalTotal = $total - $discount;
            if($finalTotal < 0) $finalTotal = 0;
        @endphp

        <div class="cart-summary">
            <div class="total-section">
                <span class="total-label">الإجمالي:</span>
                <span class="total-value">{{round($total)}}</span>
            </div>

            @if(session()->has('coupon'))
                <div class="total-section">
                    <span class="total-label">خصم ({{ session('coupon.code') }}):</span>
                    <span class="total-value discounted-total">- {{ $discount }}</span>
                </div>
            @endif
            @if (session()->has('coupon'))
                
          
            <div class="total-section">
                <span class="total-label">السعر بعد الخصم:</span>
                <span class="total-value">{{ $finalTotal }}</span>
            </div>
            @endif
            <form action="{{ route('coupon.apply') }}" method="POST" class="coupon-section">
                @csrf
                <input type="text" name="code" placeholder="أدخل كود الخصم" class="coupon-input">
                <input type="hidden" name="cart_total" value="{{ $total }}">
                <button type="submit" class="apply-coupon-btn">تطبيق الخصم</button>
            </form>

            <div class="action-buttons">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="clear-cart-btn">إفراغ السلة</button>
                </form>

                <a href="{{ route('checkout') }}" class="checkout-btn">ادفع السلة</a>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h3>سلة التسوق فارغة</h3>
            <p>لم تقم بإضافة أي منتجات إلى سلة التسوق بعد</p>
            <a href="{{ url('/products') }}" class="checkout-btn" style="margin-top: 20px; display: inline-block;">تسوق الآن</a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value < 1) {
                    this.value = 1;
                }
            });
        });
        
        const clearCartBtn = document.querySelector('.clear-cart-btn');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', function(e) {
                if (!confirm('هل أنت متأكد من أنك تريد إفراغ سلة التسوق؟')) {
                    e.preventDefault();
                }
            });
        }
        
        const removeBtns = document.querySelectorAll('.remove-btn');
        removeBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('هل أنت متأكد من أنك تريد حذف هذا المنتج من السلة؟')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection