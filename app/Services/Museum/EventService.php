<?php 
namespace App\Services\Museum;

use App\Repositories\{EventRepository, PlaceRepository};

class EventService
{
    public function __construct(protected EventRepository $eventRepository, protected PlaceRepository $placeRepository )
    {
        $this->eventRepository = $eventRepository;
        $this->placeRepository = $placeRepository;
    }

    public function getAllGEMEvents($categoryId = null, $placeId = null, ?int $paginate = 9)
    {
        $where = [];

        if ($categoryId && $categoryId !== 0) {
            $where['event_category_id'] = $categoryId;
        }

        if ($placeId && $placeId !== 0) {
            $where['place_id'] = $placeId;
        }

        $events     = $this->eventRepository->getAllEvents(placeName:'Grand Egyptian Museum', where: $where,paginate: $paginate);
        $categories = $this->eventRepository->getCategories();
        $places     = $this->placeRepository->getAllPlaces();

        return get_defined_vars();
    }

    public function showEvent(int $id): array
    {
        $event = $this->eventRepository->findById($id);
        $paginationEvents = $this->eventRepository->paginationEventsShow($id);
    
        return array_merge(['event' => $event], $paginationEvents);
    }
}