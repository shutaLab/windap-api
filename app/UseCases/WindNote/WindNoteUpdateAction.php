<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteUpdateRequest;
use App\Models\WindNote;

class WindNoteUpdateAction
{
    public function __invoke(WindNoteUpdateRequest $request, WindNote $windNote)
    {
        $validated = $request->validated();

        $windNote->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'ウィンドノートの編集に成功しました',
            'data' =>  $windNote,
        ], 200);
    }
}
