<?php

namespace App\Http\Controllers;

use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\UseCases\WindNote\WindNoteIndexAction;
use Illuminate\Http\Request;

class WindNoteController extends Controller
{
    public function index(WindNoteIndexRequest $request, WindNoteIndexAction $action)
    {
        return $action($request);
    }
}
