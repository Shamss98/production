<?php

namespace App\Services\Profile;

use App\Models\Activity;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
      public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('auth.profile_edit', compact('user', 'profile'));
    }

    public function update(array $data, $request)
    {
        $user = Auth::user();

        // لو في صورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile-photos', 'public');

            // احذف الصورة القديمة
            if ($user->profile && $user->profile->image) {
                if (Storage::disk('public')->exists($user->profile->image)) {
                    Storage::disk('public')->delete($user->profile->image);
                }
            }

            $data['image'] = $imagePath;
        }

        // تحديث أو إنشاء بروفايل
        if ($user->profile) {
            $user->profile->update($data);
        } else {
            $data['user_id'] = $user->id;
            Profile::create($data);
        }

        // Activity log
        Activity::create([
            'user_id'  => Auth::id(),
            'activity' => 'Profile updated',
            'status'   => 'Success',
        ]);

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }
}
