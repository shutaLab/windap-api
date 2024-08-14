<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Models\Question;

class QuestionUpdateAction
{
    public function __invoke(QuestionUpdateRequest $request, Question $question)
    {
        $validated = $request->validated();

        if ($request->user()->id !== $question->user_id) {
            return response()->json(
                ['error' => '質問を編集する権限がありません'
            ], 403);
        }

        $question->update($validated);

        return response()->json([
            'message' => '質問の編集に成功しました',
            'data' => $question
        ], 200);
    }
}
