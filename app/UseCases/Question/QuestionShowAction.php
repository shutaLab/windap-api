<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionShowRequest;
use App\Models\Question;

class QuestionShowAction
{
    public function __invoke(QuestionShowRequest $request, Question $question)
    {
        // 関連する回答をロード
        $question->load('answers');

        // 質問と回答を JSON 形式で返す
        return response()->json([
            'question' => $question,
            'answers' => $question->answers,
        ]);
    }
}
