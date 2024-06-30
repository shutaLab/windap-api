<?php

namespace App\UseCases\WindNote;

use App\Models\WindNote;
use Illuminate\Support\Facades\Auth;

class WindNoteDeleteAction
{
    public function __invoke(WindNote $windNote)
    {
        $user = Auth::user();

        if ($user->id !== $windNote->user_id) {
            return response()->json([
                'message' => '削除する権限がありません',
            ], 403);
        }

        $windNote->delete();

        return response()->json([
            'message' => 'ノートを削除しました',
            'data' => $windNote
        ], 200);
    }
}
