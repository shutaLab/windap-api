<?php

namespace App\UseCases\Answer;

use App\Http\Requests\Answer\AnswerStoreRequest;
use App\Models\Answer;

class AnswerStoreAction
{
    public function __invoke(AnswerStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $answer = Answer::create($validated);

        return response()->json([
            'message' => '回答の投稿に成功しました',
            'data' => $answer
        ], 200);
    }
}
