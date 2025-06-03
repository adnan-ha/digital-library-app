<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return response()->json((['message' => 'user created successfully', 'token' => $token]), 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token]);
        }
        return response()->json(['message' => 'invalid credentials'], 401);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'logged out']);
    }
}
