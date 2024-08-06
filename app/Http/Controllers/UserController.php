<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserIndexRequest;
use App\UseCases\User\UserGradeFilterAction;
use App\UseCases\User\UserIndexAction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserIndexRequest $request, UserIndexAction $action)
    {
        return $action($request);
    }

    public function gradeFilter(UserIndexRequest $request, UserGradeFilterAction $action)
    {
        return $action($request);
    }
}
