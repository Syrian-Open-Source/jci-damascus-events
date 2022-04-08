<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class TableController extends Controller
{

    /**
     * show resources
     *
     * @param  \App\Models\Event  $event
     *
     * @author karam mustafa
     */
    public function show(Event $event)
    {
        dd($event);
    }
}
