<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationIndexRequest;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationIndexAction
{
    public function __invoke(NotificationIndexRequest $request)
    {
        $notifications = $request->user()->notifications;

        return response()->json(NotificationResource::collection($notifications));
    }
}