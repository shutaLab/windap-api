<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\NotificationIndexRequest;
use App\Http\Requests\Notification\NotificationReadAllRequest;
use App\Http\Requests\Notification\NotificationShowRequest;
use App\UseCases\Notification\NotificationIndexAction;
use App\UseCases\Notification\NotificationReadAction;
use App\UseCases\Notification\NotificationReadAllAction;
use App\UseCases\Notification\NotificationShowAction;
use Illuminate\Notifications\DatabaseNotification;

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

    public function read(NotificationReadAction $action, DatabaseNotification $notification)
    {
        return $action($notification);
    }

    public function readAll(NotificationReadAllRequest $request, NotificationReadAllAction $action)
    {
        return $action($request);
    }
}
