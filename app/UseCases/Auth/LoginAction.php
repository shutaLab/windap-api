<?php

namespace App\UseCases\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Common\SuccessResource;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __invoke(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();

        return new SuccessResource('ログインに成功しました');
    }
}
