<?php 
namespace App\Repositories;

use App\Models\{UserTicket, VisitTicket};

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

    public function findOrFail(int $ticketId)
    {
        return VisitTicket::findOrFail($ticketId);
    }

    public function bulkInsert(array $tickets)
    {
        return UserTicket::insert($tickets);
    }

    public function getUserCart($userId)
    {
        return UserTicket::where('user_id', $userId)
            ->where('status', 'pending')
            ->get();
    }

    public function findPendingTicket($userId, $ticketId)
    {
        return UserTicket::where('user_id', $userId)
            ->where('visit_ticket_id', $ticketId)
            ->where('status', 'pending')
            ->first();
    }

    public function getUserTickets($userId)
    {
        return UserTicket::where('user_id', $userId)
            ->with('visitTicket')
            ->get()
            ->map(function ($ticket) {
                return (object) [ 
                    'type' => $ticket->visitTicket->ticket_type,
                    'price' => $ticket->visitTicket->price,
                    'quantity' => $ticket->quantity,
                    'total' => $ticket->total,
                    'visit_date' => $ticket->visit_date,
                ];
            });
    }
}