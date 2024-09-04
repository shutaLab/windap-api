<?php

namespace App\UseCases\User;

use App\Http\Requests\User\UserIndexRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserIndexAction
{
    public function __invoke(UserIndexRequest $request)
    {
        $users = User::with('userProfile')->get();

        return response()->json(UserResource::collection($users));
    }
}