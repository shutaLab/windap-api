<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\QuestionIndexRequest;
use App\Http\Requests\Question\QuestionStoreRequest;
use App\UseCases\Question\QuestionIndexAction;
use App\UseCases\Question\QuestionStoreAction;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(QuestionIndexRequest $request, QuestionIndexAction $action)
    {
        return $action($request);
    }

    public function store(QuestionStoreRequest $request, QuestionStoreAction $action)
    {
        return $action($request);
    }
}
