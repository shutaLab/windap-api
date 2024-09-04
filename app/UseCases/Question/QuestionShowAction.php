<?php

namespace App\UseCases\Question;

use App\Http\Requests\Question\QuestionShowRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;

class QuestionShowAction
{
    public function __invoke(QuestionShowRequest $request, Question $question)
    {
        // 関連する回答をロード
        $question->load('user.userProfile','answers');

        // 質問と回答を JSON 形式で返す
        return response()->json(new QuestionResource($question));
    }
}
