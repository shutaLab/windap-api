<?php

namespace App\UseCases\CalendarEvent;

use App\Http\Requests\CalendarEvent\CalendarEventUpdateRequest;
use App\Models\CalendarEvent;

class CalendarEventUpdateAction
{
    public function __invoke(CalendarEventUpdateRequest $request, CalendarEvent $calendarEvent)
    {
        $validated = $request->validated();

        if ($request->user()->id !== $calendarEvent->user_id) {
            return response()->json([
                'message' => 'イベントの編集をする権限がありません'
            ], 403);
        }

        $calendarEvent->update($validated);

        return response()->json([
            'message' => 'カレンダーイベントの編集に成功しました',
            'data' =>  $calendarEvent,
        ], 200);
    }
}
