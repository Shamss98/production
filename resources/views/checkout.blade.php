@extends('layoutes.main')

@section('content')
<style>
    /* تنسيقات خاصة بهذه الصفحة */
    .checkout-container {
        max-width: 600px; /* تحديد عرض أقصى للحاوية */
        margin: 50px auto; /* توسيط الحاوية في الصفحة */
        padding: 30px;
        border-radius: 15px; /* حواف مستديرة */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* ظل خفيف */
        background-color: #ffffff; /* خلفية بيضاء */
    }

    .checkout-image {
        border-radius: 10px;
        border: 2px solid #007bff; /* إطار أزرق حول صورة طرق الدفع */
        opacity: 0.9; /* شفافية خفيفة */
    }

    .btn-primary {
        padding: 12px 30px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="checkout-container text-center">
    <h2>إتمام الدفع</h2>
    <p>قم باختيار طريقة الدفع المناسبة لك.</p>

    <img class="img-fluid w-75 mb-4 checkout-image"
    src="https://dalilzag.com//uploads/2021/12/EVM4tSHxFYKuiaWwI1AP.jpg" alt="طرق الدفع">

    @auth
        <form action="{{ route('checkout.cart') }}" method="POST">
            @method('get')
            @csrf
            <button type="submit" class="btn btn-primary">
                💳 ادفع الآن
            </button>
        </form>
    @else
        <p class="mt-4 alert alert-warning">يرجى تسجيل الدخول لإتمام عملية الدفع.</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">تسجيل الدخول</a>
    @endauth
</div>
@endsection