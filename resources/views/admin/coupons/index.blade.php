@extends('layoutes.main')

@section('content')
<div class="container">
    <style>

h1 {
    text-align: center;
    color: #0208c5;
    margin-top: 20px;
    margin-bottom: 10px;
    padding-bottom: 10px;
}
        /* General Container and RTL Setup */
.list-container {
    padding: 30px;
    margin: 0 auto;
    max-width: 1200px; /* Provides good width for the table */
    font-family: Arial, sans-serif;
    direction: rtl; /* Sets text direction for Arabic */
    text-align: right;
}

.list-title {
    text-align: right;
    color: #2c3e50;
    margin-bottom: 25px;
}

/* Header and Button */
.header-actions {
    margin-bottom: 20px;
    text-align: right; /* Aligns the button to the right */
}

/* Base Button Style */
.btn {
    padding: 10px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none; /* For the <a> tag buttons */
    display: inline-block;
    transition: background-color 0.3s, transform 0.1s;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Primary Button (Add New) */
.btn-primary {
    background-color: #2ecc71; /* Green Success */
    color: white;
}

.btn-primary:hover {
    background-color: #27ae60;
}

/* Alert Message */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cd;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-weight: bold;
}

/* Table Styling */
.table-responsive {
    overflow-x: auto; /* Ensures table is scrollable on small screens */
    margin-top: 20px;
}

.data-table {
    width: 100%;
    border-collapse: collapse; /* Removes double borders */
    background-color: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.data-table th, .data-table td {
    padding: 12px 15px;
    text-align: right;
    border: 1px solid #ecf0f1; /* Light border color */
}

.data-table thead th {
    background-color: #34495e; /* Dark header background */
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
}

.data-table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Zebra striping for readability */
}

.data-table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Specific Cell Styles */
.code-cell {
    font-weight: bold;
    color: #e74c3c; /* Highlight the code */
}

/* Action Buttons within Table */
.actions-column {
    white-space: nowrap; /* Prevents buttons from wrapping */
    width: 1%;
}

.delete-form {
    display: inline-block;
    margin-right: 5px; /* Add slight space between buttons */
}

.btn-edit {
    background-color: #3498db; /* Blue for Edit */
    color: white;
    margin-left: 5px;
}

.btn-edit:hover {
    background-color: #2980b9;
}

.btn-delete {
    background-color: #e74c3c; /* Red for Delete */
    color: white;
}

.btn-delete:hover {
    background-color: #c0392b;
}

/* Pagination Styling (To override default Laravel links) */
.pagination-links nav {
    text-align: center;
    margin-top: 30px;
}

/* You will need to inspect Laravel's generated pagination HTML and style its classes accordingly. */
/* Example styling for default pagination: */
.pagination-links .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.pagination-links .page-item {
    margin: 0 4px;
}

.pagination-links .page-link {
    display: block;
    padding: 8px 12px;
    border: 1px solid #ccc;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
}

.pagination-links .page-item.active .page-link {
    background-color: #3498db;
    color: white;
    border-color: #3498db;
}

.pagination-links .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}
    </style>
    <h1>الكوبونات</h1>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success mb-3"> اضافة كوبون جديد</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>الكود</th>
                <th>النوع</th>
                <th>القيمة</th>
                <th>الحد الأدنى للطلب</th>
                <th>الحد الأقصى للاستخدام</th>
                <th>تم استخدامه</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->type }}</td>
                    <td>{{ $coupon->value }}</td>
                    <td>{{ $coupon->min_order_value }}</td>
                    <td>{{ $coupon->max_uses }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $coupons->links() }}
</div>
@endsection
