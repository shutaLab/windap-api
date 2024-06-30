<?php

namespace App\UseCases\Answer;

use App\Http\Requests\Answer\AnswerUpdateRequest;
use App\Models\Answer;

class AnswerUpdateAction
{
    public function __invoke(AnswerUpdateRequest $request, Answer $answer)
    {
        $validated = $request->validated();

        if ($request->user()->id !== $answer->user_id) {
            return response()->json(['error' => 'You can only update your own books.'], 403);
        }

        $answer->update($validated);

        return response()->json([
            'message' => '回答の編集に成功しました',
            'data' =>  $answer,
        ], 200);
    }
}
