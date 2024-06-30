<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteStoreRequest;
use App\Models\WindNote;

class WindNoteStoreAction
{
    public function __invoke(WindNoteStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $windNote = WindNote::create($validated);

        return response()->json([
            'message' => 'ウィンドノートの作成に成功しました',
            'data' => $windNote
        ], 200);
    }
}
