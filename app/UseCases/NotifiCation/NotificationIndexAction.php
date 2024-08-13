<?php

namespace App\UseCases\NotifiCation;

use App\Http\Requests\NotifiCation\NotificationIndexRequest;
use Illuminate\Support\Facades\Auth;

class NotificationIndexAction
{
    public function __invoke(NotificationIndexRequest $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return response()->json([
            'data' => $notifications,
        ], 200);
    }
}