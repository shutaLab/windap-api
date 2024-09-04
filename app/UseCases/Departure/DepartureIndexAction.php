<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureIndexRequest;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;

class DepartureIndexAction
{
    public function __invoke(DepartureIndexRequest $request)
    {
        $departures = Departure::with(['user.userProfile'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(DepartureResource::collection($departures));
    }
}