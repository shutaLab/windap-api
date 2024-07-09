<?php

namespace App\Http\Controllers;

use App\UseCases\Departure\DepartureIndexAction;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function index(DepartureIndexAction $action)
    {
        return $action();
    }
}
