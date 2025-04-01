<?php

namespace App\Http\Controllers\web\Imentet;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function checkout(Payment $payment)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Event Booking',
                    ],
                    'unit_amount' => $payment->amount * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('gem.stripe.success', ['payment' => $payment->id]),
            'cancel_url' => route('gem.stripe.cancel', ['payment' => $payment->id]),
        ]);

        return redirect($session->url);
    }

    public function success(Payment $payment)
    {
        $payment->update(['status' => 'completed']);
        return redirect()->route('gem.events.index')->with('success', 'Payment successful!');
    }

    public function cancel(Payment $payment)
    {
        $payment->update(['status' => 'cancelled']);
        return redirect()->route('gem.events.index')->with('error', 'Payment cancelled.');
    }
}
