<?php

namespace App\UseCases\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __invoke(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        $user_profile = $user->userProfile;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'user_profile' => $user_profile
        ], 200);
    }
}
