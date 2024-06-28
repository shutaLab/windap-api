<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\UseCases\Auth\LoginAction;
use App\UseCases\Auth\RegisterAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ユーザー登録
    public function register(RegisterRequest $request, RegisterAction $action)
    {
        return $action($request);
    }

    // ログイン
    public function login(LoginRequest $request, LoginAction $action)
    {
        return $action($request);
    }

    // ログアウト
    public function logout(Request $request)
    {
        $request->user()?->tokens()->delete();

        Auth::guard('web')->logout();

        return response()->json(['message' => 'Logout successful'], Response::HTTP_OK);
    }
}
