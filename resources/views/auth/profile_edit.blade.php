@extends('layoutes.main')

@section('content')
<style>
    .form-container { max-width: 720px; margin: 40px auto; background: #fff; padding: 28px; border-radius: 14px; box-shadow: 0 4px 32px rgba(0,0,0,0.08); }
    .form-title { margin: 0 0 18px; font-size: 1.6rem; font-weight: 700; color: #111827; }
    .form-grid { display: grid; grid-template-columns: 1fr; gap: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-group label { color: #374151; font-weight: 600; }
    .form-group input, .form-group textarea { padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem; }
    .form-actions { margin-top: 18px; display: flex; gap: 12px; }
    .btn { display: inline-block; padding: 10px 18px; border-radius: 8px; border: 1px solid #d1d5db; background: #f9fafb; color: #374151; font-weight: 600; text-decoration: none; cursor: pointer; }
    .btn-primary { background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%); color: #fff; border-color: #2563eb; }
    .preview { display: flex; align-items: center; gap: 12px; }
    .preview img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb; }
    .error { color: #dc2626; font-size: 0.95rem; }
</style>

<div class="form-container">
    <h1 class="form-title">Edit Profile</h1>

    @if ($errors->any())
        <div class="error" style="margin-bottom:10px;">
            <ul style="margin:0 0 0 16px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label for="name">الاسم</label>
                <input id="name" type="text" name="name" value="{{ old('name', $profile->name ?? $user->name) }}" required />
            </div>

            <div class="form-group">
                <label for="phone">رقم الجوال</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" required />
            </div>

            <div class="form-group">
                <label for="address">العنوان</label>
                <textarea id="address" name="address" rows="3" required>{{ old('address', $profile->address ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Profile Photo</label>
                <div class="preview">
                    @if(!empty($profile?->image))
                        <img id="photoPreview" src="{{ asset('storage/' . $profile->image) }}" alt="Current photo" />
                    @else
                        <img id="photoPreview" src="https://via.placeholder.com/80x80.png?text=Photo" alt="Placeholder" />
                    @endif
                    <input id="image" type="file" name="image" accept="image/*" />
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('profile') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>

<script>
    const input = document.getElementById('image');
    const preview = document.getElementById('photoPreview');
    if (input) {
        input.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                preview.src = url;
            }
        });
    }
</script>
@endsection


