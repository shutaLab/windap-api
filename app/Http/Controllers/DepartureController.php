<?php

namespace App\Http\Controllers;

use App\Http\Requests\Departure\DepartureStoreRequest;
use App\Http\Requests\Departure\DepartureUpdateRequest;
use App\Models\Departure;
use App\UseCases\Departure\DepartureIndexAction;
use App\UseCases\Departure\DepartureStoreAction;
use App\UseCases\Departure\DepartureUpdateAction;
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

    public function update(DepartureUpdateRequest $request, Departure $departure, DepartureUpdateAction $action)
    {
        return $action($request, $departure);
    }
}
