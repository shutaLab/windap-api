<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\AnswerStoreRequest;
use App\UseCases\Answer\AnswerStoreAction;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(AnswerStoreRequest $request, AnswerStoreAction $action)
    {
        return $action($request);
    }
}
