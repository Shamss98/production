@extends('layoutes.main')

@section('content')
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f9;
    color: #333;
    /* Right-to-left for Arabic */
}

.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e0e0e0;
}
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
    margin-right: 10px;
    direction: rtl;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Ensures padding doesn't affect total width */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
}
.btn {
    display: block;
    width: 100%;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-success {
    background-color: #2ecc71;
    color: #fff;
}

.btn-success:hover {
    background-color: #27ae60;
}
</style>
    <h2>تحديث العرض</h2>

    <form action="{{ route('admin.offers.update', $offer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>المنتج</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" 
                        {{ $product->id == $offer->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group dir=rtl">
            <label>السعر القديم</label>
            <input type="number" step="0.01" name="old_price" class="form-control" 
                   value="{{ $offer->old_price }}" required>
        </div>

        <div class="form-group">
            <label>السعر الجديد <span class="text-danger">*السعر يجب ان يكون اقل من السعر الاساسى*</span></label>
            <input type="number" step="0.01" name="new_price" class="form-control" 
                   value="{{ $offer->new_price }}" required>
        </div>

        <div class="form-group">
            <label>تاريخ البداية</label>
            <input type="date" name="start_date" class="form-control" 
                   value="{{ $offer->start_date }}">
        </div>

        <div class="form-group">
            <label>تاريخ النهاية</label>
            <input type="date" name="end_date" class="form-control" 
                   value="{{ $offer->end_date }}">
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
@endsection
