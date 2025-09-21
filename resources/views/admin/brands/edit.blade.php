@extends('layoutes.main')
@section('title', 'تعديل العلامة التجارية')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>تعديل العلامة التجارية</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">اسم الماركة</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">صورة الماركة</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">الفئة</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">اختر فئة</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $brand->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">تحديث</button>
            </form>
        </div>
    </div>
</div>
@endsection