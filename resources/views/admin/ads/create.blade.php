@extends('layoutes.main')

@section('content')
<div class="container mt-5">
    <h2>إضافة إعلان جديد</h2>
    <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>العنوان</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label>الصورة</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>الرابط</label>
            <input type="url" name="link" class="form-control">
        </div>
        <div class="mb-3">
            <label>الحالة</label>
            <select name="status" class="form-control">
                <option value="1">نشط</option>
                <option value="0">غير نشط</option>
            </select>
        </div>
        <button class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection
