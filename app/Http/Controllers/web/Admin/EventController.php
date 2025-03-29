<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\Museum\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function gemEvents(Request $request)
    {
        $data = $this->eventService->getAllGEMEvents($request->event_category_id, $request->place_id , 9);

        return view('website.gem.events.index' , $data);
    }

    public function gemEventsShow(Event $event)
    {
        $data = $this->eventService->showEvent($event->id);

        return view('website.gem.events.show' , $data);
    }
}
