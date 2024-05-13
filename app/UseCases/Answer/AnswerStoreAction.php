<?php

namespace App\UseCases\Answer;

use App\Http\Requests\Answer\AnswerStoreRequest;
use App\Models\Answer;

class AnswerStoreAction
{
    public function __invoke(AnswerStoreRequest $request)
    {
        $validate = $request->validated();

        $answer = Answer::create([
            'content' => $validate['content'],
            'question_id' => $validate['question_id'],
        ]);

        return response()->json([
            'message' => '回答の投稿に成功しました',
            'data' => $answer
        ], 200);
    }
}
