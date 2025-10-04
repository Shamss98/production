<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if(!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::findOrFail(Auth::id());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}
