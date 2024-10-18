<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionIndexRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;

class QuestionIndexAction
{
    public function __invoke(QuestionIndexRequest $request)
    {
        $questions = Question::with('user.userProfile','answers.user.userProfile')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(QuestionResource::collection($questions));
    }
}
