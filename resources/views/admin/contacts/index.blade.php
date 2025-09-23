@extends('layoutes.main')

@section('content')
<div style="max-width: 900px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px;">📩 الرسائل الواردة</h2>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f3f4f6; border-bottom: 2px solid #ddd;">
                <th style="padding: 10px;">#</th>
                <th style="padding: 10px;">الاسم</th>
                <th style="padding: 10px;">الإيميل</th>
                <th style="padding: 10px;">الرسالة</th>
                <th style="padding: 10px;">التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">{{ $contact->id }}</td>
                    <td style="padding: 10px;">{{ $contact->name }}</td>
                    <td style="padding: 10px;">{{ $contact->email }}</td>
                    <td style="padding: 10px;">{{ $contact->message }}</td>
                    <td style="padding: 10px;">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 15px; text-align: center; color: #777;">
                        لا توجد رسائل حتى الآن
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
