<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{


    public function index()
    {
        return view('pages.events', ['data' => Event::active()]);
    }

    public function show(Event $event)
    {
        return view('pages.events', ['data' => $event]);
    }
}
