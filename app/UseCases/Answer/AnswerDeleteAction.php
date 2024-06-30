<?php

namespace App\UseCases\Answer;

use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerDeleteAction
{
    public function __invoke(Answer $answer)
    {
        $user = Auth::user();

        if ($user->id !== $answer->user_id) {
            return response()->json([
                'message' => '削除する権限がありません',
            ], 403);
        }

        $answer->delete();

        return response()->json([
            'message' => 'ノートを削除しました',
            'data' => $answer
        ], 200);
    }
}
