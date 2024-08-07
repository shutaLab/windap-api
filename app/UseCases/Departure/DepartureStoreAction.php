<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureStoreRequest;
use App\Models\Departure;

class DepartureStoreAction
{
    public function __invoke(DepartureStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $departure = Departure::create($validated);

        return response()->json([
            'message' => '出艇の作成に成功しました',
            'data' => $departure
        ], 200);
    }
}