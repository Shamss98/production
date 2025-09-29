@extends('layoutes.main')

@section('content')
<style>
    /* -------------------------------------- */
    /* General Styles and Container */
    /* -------------------------------------- */
    body {
        background-color: #f8f9fa; /* خلفية فاتحة للوحة التحكم */
    }

    .report-container {
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* ظل خفيف وجميل */
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .report-title {
        font-weight: 700;
        color: #007bff; 
        margin-bottom: 1.5rem;
        text-align: center;
        /* border-bottom: 3px solid #007bff; */
        /* display: inline-block; */
        padding-bottom: 5px;
    }

    /* -------------------------------------- */
    /* Table Styling */
    /* -------------------------------------- */
    .table-coupons {
        border-radius: 8px;
        overflow: hidden; /* لحماية الحواف المستديرة للجدول */
    }

    .table-coupons thead th {
        background-color: #e9ecef;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }

    .table-coupons tbody tr:hover {
        background-color: #f2f2f2; /* تظليل الصف عند التمرير */
    }

    .table-coupons tbody td {
        vertical-align: middle;
    }

    /* Column Specific Styling */
    .coupon-code {
        font-weight: 700;
        color: #dc3545; /* تمييز كود الكوبون باللون الأحمر */
        font-family: monospace; /* خط monospace للأكواد */
    }

    .usage-count {
        font-size: 1.1rem;
        font-weight: 600;
        color: #28a745; /* اللون الأخضر لعدد الاستخدامات */
    }

    /* -------------------------------------- */
    /* Users List Styling */
    /* -------------------------------------- */
    .users-list {
        list-style: none; /* إزالة التنقيط الافتراضي */
        padding-right: 0;
        margin-bottom: 0;
        max-height: 200px; /* تحديد ارتفاع أقصى لقائمة المستخدمين */
        overflow-y: auto; /* إضافة شريط تمرير إذا زاد عدد المستخدمين */
        border-right: 2px solid #eee; /* خط فاصل بسيط */
        padding-right: 10px;
    }
    
    .users-list li {
        margin-bottom: 5px;
        padding-right: 5px;
        border-bottom: 1px dashed #f0f0f0; /* خط منقط فاصل بين المستخدمين */
        font-size: 0.9rem;
    }

    .users-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .user-email {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .use-date {
        color: #999;
        font-size: 0.75rem;
        display: block;
        margin-top: 2px;
    }
    
    .not-used {
        color: #6c757d;
        font-style: italic;
    }
</style>

<div class="container">
    <div class="report-container">
        <h2 class="report-title">تقرير استخدام الكوبونات</h2>

        <table class="table table-bordered table-striped table-hover table-coupons">
            <thead>
                <tr>
                    <th class="text-center">الكود</th>
                    <th class="text-center">عدد المستخدمين</th>
                    <th>المستخدمين (تاريخ الاستخدام)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td class="text-center">
                            <span class="coupon-code">{{ $coupon->code }}</span>
                        </td>
                        <td class="text-center">
                            <span class="usage-count">{{ $coupon->users->count() }}</span>
                        </td>
                        <td>
                            @if($coupon->users->count() > 0)
                                <ul class="users-list">
                                    @foreach($coupon->users as $user)
                                        <li>
                                            <i class="fas fa-user-tag me-1 text-primary"></i>
                                            {{ $user->name }}
                                            <span class="user-email">({{ $user->email }})</span>
                                            <small class="use-date">
                                                - تاريخ الاستخدام: {{ $user->pivot->created_at->format('Y-m-d H:i') }}
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="not-used">لم يستخدم بعد.</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-exclamation-circle me-1"></i> لا توجد بيانات كوبونات لعرضها حالياً.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- يمكنك إضافة جزء للتنقل (Pagination) هنا إذا كانت الكوبونات مقسمة لصفحات --}}
        {{-- @if (isset($coupons) && $coupons->links())
            <div class="d-flex justify-content-center mt-4">
                {{ $coupons->links() }}
            </div>
        @endif --}}
    </div>
</div>
@endsection