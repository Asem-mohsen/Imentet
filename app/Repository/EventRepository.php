<?php 
namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    public function getAllEvents()
    {
        return Event::all();
    }

    public function createEvent(array $data)
    {
        return Event::create($data);
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
    }

    public function findById(int $id): ?Event
    {
        return Event::find($id);
    }
}