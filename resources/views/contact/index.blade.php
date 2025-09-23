@extends('layoutes.main')

@section('content')
<div style="max-width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

    <h2 style="text-align: center; margin-bottom: 20px;">تواصل معنا</h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf
        <input type="text" name="name" placeholder="الاسم" value="{{ old('name') }}"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

        <input type="email" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

        <textarea name="message" placeholder="اكتب رسالتك..." rows="5"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>{{ old('message') }}</textarea>

        <button type="submit" 
            style="background: #007bff; color: white; padding: 10px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px;">
            إرسال
        </button>
    </form>
</div>
@endsection
