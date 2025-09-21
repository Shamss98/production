@extends('layoutes.main')

@section('content')
<style>
    .profile-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 32px 28px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 32px rgba(0,0,0,0.10);
        animation: fadeInDownProfile 0.8s;
        position: relative;
        overflow: hidden;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 22px;
        animation: slideInLeftProfile 0.7s;
    }
    .avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #2563eb;
        font-size: 2.1rem;
        box-shadow: 0 2px 8px rgba(37,99,235,0.08);
        animation: popInProfile 0.7s;
        transition: box-shadow 0.2s;
    }
    .avatar:hover {
        box-shadow: 0 4px 16px rgba(37,99,235,0.18);
        background: linear-gradient(135deg, #c7d2fe 0%, #e0e7ef 100%);
        cursor: pointer;
        transform: scale(1.05);
    }
    .profile-header h1 {
        margin: 0;
        font-size: 2rem;
        color: #1e293b;
        font-weight: 700;
        letter-spacing: 0.01em;
        animation: fadeInProfile 1s;
    }
    .profile-header p {
        margin: 6px 0 0 0;
        color: #6b7280;
        font-size: 1.05rem;
        animation: fadeInProfile 1.2s;
    }
    .profile-row {
        margin: 18px 0;
        padding: 16px 0 0 0;
        border-top: 1px solid #f1f5f9;
        animation: fadeInUpProfile 0.8s;
    }
    .label {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 2px;
        letter-spacing: 0.01em;
        transition: color 0.2s;
    }
    .value {
        color: #111827;
        font-weight: 600;
        font-size: 1.13rem;
        letter-spacing: 0.01em;
        transition: color 0.2s;
    }
    .actions {
        margin-top: 32px;
        display: flex;
        gap: 18px;
        animation: fadeInUpProfile 1s;
    }
    .btn {
        display: inline-block;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        border: 1.5px solid #d1d5db;
        color: #374151;
        background: #f9fafb;
        font-size: 1.08rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.15s;
        cursor: pointer;
        outline: none;
    }
    .btn-primary {
        background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
        border-color: #2563eb;
        color: #fff;
        box-shadow: 0 2px 12px rgba(37,99,235,0.10);
    }
    .btn-primary:hover, .btn-primary:focus {
        background: linear-gradient(90deg, #1d4ed8 60%, #3b82f6 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 4px 16px rgba(37,99,235,0.18);
    }
    .btn-danger {
        background: linear-gradient(90deg, #dc2626 60%, #f87171 100%);
        border-color: #dc2626;
        color: #fff;
        box-shadow: 0 2px 12px rgba(220,38,38,0.10);
    }
    .btn-danger:hover, .btn-danger:focus {
        background: linear-gradient(90deg, #b91c1c 60%, #ef4444 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 4px 16px rgba(220,38,38,0.18);
    }
    .btn:hover, .btn:focus {
        opacity: 0.97;
    }
    .logout-form { display: inline; }
    /* Animations */
    @keyframes fadeInDownProfile {
        from { opacity: 0; transform: translateY(-40px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeInProfile {
        from { opacity: 0;}
        to { opacity: 1;}
    }
    @keyframes fadeInUpProfile {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes slideInLeftProfile {
        from { opacity: 0; transform: translateX(-40px);}
        to { opacity: 1; transform: translateX(0);}
    }
    @keyframes popInProfile {
        0% { transform: scale(0.7); opacity: 0;}
        80% { transform: scale(1.08);}
        100% { transform: scale(1); opacity: 1;}
    }
</style>
<div class="profile-container">
    <div class="profile-header">
        @php($profile = auth()->user()->profile)
        @if(!empty($profile?->image))
            <img class="avatar" src="{{ asset('storage/' . $profile->image) }}" alt="Avatar" style="object-fit:cover;" />
        @else
            <div class="avatar" title="{{ auth()->user()->name }}">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endif
        <div>
            <h1>مرحبا, {{ auth()->user()->name }}</h1>
            <p>مرحبا بك في متجرنا</p>
        </div>
    </div>
    <div class="profile-row" style="animation-delay:0.1s;">
        <div class="label">الاسم</div>
        <div class="value">{{ auth()->user()->name }}</div>
    </div>
    <div class="profile-row" style="animation-delay:0.2s;">
        <div class="label">البريد الالكتروني</div>
        <div class="value">{{ auth()->user()->email }}</div>
    </div>
    <div class="profile-row" style="animation-delay:0.3s;">
        <div class="label">رقم الجوال</div>
        <div class="value">{{ $profile?->phone }}</div>
    </div>
    <div class="profile-row" style="animation-delay:0.4s;">
        <div class="label">العنوان</div>
        <div class="value">{{ $profile?->address }}</div>   
    </div>
    <div class="actions" style="animation-delay:0.5s;">
        <a class="btn btn-primary" href="{{ route('profile.edit') }}">تعديل الملف الشخصي</a>
        <a class="btn" href="{{ url('/') }}">العودة للصفحة الرئيسية</a>
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger" type="submit">تسجيل الخروج</button>
        </form>
    </div>
</div>
@endsection
