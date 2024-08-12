<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureStoreRequest;
use App\Models\Departure;
use App\Models\IntraClaim;
use Illuminate\Support\Arr;

class DepartureStoreAction
{
    public function __invoke(DepartureStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $departure = Departure::create(Arr::except($validated, ['intra_user_id']));

        $intraClaim = IntraClaim::create([
            'user_id' => $request->user()->id,
            'intra_user_id' => $validated['intra_user_id'],
            'departure_id' => $departure->id,
        ]);

        return response()->json([
            'message' => '出艇の作成に成功しました',
            'data' => [$departure,$intraClaim]
        ], 200);
    }
}