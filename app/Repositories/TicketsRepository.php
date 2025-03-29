<?php 
namespace App\Repositories;

use App\Models\VisitTicket;

class TicketsRepository
{
    public function getAllVisitTickets(?string $placeName = null)
    {
        $query = VisitTicket::when($placeName, function ($query) use ($placeName) {
            $query->whereHas('place', function ($query) use ($placeName) {
                $query->where('name->en', $placeName);
            });
        });
    
        return $query->get();
    }

    public function getAllTickets(?string $placeName = null)
    {
        return VisitTicket::when($placeName, function ($query) use ($placeName) {
            $query->whereHas('place', function ($query) use ($placeName) {
                $query->where('name->en', $placeName);
            });
        })->get();
    }

    public function getEgyptianTickets(?string $placeName = null)
    {
        return VisitTicket::where('ticket_type->en', 'LIKE', '%Egyptian%')
            ->when($placeName, function ($query) use ($placeName) {
                $query->whereHas('place', function ($query) use ($placeName) {
                    $query->where('name->en', $placeName);
                });
            })
            ->get();
    }

    public function getForeignerTickets(?string $placeName = null)
    {
        return VisitTicket::where('ticket_type->en', 'LIKE', '%Foreigner%')
            ->when($placeName, function ($query) use ($placeName) {
                $query->whereHas('place', function ($query) use ($placeName) {
                    $query->where('name->en', $placeName);
                });
            })
            ->get();
    }
}