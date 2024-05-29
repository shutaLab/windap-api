<?php

namespace App\UseCases\CalendarEvent;

use App\Http\Requests\CalendarEvent\CalendarEventIndexRequest;
use App\Models\CalendarEvent;

class CalendarEventIndexAction
{
    public function __invoke(CalendarEventIndexRequest $request)
    {
        $calendarEvent = CalendarEvent::query()
            ->get();

        return response()->json($calendarEvent);
    }
}
