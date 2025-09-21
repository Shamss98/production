@extends('layoutes.main')

@section('content')
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
    button, .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.3s ease;
    }
    button[type="submit"] {
        background: #28a745;
        color: #fff;
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
    .btn-success {
        background: linear-gradient(90deg, #28a745 0%, #218838 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(40,167,69,0.15);
    }
    .btn-success:hover {
        background: linear-gradient(90deg, #218838 0%, #28a745 100%);
        transform: scale(1.05) translateY(-2px);
        box-shadow: 0 4px 16px rgba(40,167,69,0.25);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
</style>

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
            </td>
            <td>
                <a href="{{ route('viewproducts', $item->product->id) }}">
                    {{ $item->product->name }}
                </a>
            </td>
            <td>
                <form action="{{ route('cart.update', $item->id) }}" method="POST">
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

<div style="text-align:center; margin-top:20px;">
    <form action="{{ route('cart.clear') }}" method="POST" style="display:inline-block;">
        @csrf
        <button type="submit">إفراغ السلة</button>
    </form>

    <a href="{{ route('checkout.cart') }}" class="btn btn-success">ادفع السلة</a>
</div>

@endsection
