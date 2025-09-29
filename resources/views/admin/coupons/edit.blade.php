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
        /* Style for the main container */
.coupon-container {
    padding: 20px;
    max-width: 600px; /* Limits the width of the form */
    margin: 40px auto; /* Centers the container */
    font-family: Arial, sans-serif;
    direction: rtl; /* Ensure RTL alignment for Arabic text */
    text-align: right;
}

/* Style for the card wrapper */
.coupon-card {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card-title {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}

/* Form Group Layout */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

/* Input/Select Fields */
.form-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; 
    transition: border-color 0.3s;
}

.form-input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
}

/* Error Styling */
.input-error {
    border-color: #dc3545 !important; /* Red border for invalid fields */
}

.error-message {
    color: #dc3545;
    font-size: 0.9em;
    margin-top: 5px;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-error ul {
    margin-top: 5px;
    padding-right: 20px;
}


/* Button Group */
.button-group {
    display: flex;
    justify-content: flex-end; /* Align buttons to the right */
    gap: 10px; 
    padding-top: 15px;
    border-top: 1px solid #eee;
    margin-top: 25px;
}

/* Base Button Style */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s;
}

/* Primary Button (Update) */
.btn-primary {
    background-color: #007bff; /* Blue */
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Secondary Button (Cancel) */
.btn-secondary {
    background-color: #6c757d; /* Gray */
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}
    </style>
    <h1>تعديل الكوبون</h1>

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>كود الكوبون</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
        </div>

        <div class="form-group">
            <label>النوع</label>
            <select name="type" class="form-control" required>
                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>مبلغ ثابت</option>
                <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>نسبة مئوية</option>
            </select>
        </div>

        <div class="form-group">
            <label>القيمة</label>
            <input type="number" name="value" class="form-control" step="0.01" value="{{ old('value', $coupon->value) }}" required>
        </div>

        <div class="form-group">
            <label>الحد الأدنى للطلب</label>
            <input type="number" name="min_order_value" class="form-control" step="0.01" value="{{ old('min_order_value', $coupon->min_order_value) }}" required>
        </div>

        <div class="form-group">
            <label>الحد الأقصى للاستخدام</label>
            <input type="number" name="max_uses" class="form-control" value="{{ old('max_uses', $coupon->max_uses) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
