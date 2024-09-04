<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationShowRequest;
use App\Http\Resources\NotificationResource;
use Illuminate\Notifications\DatabaseNotification;

class NotificationShowAction
{
    public function __invoke(NotificationShowRequest $request, DatabaseNotification $notification)
    {
        if ($request->user()->id !== $notification->notifiable_id) {
            return response()->json(['error' => 'You do not have access to this notification.'], 403);
        }
        
        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return response()->json(new NotificationResource($notification));
    }
}