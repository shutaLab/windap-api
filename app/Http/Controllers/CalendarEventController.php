<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarEvent\CalendarEventIndexRequest;
use App\UseCases\CalendarEvent\CalendarEventIndexAction;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index(CalendarEventIndexRequest $request, CalendarEventIndexAction $action)
    {
        return $action($request);
    }
}
