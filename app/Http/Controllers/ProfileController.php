<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use App\Services\Profile\ProfileService;

class ProfileController extends Controller
{
   protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function edit()
    {
        return $this->profileService->edit();
    }

    public function update(ProfileUpdateRequest $request)
    {
        return $this->profileService->update($request->validated(), $request);
    }

}


