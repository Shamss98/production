<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Activity;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class AuthService
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $this->logActivity(null, 'Failed login attempt for email: ' . $request->email, 'Failed');

            return redirect()->route('login')->with('error', 'Invalid email or password');
        }

        $request->session()->regenerate();

        $this->logActivity(Auth::id(), 'Logged in', 'Success');

        // توجيه حسب الدور
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('index'),
        };
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();

        $user = User::create($userData);

        event(new Registered($user));
        Auth::login($user);

        $this->logActivity($user->id, 'User registered', 'Success');

        return redirect()->route('index')->with('success', 'Registration successful. You are now logged in.');
    }

    public function logout(Request $request)
    {
        $this->logActivity(Auth::id(), 'Logged out', 'Success');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    private function logActivity($userId, $activity, $status)
    {
        Activity::create([
            'user_id'  => $userId,
            'activity' => $activity,
            'status'   => $status,
        ]);
    }
}
