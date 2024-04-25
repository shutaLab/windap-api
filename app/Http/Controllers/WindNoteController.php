<?php

namespace App\Http\Controllers;

use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\Models\WindNote;
use App\UseCases\WindNote\WindNoteIndexAction;
use Illuminate\Http\Request;

class WindNoteController extends Controller
{
    // public function index(WindNoteIndexRequest $request, WindNoteIndexAction $action)
    // {
    //     return $action($request);
    // }

    public function index()
    {
        return WindNote::all();
    }
}
