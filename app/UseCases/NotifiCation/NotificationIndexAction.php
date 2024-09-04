<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationIndexRequest;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationIndexAction
{
    public function __invoke(NotificationIndexRequest $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return response()->json(NotificationResource::collection($notifications));
    }
}