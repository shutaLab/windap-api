<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionStoreRequest;
use App\Models\Question;

class QuestionStoreAction
{
    public function __invoke(QuestionStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $question = Question::create($validated);

        return response()->json([
            'message' => '質問の投稿に成功しました',
            'data' => $question
        ], 200);
    }
}
