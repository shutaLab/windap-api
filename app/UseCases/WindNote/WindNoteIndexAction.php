<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\Models\WindNote;

class WindNoteIndexAction
{
    public function __invoke(WindNoteIndexRequest $request)
    {
        $windNotes = WindNote::with('noteFavorites')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($windNotes);
    }
}
