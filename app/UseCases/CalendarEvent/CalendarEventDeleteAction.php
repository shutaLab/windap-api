<?php

namespace App\UseCases\CalendarEvent;

use App\Http\Requests\CalendarEvent\CalendarEventDeleteRequest;
use App\Models\CalendarEvent;
use Illuminate\Support\Facades\Auth;

class CalendarEventDeleteAction
{
    public function __invoke(CalendarEvent $calendarEvent)
    {
        $user = Auth::user();

        if ($user->id !== $calendarEvent->user_id) {
            return response()->json([
                'message' => '削除する権限がありません',
            ], 403);
        }

        $calendarEvent->delete();

        return response()->json([
            'message' => 'ノートを削除しました',
            'data' => $calendarEvent
        ], 200);
    }
}
