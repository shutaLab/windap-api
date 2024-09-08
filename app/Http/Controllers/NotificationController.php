<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifiCation\NotificationIndexRequest;
use App\Http\Requests\NotifiCation\NotificationReadAllRequest;
use App\Http\Requests\NotifiCation\NotificationShowRequest;
use App\UseCases\Notification\MarkAsReadAction;
use App\UseCases\NotifiCation\NotificationIndexAction;
use App\UseCases\NotifiCation\NotificationReadAction;
use App\UseCases\NotifiCation\NotificationReadAllAction;
use App\UseCases\NotifiCation\NotificationShowAction;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Testing\Fakes\NotificationFake;

class NotificationController extends Controller
{
    public function index(NotificationIndexRequest $request, NotificationIndexAction $action)
    {
        return $action($request);
    }

    public function show(NotificationShowRequest $request, NotificationShowAction $action, DatabaseNotification $notification)
    {
        return $action($request, $notification);
    }

    public function markAsRead(MarkAsReadAction $action, DatabaseNotification $notification)
    {
        return $action($notification);
    }

    public function readAll(NotificationReadAllRequest $request, NotificationReadAllAction $action)
    {
        return $action($request);
    }
}
