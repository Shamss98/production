@extends('layoutes.main')

@section('title', 'جميع العروض')

@section('content')
<style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f8;
    color: #333; /* Set text direction to right-to-left for Arabic */
}
h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}

.btn {
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #3498db;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.btn-warning {
    background-color: #f39c12;
}

.btn-warning:hover {
    background-color: #e67e22;
}

.btn-danger {
    background-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-sm {
    padding: 5px 10px;
    font-size: 14px;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px 15px;
    text-align: right; /* Align text to the right for Arabic */
    border-bottom: 1px solid #ddd;
}

.table thead th {
    background-color: #34495e;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
    transform: scale(1.01);
    transition: transform 0.2s ease-in-out;
}
.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: right;
    direction: rtl; /* Set direction to right-to-left for Arabic text */
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
}

.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    direction: ltr; /* Reset direction for pagination links */
}

.pagination a, .pagination span {
    padding: 8px 16px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #3498db;
    margin: 0 4px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: #f1f1f1;
}

.pagination .active span {
    background-color: #3498db;
    color: white;
    border-color: #3498db;
}
    </style>
    <h2>إدارة العروض</h2>

    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary mb-3">إضافة عرض جديد</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المنتج</th>
                <th>السعر القديم</th>
                <th>السعر الجديد</th>
                <th>الفترة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td>{{ $offer->product->name }}</td>
                    <td>${{ $offer->old_price }}</td>
                    <td>${{ $offer->new_price }}</td>
                    <td>
                        {{ $offer->start_date ?? '---' }} - 
                        {{ $offer->end_date ?? '---' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $offers->links() }}
@endsection