<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ProfileStoreRequest;
use App\UseCases\User\ProfileStoreAction;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function store(ProfileStoreRequest $request, ProfileStoreAction $action)
    {
        return $action($request);
    }
}
