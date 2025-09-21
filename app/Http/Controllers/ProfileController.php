<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('auth.profile_edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile-photos', 'public');

            if ($user->profile && $user->profile->image) {
                if (Storage::disk('public')->exists($user->profile->image)) {
                    Storage::disk('public')->delete($user->profile->image);
                }
            }

            $data['image'] = $imagePath;
        }

        if ($user->profile) {
            $user->profile->update($data);
        } else {
            $data['user_id'] = $user->id;
            Profile::create($data);
        }

        Activity::create([
            'user_id' => $user->id,
            'activity' => 'User registered',
            'status' => 'Success'
        ]);

        // Profile updated

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }

}


