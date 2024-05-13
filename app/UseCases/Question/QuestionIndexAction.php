<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionIndexRequest;
use App\Models\Question;

class QuestionIndexAction
{
    public function __invoke(QuestionIndexRequest $request)
    {
        $questions = Question::with('answers')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($questions);
    }
}
