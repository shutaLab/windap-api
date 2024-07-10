<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureShowRequest;
use App\Models\Departure;

class DepartureShowAction
{
    public function __invoke(Departure $departure)
    {
        return response()->json($departure);
    }
}
