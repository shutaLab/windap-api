<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureUpdateRequest;
use App\Models\Departure;

class DepartureUpdateAction
{
    public function __invoke(DepartureUpdateRequest $request, Departure $departure)
    {
        $validated = $request->validated();

        if ($request->user()->id !== $departure->user_id) {
            return response()->json([
                'message' => '出艇の編集をする権限がありません.'
            ], 403);
        }

        $departure->update($validated);

        return response()->json([
            'message' => '出艇の編集に成功しました',
            'data' =>  $departure,
        ], 200);
    }
}