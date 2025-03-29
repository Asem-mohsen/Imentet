<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Services\TicketsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct(protected TicketsService $ticketsService)
    {
        $this->ticketsService = $ticketsService;
    }

    public function gemPlanVisit()
    {
        $data = $this->ticketsService->getVisitTickets('Grand Egyptian Museum');

        return view('website.gem.plan-visit', $data);
    }

    public function gemTickets()
    {
        $tickets = $this->ticketsService->getTickets('Grand Egyptian Museum');
        return view('website.gem.tickets.index', [
            'egyptians' => $tickets['egyptians'],
            'foreigners' => $tickets['foreigners'],
            'user' =>  Auth::user(),
            'selectedTickets' => session('ticket_cart', [])
        ]);
    }

    public function storeSelections(Request $request)
    {
        $tickets = $this->ticketsService->getTickets('Grand Egyptian Museum');

        $quantities = $request->input('quantity');
        $selectedTickets = [];
        $index = 0;

        foreach ($tickets['egyptians'] as $ticket) {
            $qty = (int) ($quantities[$index++] ?? 0);
            if ($qty > 0) {
                $selectedTickets[] = [
                    'type' => 'Egyptian - ' . $ticket->ticket_type['en'],
                    'price' => $ticket->price,
                    'quantity' => $qty,
                    'total' => $qty * $ticket->price,
                ];
            }
        }

        foreach ($tickets['foreigners'] as $ticket) {
            $qty = (int) ($quantities[$index++] ?? 0);
            if ($qty > 0) {
                $selectedTickets[] = [
                    'type' => 'Foreigner - ' . $ticket->ticket_type['en'],
                    'price' => $ticket->price,
                    'quantity' => $qty,
                    'total' => $qty * $ticket->price,
                ];
            }
        }

        session(['ticket_cart' => $selectedTickets]);

        return redirect()->route('gem.tickets.index', ['tab' => 'contact']);
    }

}
