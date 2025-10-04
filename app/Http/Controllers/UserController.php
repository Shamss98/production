<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Services\Auth\AuthService;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index ()
    {
        return $this->authService->showLoginForm();
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    public function register()
    {
        return $this->authService->showRegisterForm();
    }

    public function store(RegisterRequest $request)
    {
        return $this->authService->register($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

}
