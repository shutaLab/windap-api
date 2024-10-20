<?php

namespace App\UseCases\WindNote;

use App\Http\Requests\WindNote\WindNoteIndexRequest;
use App\Http\Resources\WindNoteResource;
use App\Models\WindNote;

class WindNoteIndexAction
{
    public function __invoke(WindNoteIndexRequest $request)
    {
        $user = $request->user();

        $windNotes = WindNote::with(['user.userProfile', 'noteFavorites.user.userProfile'])
            ->withCount(['noteFavorites as favorites_count'])
            ->withCount(['noteFavorites as is_favorited' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(WindNoteResource::collection($windNotes));
    }
}
