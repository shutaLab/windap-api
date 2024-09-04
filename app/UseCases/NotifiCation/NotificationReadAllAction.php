<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationReadAllRequest;
use App\Http\Resources\Common\SuccessResource;

class NotificationReadAllAction
{
    public function __invoke(NotificationReadAllRequest $request)
    {
        $notifications = $request->user()->unreadNotifications;

        $notifications->markAsRead();

        return new SuccessResource('通知を全て既読にしました');
    }
}