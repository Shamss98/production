@extends('layoutes.main')

@section('title', 'إدارة العلامات التجارية')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>العلامات التجارية</h2>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">إضافة علامة تجارية</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم العلامة التجارية</th>
                <th>الشعار</th>
                <th>تاريخ الإضافة</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        @if($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="Logo" width="50">
                        @else
                            لا يوجد
                        @endif
                    </td>
                    <td>{{ $brand->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">لا توجد علامات تجارية.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div>
        {{ $brands->links() }}
    </div>
</div>
@endsection