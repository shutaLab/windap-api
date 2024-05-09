<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Models\Question;

class QuestionUpdateAction
{
    public function __invoke(QuestionUpdateRequest $request, Question $question)
    {
        $validated = $request->validated();

        $question->update([
            'content' => $validated['content']
        ]);

        return response()->json([
            'message' => '質問の編集に成功しました',
            'data' => $question
        ], 200);
    }
}
