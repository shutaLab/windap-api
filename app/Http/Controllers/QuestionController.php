<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\QuestionIndexRequest;
use App\Http\Requests\Question\QuestionStoreRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Models\Question;
use App\UseCases\Question\QuestionIndexAction;
use App\UseCases\Question\QuestionStoreAction;
use App\UseCases\Question\QuestionUpdateAction;
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

    public function update(QuestionUpdateRequest $request, Question $question, QuestionUpdateAction $action)
    {
        return $action($request, $question);
    }
}
