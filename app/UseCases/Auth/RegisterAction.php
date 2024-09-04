<?php

namespace App\UseCases\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Common\SuccessResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return new SuccessResource('ユーザ新規登録に成功しました');
    }
}
