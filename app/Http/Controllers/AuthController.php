<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $token = $this->authService->register($request->all());

        return response()->json(['message' => 'User registered successfully', $token]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('AppToken')->accessToken;
        return response()->json(['token' => $token]);
    }
}




