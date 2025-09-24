@extends('layoutes.main')

@section('content')
<div class="container mt-5">
    <h2>إدارة الإعلانات</h2>
    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary mb-3">إضافة إعلان</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الصورة</th>
                <th>الرابط</th>
                <th>الحالة</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td>{{ $ad->title }}</td>
                    <td><img src="{{ asset('storage/' . $ad->image) }}" width="100"></td>
                    <td>{{ $ad->link }}</td>
                    <td>{{ $ad->status ? 'نشط' : 'غير نشط' }}</td>
                    <td>
                        <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
