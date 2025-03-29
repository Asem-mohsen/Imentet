<?php 
namespace App\Services;

use App\Repositories\TicketsRepository;

class TicketsService
{
    public function __construct(protected TicketsRepository $ticketsRepository )
    {
        $this->ticketsRepository = $ticketsRepository;
    }

    public function getVisitTickets(?string $placeName = null)
    {
        $visitTickets = $this->ticketsRepository->getAllVisitTickets($placeName);
        
        return get_defined_vars();
    }

    public function getTickets(?string $placeName = null)
    {
        return [
            'egyptians' => $this->ticketsRepository->getEgyptianTickets($placeName),
            'foreigners' => $this->ticketsRepository->getForeignerTickets($placeName),
        ];
    }

}