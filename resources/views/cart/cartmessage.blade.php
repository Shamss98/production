@extends('layoutes.main')

@section('content')
    @guest
        <style>
            .cart-alert {
                animation: fadeInDown 1s;
                box-shadow: 0 4px 16px rgba(0,0,0,0.08);
                border-radius: 8px;
            }
            @keyframes fadeInDown {
                from { opacity: 0; transform: translateY(-30px);}
                to { opacity: 1; transform: translateY(0);}
            }
            .cart-login-btn {
                animation: bounceIn 1s 0.5s both;
                border-radius: 6px;
                font-weight: bold;
            }
            @keyframes bounceIn {
                0% { transform: scale(0.8); opacity: 0;}
                60% { transform: scale(1.05); opacity: 1;}
                100% { transform: scale(1);}
            }
        </style>
        <div class="alert alert-warning mt-4 cart-alert" role="alert">
            يجب عليك تسجيل الدخول أولاً للوصول إلى سلة المشتريات.
        </div>
        <a href="{{ route('login') }}" class="btn btn-primary mt-2 cart-login-btn">تسجيل الدخول</a>
    @endguest
@endsection