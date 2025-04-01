<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tickets\StoreTicketSelectionRequest;
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

    
    public function pyramidsPlanVisit()
    {
        $data = $this->ticketsService->getVisitTickets('Pyramids');

        return view('website.pyramids.plan-visit', $data);
    }

    public function pyramidsTickets()
    {
        $tickets = $this->ticketsService->getTickets('Pyramids');

        $user = Auth::user();

        $selectedTickets = $this->ticketsService->getUserSelectedTickets($user);

        return view('website.pyramids.tickets.index', [
            'egyptians' => $tickets['egyptians'],
            'foreigners' => $tickets['foreigners'],
            'user' =>  $user,
            'selectedTickets' => $selectedTickets
        ]);
    }

    public function gemTickets()
    {
        $tickets = $this->ticketsService->getTickets('Grand Egyptian Museum');

        $user = Auth::user();

        $selectedTickets = $this->ticketsService->getUserSelectedTickets($user);

        return view('website.gem.tickets.index', [
            'egyptians' => $tickets['egyptians'],
            'foreigners' => $tickets['foreigners'],
            'user' =>  $user,
            'selectedTickets' => $selectedTickets
        ]);
    }

    public function storeSelections(StoreTicketSelectionRequest $request)
    {
        $user = Auth::user();
        $validatedData = $request->validated();

        $result = $this->ticketsService->storeSelections($validatedData,$user);

        if (isset($result['error'])) {
            return redirect()->route('auth.login.index')->with('error', $result['error']);
        }

        return response()->json(['success' => true, 'message' => 'Tickets saved successfully.']);
    }

}
