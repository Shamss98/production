@extends('layoutes.main')




@section('content')
<style>
    .register-container {
        max-width: 420px;
        margin: 48px auto;
        padding: 36px 28px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
        animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
    }
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .register-container h1 {
        text-align: center;
        margin-bottom: 28px;
        font-size: 2.1rem;
        color: #22223b;
        letter-spacing: 1px;
        font-weight: 700;
        animation: fadeIn 1s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .register-container label {
        display: block;
        margin-bottom: 7px;
        font-weight: 500;
        color: #4a4e69;
        letter-spacing: 0.5px;
    }
    .register-container input[type="text"],
    .register-container input[type="email"],
    .register-container input[type="password"] {
        width: 100%;
        padding: 11px 13px;
        margin-bottom: 20px;
        border: 1px solid #bfc0c0;
        border-radius: 5px;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #f8f9fa;
    }
    .register-container input:focus {
        border-color: #5f6caf;
        box-shadow: 0 0 0 2px #c9d6ff;
        outline: none;
    }
    .register-container button[type="submit"] {
        width: 100%;
        padding: 12px 0;
        background: linear-gradient(90deg, #5f6caf 0%, #48b1f3 100%);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.15rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        box-shadow: 0 2px 8px rgba(72,177,243,0.08);
    }
    .register-container button[type="submit"]:hover {
        background: linear-gradient(90deg, #48b1f3 0%, #5f6caf 100%);
        transform: translateY(-2px) scale(1.02);
    }
    .register-container .login-link {
        display: block;
        text-align: center;
        margin-top: 18px;
        color: #5f6caf;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.2s;
    }
    .register-container .login-link:hover {
        color: #22223b;
        text-decoration: underline;
    }
    .register-container .error-list {
        background: #ffe5e5;
        color: #b00020;
        border: 1px solid #ffb3b3;
        border-radius: 5px;
        padding: 10px 15px;
        margin-bottom: 18px;
        font-size: 0.98rem;
        animation: fadeIn 0.7s;
    }
</style>
<div class="register-container">
    <h1>انشاء حساب</h1>
    @if ($errors->any())
        <div class="error-list">
            <ul style="margin:0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('store') }}">
        @csrf
        <div>
            <label for="name">الاسم</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div>
            <label for="email">الايميل</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required minlength="8">
        </div>
        <div>
            <label for="password_confirmation">تاكيد كلمة المرور</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8">
        </div>
        <div>
            <button type="submit">انشاء حساب</button>
        </div>
    </form>
    <a class="login-link" href="{{ route('login') }}">لديك حساب بالفعل </a>
</div>
@endsection
