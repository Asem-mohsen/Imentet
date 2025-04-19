<?php 
namespace App\Services\Museum;

use App\Repositories\{CollectionRepository, EventRepository , MembershipRepository};
use Carbon\Carbon;

class HomeService
{
    public function __construct(
        protected MembershipRepository $membershipRepository,
        protected EventRepository $eventRepository,
        protected CollectionRepository $collectionRepository)
    {
        $this->membershipRepository = $membershipRepository;
        $this->eventRepository = $eventRepository;
        $this->collectionRepository = $collectionRepository;
    }

    public function getHomeData(?string $placeName = null)
    {
        $exhibitions   = $this->eventRepository->getAllEvents(categoryName: 'Exhibitions');
        $currentEvents = $this->eventRepository->getAllEvents(
            placeName: 'Grand Egyptian Museum',
            whereDates: [
                'start_time' => [
                    'operator' => 'BETWEEN',
                    'value' => [
                        Carbon::today()->toDateString(), 
                        Carbon::today()->addMonth()->toDateString()
                    ]
                ]
            ],
            orderBy: ['id' => 'desc'],
            limit: 3,
            excludeCategories: ['Exhibitions' , 'Museums']
        );
        $upcomingEvents = $this->eventRepository->getAllEvents(
            placeName: $placeName,
            whereDates: [
                'start_time' => [
                    'operator' => 'BETWEEN',
                    'value' => [
                        Carbon::today()->addMonth()->toDateString(), 
                        Carbon::today()->addYear()->toDateString()
                    ]
                ]
            ],
            orderBy: ['id' => 'desc'],
            limit: 3,
            excludeCategories: ['Exhibitions' , 'Museums']
        );
        $pastEvents = $this->eventRepository->getAllEvents(
            placeName: $placeName,
            whereDates: [
                'start_time' => [
                    'operator' => 'BETWEEN',
                    'value' => [
                        Carbon::today()->subYear()->toDateString(), 
                        Carbon::yesterday()->toDateString()
                    ]
                ]
            ],
            orderBy: ['id' => 'desc'],
            limit: 3,
            excludeCategories: ['Exhibitions' , 'Museums']
        );
        $collections  = $this->collectionRepository->getAllCollections(placeName: $placeName, limit: 6);

        return get_defined_vars();
    }

    public function getPyramidsHomeData(?string $placeName = null): array
    {
        $exhibitions   = $this->eventRepository->getAllEvents(categoryName: 'Exhibitions');
        $eventCategories= $this->eventRepository->getCategories(where: ['place_id'=> 1]);
        $events = $this->eventRepository->getAllEvents(
            placeName: $placeName,
            whereDates: [
                'start_time' => [
                    'operator' => 'BETWEEN',
                    'value' => [
                        Carbon::today()->toDateString(), 
                        Carbon::today()->addYear()->toDateString()
                    ]
                ]
            ],
            orderBy: ['id' => 'desc'],
            limit: 3,
            excludeCategories: ['Exhibitions' , 'Museums']
        );
        $collections   = $this->collectionRepository->getAllCollections(placeName: $placeName,limit: 6);
        
        return get_defined_vars();
    }
}