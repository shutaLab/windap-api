<?php

namespace App\Http\Controllers;

use App\Http\Requests\WindNote\WindNoteDeleteRequest;
use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\Http\Requests\WindNote\WindNoteStoreRequest;
use App\Models\WindNote;
use App\UseCases\WindNote\WindNoteDeleteAction;
use App\UseCases\WindNote\WindNoteIndexAction;
use App\UseCases\WindNote\WindNoteStoreAction;
use Illuminate\Http\Request;

class WindNoteController extends Controller
{
    public function index(WindNoteIndexRequest $request, WindNoteIndexAction $action)
    {
        return $action($request);
    }

    public function store(WindNoteStoreRequest $request, WindNoteStoreAction $action)
    {
        return $action($request);
    }

    public function destroy($id, WindNoteDeleteAction $action)
    {
        return $action($id);
    }
}
