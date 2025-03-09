<?php 
namespace App\Services;

use App\Repositories\{ EventRepository , MembershipRepository };

class HomeService
{
    public function __construct(
        protected MembershipRepository $membershipRepository ,
        protected EventRepository $eventRepository)
    {
        $this->membershipRepository = $membershipRepository;
        $this->eventRepository = $eventRepository;
    }

    public function getHomeData()
    {
        $memberships = $this->membershipRepository->getAllMemberships();
        $events      = $this->eventRepository->getAllEvents();

        return get_defined_vars();
    }
}