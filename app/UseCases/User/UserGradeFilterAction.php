<?php

namespace App\UseCases\User;

use App\Http\Requests\User\UserIndexRequest;
use App\Models\User;

class UserGradeFilterAction
{
    public function __invoke(UserIndexRequest $request)
    {
        $users = User::with('userProfile')->wherehas('userProfile', function ($query) {
            $query->whereBetween('grade', [2, 4]);
        })->get();

        return response()->json($users);

    }
}