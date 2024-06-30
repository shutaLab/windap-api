<?php

namespace App\UseCases\CalendarEvent;

use App\Http\Requests\CalendarEvent\CalendarEventStoreRequest;
use App\Models\CalendarEvent;

class CalendarEventStoreAction
{
    public function __invoke(CalendarEventStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;


        $calendarEvent = CalendarEvent::create($validated);

        return response()->json([
            'message' => 'イベントの作成に成功しました',
            'data' => $calendarEvent
        ], 200);
    }
}
