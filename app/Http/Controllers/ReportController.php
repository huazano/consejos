<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Event $event)
    {
        return view('event.legitimation.reports.index', compact('event'));
    }
    public function doors(Event $event)
    {
        return view('event.legitimation.doors.index', compact('event'));
    }
}
