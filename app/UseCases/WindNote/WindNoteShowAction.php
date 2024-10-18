<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteShowRequest;
use App\Http\Resources\WindNoteResource;
use App\Models\WindNote;

class WindNoteShowAction
{
    public function __invoke(WindNoteShowRequest $request, WindNote $windNote)
    {
        $windNote->load(['user.userProfile', 'noteFavorites']);
        return response()->json(new WindNoteResource($windNote));
    }
}
