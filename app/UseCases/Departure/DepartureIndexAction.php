<?php

namespace App\UseCases\Departure;

use App\Models\Departure;

class DepartureIndexAction
{
    public function __invoke()
    {
        $departures = Departure::with(['user', 'intraUser'])->get();

        return response()->json($departures);
    }
}
