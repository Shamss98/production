@extends('layoutes.main')

@section('content')
<style>
    .login-container {
        max-width: 400px;
        margin: 40px auto;
        padding: 32px 24px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    }
    .login-container h1 {
        text-align: center;
        margin-bottom: 24px;
        font-size: 2rem;
        color: #333;
    }
    .login-container label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #444;
    }
    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }
    .login-container input[type="email"]:focus,
    .login-container input[type="password"]:focus {
        border-color: #007bff;
        outline: none;
    }
    .login-container button[type="submit"] {
        width: 100%;
        padding: 10px 0;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .login-container button[type="submit"]:hover {
        background: #0056b3;
    }
</style>
<div class="login-container" style="animation: fadeInDown 0.8s;">
    <h1 style="animation: popIn 0.7s;">تسجيل الدخول</h1>

   {{-- Error message --}}
    @if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

{{-- End Error message --}}

{{-- Login form --}}
    <form method="POST" action="{{ route('login') }}" style="animation: fadeIn 1s;">
        @csrf
        <div style="animation: slideInLeft 0.7s;">
            <label for="email">الايميل</label>
            <input id="email" type="email" name="email"  style="transition: box-shadow 0.2s;">
        </div>
        <div style="animation: slideInRight 0.7s;">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required style="transition: box-shadow 0.2s;">
        </div>
        <div style="animation: fadeInUp 0.7s;">
            <button type="submit" style="box-shadow: 0 2px 8px rgba(0,123,255,0.08); transition: transform 0.2s;">دخول</button>
        </div>
    </form>
    <a href="{{ route('register') }}" style="display:block; text-align:center; margin-top:18px; color:#007bff; text-decoration:none; font-size:1rem; transition:color 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#007bff'">ليس لديك حساب , قم بالتسجيل</a>
</div>
{{-- End Login form --}}
<style>
    
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-40px);}
    to { opacity: 1; transform: translateY(0);}
}
@keyframes fadeIn {
    from { opacity: 0;}
    to { opacity: 1;}
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-40px);}
    to { opacity: 1; transform: translateX(0);}
}
@keyframes slideInRight {
    from { opacity: 0; transform: translateX(40px);}
    to { opacity: 1; transform: translateX(0);}
}
@keyframes popIn {
    0% { transform: scale(0.7); opacity: 0;}
    80% { transform: scale(1.05);}
    100% { transform: scale(1); opacity: 1;}
}
@keyframes shake {
    0% { transform: translateX(0);}
    20% { transform: translateX(-8px);}
    40% { transform: translateX(8px);}
    60% { transform: translateX(-8px);}
    80% { transform: translateX(8px);}
    100% { transform: translateX(0);}
}
</style>
@endsection

@push('styles')
<style>
    html, body {
        height: 100%;
        min-height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    main {
        flex: 1 0 auto;
    }
    footer {
        flex-shrink: 0;
    }
</style>
@endpush