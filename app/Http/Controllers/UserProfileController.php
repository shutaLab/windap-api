<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileStoreRequest;
use App\UseCases\UserProfileStoreAction;

class UserProfileController extends Controller
{
    public function store(UserProfileStoreRequest $request, UserProfileStoreAction $action)
    {
        return $action($request);
    }
}
