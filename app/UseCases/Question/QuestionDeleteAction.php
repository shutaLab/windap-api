<?php

namespace App\UseCases\Question;

use App\Models\Question;

class QuestionDeleteAction
{
    public function __invoke(Question $question)
    {
        $question->delete();

        return response()->json([
            'message' => '質問を削除しました',
            'data' => $question
        ], 200);
    }
}
