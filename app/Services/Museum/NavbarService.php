<?php 
namespace App\Services\Museum;

use App\Repositories\{CartRepository, EventRepository, CollectionRepository};

class NavbarService
{
    public function __construct(
        protected EventRepository $eventRepository,
        protected CartRepository $cartRepository,
        protected CollectionRepository $collectionRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->collectionRepository = $collectionRepository;
        $this->cartRepository = $cartRepository;
    }

    public function getNavbarData()
    {
        $events = $this->eventRepository->getAllEvents(excludeCategories: ['Exhibitions']);
        $exhibitions = $this->eventRepository->getAllEvents(categoryName: 'Exhibitions');
        $categories = $this->collectionRepository->getCategories();
        $cartItemCount = $this->cartRepository->getCartItemCount();

        return get_defined_vars();
    }
}