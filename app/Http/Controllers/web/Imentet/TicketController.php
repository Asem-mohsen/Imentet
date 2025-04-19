<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tickets\{RemoveTicketRequest, StoreTicketSelectionRequest};
use App\Services\TicketsService;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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

    public function removeTicket(RemoveTicketRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = Auth::user();
            $ticketId = $validated['ticket_id'];
            
            $selectedTicket = $this->ticketsService->findUserSelectedTicket($user , $ticketId);
            
            if (!$selectedTicket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket not found in your cart',
                ], 404);
            }
            
            $selectedTicket->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ticket removed successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove ticket from cart',
            ], 500);
        }
    }

    public function processPayment()
    {
        $user = Auth::user();
        $selectedTickets = $this->ticketsService->getUserSelectedTickets($user);
        
        if ($selectedTickets->isEmpty()) {
            return redirect()->route('gem.tickets.index')->with('error', 'No tickets selected');
        }

        $total = $selectedTickets->sum('total');

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => [
                        'name' => 'GEM Tickets',
                    ],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('gem.tickets.success'),
            'cancel_url' => route('gem.tickets.index'),
            'customer_email' => $user->email,
            'metadata' => [
                'user_id' => $user->id,
            ],
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess()
    {
        $user = Auth::user();
        $selectedTickets = $this->ticketsService->getUserSelectedTickets($user);
        
        if ($selectedTickets->isEmpty()) {
            return redirect()->route('gem.tickets.index')->with('error', 'No tickets found');
        }

        // Update ticket status to paid
        // foreach ($selectedTickets as $ticket) {
        //     $ticket->update(['status' => 'paid']);
        // }

        return view('website.gem.tickets.ticket', [
            'user' => $user,
            'tickets' => $selectedTickets,
            'total' => $selectedTickets->sum('total'),
        ]);
    }

}
