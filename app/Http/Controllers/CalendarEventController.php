<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarEvent\CalendarEventIndexRequest;
use App\Http\Requests\CalendarEvent\CalendarEventStoreRequest;
use App\UseCases\CalendarEvent\CalendarEventIndexAction;
use App\UseCases\CalendarEvent\CalendarEventStoreAction;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index(CalendarEventIndexRequest $request, CalendarEventIndexAction $action)
    {
        return $action($request);
    }

    public function store(CalendarEventStoreRequest $request, CalendarEventStoreAction $action)
    {
        return $action($request);
    }
}
