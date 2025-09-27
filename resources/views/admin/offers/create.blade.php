@extends('layoutes.main')

@section('content')
    <style>
        .offer-form-container {
            max-width: 1500px;
            margin: 40px auto;
            background: linear-gradient(135deg, #f8fafc 0%, #e3f0ff 100%);
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(44, 62, 80, 0.13), 0 1.5px 6px rgba(44, 62, 80, 0.07);
            padding: 38px 32px 28px 32px;
            direction: rtl;
            animation: fadeInDown 0.8s cubic-bezier(.68,-0.55,.27,1.55);
        }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-40px) scale(0.97);}
            100% { opacity: 1; transform: translateY(0) scale(1);}
        }
        .offer-form-container h2 {
            text-align: center;
            margin-bottom: 28px;
            font-weight: bold;
            color: #1a365d;
            letter-spacing: 1px;
            animation: popIn 0.7s;
        }
        @keyframes popIn {
            0% { opacity: 0; transform: scale(0.8);}
            80% { opacity: 1; transform: scale(1.05);}
            100% { opacity: 1; transform: scale(1);}
        }
        .offer-form-container .form-group {
            margin-bottom: 22px;
            position: relative;
            animation: slideIn 0.7s;
        }
        @keyframes slideIn {
            0% { opacity: 0; transform: translateX(40px);}
            100% { opacity: 1; transform: translateX(0);}
        }
        .offer-form-container label {
            font-weight: 600;
            margin-bottom: 7px;
            color: #2d3a4b;
            display: block;
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }
        .offer-form-container input,
        .offer-form-container select {
            border-radius: 8px;
            border: 1.5px solid #b6c6e3;
            padding: 10px 14px;
            font-size: 1.07rem;
            background: #fafdff;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 2px rgba(44,62,80,0.03);
        }
        .offer-form-container input:focus,
        .offer-form-container select:focus {
            border-color: #4f8cff;
            outline: none;
            box-shadow: 0 0 0 2px #cce3ff;
        }
        .offer-form-container .btn-success {
            width: 100%;
            font-size: 1.15rem;
            padding: 12px 0;
            border-radius: 8px;
            background: linear-gradient(90deg, #28a745 60%, #43e97b 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px rgba(40,167,69,0.10);
            transition: background 0.25s, transform 0.15s;
            position: relative;
            overflow: hidden;
        }
        .offer-form-container .btn-success:hover {
            background: linear-gradient(90deg, #218838 60%, #38d39f 100%);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 18px rgba(40,167,69,0.13);
        }
        .offer-form-container .btn-success:active {
            transform: scale(0.98);
        }
        /* Animated underline for inputs on focus */
        .offer-form-container input:focus, 
        .offer-form-container select:focus {
            box-shadow: 0 2px 0 0 #4f8cff;
        }
    </style>
    <div class="offer-form-container">
        <h2>إضافة عرض جديد</h2>
        <form action="{{ route('admin.offers.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group" style="animation-delay:0.05s;">
                <label>المنتج</label>
                <select name="product_id" class="form-control" required>
                    <option value="" disabled selected>اختر المنتج</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="animation-delay:0.10s;">
                <label>السعر القديم</label>
                <input type="number" step="0.01" name="old_price" class="form-control" required placeholder="أدخل السعر القديم">
            </div>

            <div class="form-group" style="animation-delay:0.15s;">
                <label>السعر الجديد</label>
                <input type="number" step="0.01" name="new_price" class="form-control" required placeholder="أدخل السعر الجديد">
            </div>

            <div class="form-group" style="animation-delay:0.20s;">
                <label>تاريخ البداية</label>
                <input type="date" name="start_date" class="form-control" placeholder="اختر تاريخ البداية">
            </div>

            <div class="form-group" style="animation-delay:0.25s;">
                <label>تاريخ النهاية</label>
                <input type="date" name="end_date" class="form-control" placeholder="اختر تاريخ النهاية">
            </div>

            <button type="submit" class="btn btn-success">
                <span style="display:inline-block; animation: pulseBtn 1.2s infinite alternate;">حفظ</span>
            </button>
        </form>
    </div>
    <style>
        @keyframes pulseBtn {
            0% { filter: brightness(1);}
            100% { filter: brightness(1.15);}
        }
    </style>
@endsection
