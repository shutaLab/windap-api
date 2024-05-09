<?php

namespace App\UseCases\WindNote;

use App\Models\WindNote;

class WindNoteDeleteAction
{
    public function __invoke($windNote)
    {
        $windNote->delete();

        return response()->json([
            'message' => 'ノートを削除しました',
            'data' => $windNote
        ], 200);
    }
}
