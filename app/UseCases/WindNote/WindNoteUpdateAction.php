<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteUpdateRequest;
use App\Models\WindNote;

class WindNoteUpdateAction
{
    public function __invoke(WindNoteUpdateRequest $request, WindNote $windNote)
    {
        $validated = $request->validated();

        if ($request->user()->id !== $windNote->user_id) {
            return response()->json(['error' => 'You can only update your own books.'], 403);
        }

        $windNote->update($validated);

        return response()->json([
            'message' => 'ウィンドノートの編集に成功しました',
            'data' =>  $windNote,
        ], 200);
    }
}
