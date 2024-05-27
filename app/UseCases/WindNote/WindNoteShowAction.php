<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteShowRequest;
use App\Models\WindNote;

class WindNoteShowAction
{
    public function __invoke(WindNoteShowRequest $request, WindNote $windNote)
    {
        return response()->json($windNote);
    }
}
