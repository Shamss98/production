<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            // تسجيل محاولة تسجيل دخول فاشلة
            Activity::create([
                'user_id' => null,
                'activity' => 'Failed login attempt for email: ' . $request->email,
                'status' => 'Failed'
            ]);

            return redirect()->route('login')->with('error', 'Invalid email or password');
        }

        $request->session()->regenerate();

        // تسجيل تسجيل دخول ناجح
        Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Logged in',
            'status' => 'Success'
        ]);
        switch(Auth::user()->role){
            case 'admin':
                return redirect()->route('admin.dashboard');

                default:
                return redirect()->route('index');
        }

        
    }

    public function register()
    {
        return view('auth.register');
    }



public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // تسجيل عملية تسجيل الحساب
    Activity::create([
        'user_id' => $user->id,
        'activity' => 'User registered',
        'status' => 'Success'
    ]);

    // إطلاق الـ Registered event
    event(new Registered($user));

    // تسجيل الدخول للمستخدم
    Auth::login($user);

    return redirect()->route('index')->with('success', 'Registration successful. You are now logged in.');
}


    public function profile()
    {
        return view('auth.profile');
    }

    public function logout(Request $request)
    {
        // تسجيل عملية تسجيل الخروج
        Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Logged out',
            'status' => 'Success'
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
    
}
