<?php

namespace App\Http\Controllers;

use App\Http\Requests\Departure\DepartureStoreRequest;
use App\UseCases\Departure\DepartureIndexAction;
use App\UseCases\Departure\DepartureStoreAction;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function index(DepartureIndexAction $action)
    {
        return $action();
    }

    public function store(DepartureStoreRequest $request, DepartureStoreAction $action)
    {
        return $action($request);
    }
}
