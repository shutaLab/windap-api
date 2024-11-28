<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifiCation\NotificationIndexRequest;
use App\Http\Requests\NotifiCation\NotificationReadAllRequest;
use App\Http\Requests\NotifiCation\NotificationShowRequest;
use App\UseCases\NotifiCation\NotificationIndexAction;
use App\UseCases\Notification\NotificationReadAction;
use App\UseCases\NotifiCation\NotificationReadAllAction;
use App\UseCases\NotifiCation\NotificationShowAction;
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
