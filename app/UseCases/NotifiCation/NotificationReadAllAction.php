<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationReadAllRequest;

class NotificationReadAllAction
{
    public function __invoke(NotificationReadAllRequest $request)
    {
        $notifications = $request->user()->unreadNotifications;

        $notifications->markAsRead();

        return response()->json([
            'notification' => $notifications,
        ], 200);
    }
}