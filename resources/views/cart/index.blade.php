
<style>
    body {
        font-family: 'Cairo', Arial, sans-serif;
        background: #f8f9fa;
        margin: 0;
        padding: 0;
    }
    h2, h3 {
        text-align: center;
        color: #333;
        margin-top: 30px;
        font-weight: bold;
    }
    table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-radius: 8px;
        overflow: hidden;
        animation: fadeIn 1s;
    }
    th, td {
        padding: 16px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    th {
        background: #007bff;
        color: #fff;
        font-size: 18px;
    }
    tr:last-child td {
        border-bottom: none;
    }
    input[type="number"] {
        width: 60px;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }
    input[type="number"]:focus {
        border-color: #007bff;
    }
    button {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s, transform 0.2s;
    }
    button[type="submit"]:hover {
        background: #218838;
        transform: scale(1.05);
    }
    form[action*="remove"] button {
        background: #dc3545;
    }
    form[action*="remove"] button:hover {
        background: #c82333;
    }
    form[action*="clear"] button {
        background: #ffc107;
        color: #333;
    }
    form[action*="clear"] button:hover {
        background: #e0a800;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
</style>

@extends('layoutes.main')

@section('content')
<h2>سلة التسوق</h2>
<table>
    <tr>
        <th>الصورة</th>
        <th>المنتج</th>
        <th>الكمية</th>
        <th>السعر</th>
        <th>الإجمالى</th>
        <th>إجراء</th>
    </tr>
    @php $total = 0; @endphp
    @foreach($items as $item)
        @php $total += $item->price * $item->quantity; @endphp
        <tr>
            <td>
                <a href="{{ route('viewproducts', $item->product->id) }}">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                </a>
            <td>
                <a href="{{ route('viewproducts', $item->product->id) }}">
                    {{ $item->product->name }}
                </a>
            </td>
            <td>  <form action="{{ route('cart.update', $item->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item->quantity }}">
                    <button type="submit">تحديث</button>
                </form>
            </td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->price * $item->quantity }}</td>
            <td>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit">حذف</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<h3>الإجمالى: {{ $total }}</h3>
<form action="{{ route('cart.clear') }}" method="POST" style="text-align:center;">
    @csrf
    <button type="submit" class="action-btn">إفراغ السلة</button>

<a href="{{ route('checkout.cart') }}" class="btn btn-success">
    ادفع السلة
</a>


    <style>
        .action-btn {
            display: inline-block;
            min-width: 220px;
            padding: 12px 32px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            box-sizing: border-box;
            margin: 10px 5px 0 5px;
        }
        .checkout-btn {
            background: linear-gradient(90deg, #28a745 0%, #218838 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(40,167,69,0.15);
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            animation: bounceIn 0.8s;
            border: none;
        }
        .checkout-btn:hover {
            background: linear-gradient(90deg, #218838 0%, #28a745 100%);
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 4px 16px rgba(40,167,69,0.25);
            color: #fff;
        }
        .action-btn[type="submit"], .action-btn:not(a) {
            background: #ffc107;
            color: #333;
            border: none;
            box-shadow: 0 2px 8px rgba(255,193,7,0.10);
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
        }
        .action-btn[type="submit"]:hover, .action-btn:not(a):hover {
            background: #e0a800;
            color: #333;
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 4px 16px rgba(255,193,7,0.18);
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.7) translateY(40px);
            }
            60% {
                opacity: 1;
                transform: scale(1.05) translateY(-10px);
            }
            80% {
                transform: scale(0.98) translateY(2px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
</form>

@endsection
