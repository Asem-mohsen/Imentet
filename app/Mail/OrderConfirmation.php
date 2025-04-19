<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->markdown('emails.orders.confirmation')
                    ->subject('Order Confirmation - Grand Egyptian Museum')
                    ->with([
                        'payment' => $this->payment,
                        'items' => $this->payment->paymentItems,
                        'total' => $this->payment->amount,
                    ]);
    }
} 