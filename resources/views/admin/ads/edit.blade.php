@extends('layoutes.main')

@section('content')
<div class="container mt-5">
    <h2>تعديل إعلان</h2>
    <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ $ad->title }}">
        </div>
        <div class="mb-3">
            <label>الصورة الحالية</label><br>
            <img src="{{ asset('storage/' . $ad->image) }}" width="120"><br><br>
            <label>تغيير الصورة</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label>الرابط</label>
            <input type="url" name="link" class="form-control" value="{{ $ad->link }}">
        </div>
        <div class="mb-3">
            <label>الحالة</label>
            <select name="status" class="form-control">
                <option value="1" @if($ad->status) selected @endif>نشط</option>
                <option value="0" @if(!$ad->status) selected @endif>غير نشط</option>
            </select>
        </div>
        <button class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection
