<?php 
namespace App\Services;

use App\Repositories\TicketsRepository;
use Carbon\Carbon;

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

    public function getUserSelectedTickets($user)
    {
        if (!$user) {
            return collect();
        }

        return $this->ticketsRepository->getUserTickets($user->id);
    }

    public function findUserSelectedTicket($user, $ticketId)
    {
        if (!$user) {
            return collect();
        }

        return $this->ticketsRepository->findUserTickets(userId: $user->id , ticketId: $ticketId);
    }

    public function storeSelections(array $ticketData, $user)
    {
        if (!$user) {
            return ['error' => 'Please login to continue'];
        }

        $tickets = [];
        foreach ($ticketData['quantity'] as $index => $quantity) {
            if ($quantity > 0) {
                $ticketId = $ticketData['ticket_id'][$index];
                $visitDate = Carbon::parse($ticketData['visit_date'])->format('Y-m-d');

                $ticket = $this->ticketsRepository->findOrFail($ticketId);

                $existingTicket = $this->ticketsRepository->findPendingTicket($user->id, $ticketId);

                if ($existingTicket) {
                    // Update existing ticket
                    $existingTicket->update([
                        'quantity' => $quantity,
                        'total' => $ticket->price * $quantity,
                        'visit_date' => $visitDate,
                        'updated_at' => now(),
                    ]);
                } else {
                    // Insert new ticket
                    $tickets[] = [
                        'user_id' => $user->id,
                        'visit_ticket_id' => $ticketId,
                        'quantity' => $quantity,
                        'total' => $ticket->price * $quantity,
                        'visit_date' => $visitDate,
                        'purchase_date' => now(),
                        'status' => 'pending',
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
        }

        if (!empty($tickets)) {
            $this->ticketsRepository->bulkInsert($tickets);
        }

        session(['ticket_cart' => $this->ticketsRepository->getUserCart($user->id)]);

        return ['success' => true];
    }

}