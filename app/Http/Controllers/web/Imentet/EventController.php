<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\BookEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function gemEvents(Request $request)
    {
        $categoryName = $request->event_category;

        if ($categoryName === 'exhibitions') {
            $data = $this->eventService->getExhibitions();
            return view('website.gem.events.exhibition', $data);
        }

        $data = $this->eventService->getAllGEMEvents($categoryName, $request->place_id , 9, ['Exhibitions']);

        return view('website.gem.events.index' , $data);
    }

    public function gemEventsShow(Event $event)
    {
        $data = $this->eventService->showEvent($event->id);

        return view('website.gem.events.show' , $data);
    }

    public function pyramidsEvents(Request $request)
    {
        $categoryName = $request->event_category;

        if ($categoryName === 'exhibitions') {
            $data = $this->eventService->getExhibitions();
            return view('website.pyramids.events.exhibition', $data);
        }

        $data = $this->eventService->getAllGEMEvents($categoryName, $request->place_id , 9, ['Exhibitions']);

        return view('website.pyramids.events.index' , $data);
    }

    public function pyramidsEventsShow(Event $event)
    {
        $data = $this->eventService->showEvent($event->id);

        return view('website.pyramids.events.show' , $data);
    }

    public function store(BookEventRequest $request, Event $event)
    {
        $validated = $request->validated();
        $userId = Auth::id();

        $result = $this->eventService->bookEvent($validated, $event, $userId);

        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }

        return redirect()->route('gem.stripe.checkout', ['payment' => $result['payment_id']]);
    }
}
