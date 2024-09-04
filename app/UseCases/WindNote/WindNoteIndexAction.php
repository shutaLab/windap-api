<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\Http\Resources\WindNoteResource;
use App\Models\WindNote;

class WindNoteIndexAction
{
    public function __invoke(WindNoteIndexRequest $request)
    {
        $windNotes = WindNote::with(['user.userProfile', 'noteFavorites'])
            ->orderBy('created_at', 'desc')
            ->get();

            return response()->json(WindNoteResource::collection($windNotes));
    }
}
