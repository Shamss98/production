@extends('layoutes.main')

@section('content')
<div class="container text-center" style="margin-top: 50px;">
    <h2>إتمام الدفع</h2>
    <p>إجمالي الفاتورة: <strong>200 ج.م</strong></p>

    @auth
        
    
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">
            💳 ادفع الآن
        </button>
    </form>
    @else
        <p>يرجى تسجيل الدخول لإتمام عملية الدفع.</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">تسجيل الدخول</a>
    @endauth
</div>
@endsection
