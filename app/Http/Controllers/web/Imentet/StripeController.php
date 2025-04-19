<?php

namespace App\Http\Controllers\web\Imentet;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\CartService;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Cart;
use App\Models\PaymentItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    protected $paymentService;
    protected $cartService;

    public function __construct(PaymentService $paymentService, CartService $cartService)
    {
        $this->paymentService = $paymentService;
        $this->cartService = $cartService;
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // Original method for event payments
    public function checkout(Payment $payment)
    {
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

    // Original method for event payment success
    public function success(Payment $payment)
    {
        $payment->update(['status' => 'completed']);
        return redirect()->route('gem.events.index')->with('success', 'Payment successful!');
    }

    // Original method for event payment cancellation
    public function cancel(Payment $payment)
    {
        $payment->update(['status' => 'cancelled']);
        return redirect()->route('gem.events.index')->with('error', 'Payment cancelled.');
    }

    // New method for cart checkout
    public function cartCheckout()
    {
        try {
            $cart = $this->cartService->getCart();
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('gem.cart.index')->with('error', 'Your cart is empty');
            }

            $total = $cart->items->sum(function($item) {
                return $item->shopItem->price * $item->quantity;
            });

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'egp',
                        'unit_amount' => $total * 100, // Convert to cents
                        'product_data' => [
                            'name' => 'Cart Items',
                            'description' => 'Payment for cart items',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('gem.stripe.cart.success'),
                'cancel_url' => route('gem.stripe.cart.cancel'),
                'customer_email' => Auth::user()->email,
                'metadata' => [
                    'cart_id' => $cart->id,
                    'user_id' => Auth::id(),
                ],
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('gem.cart.checkout')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    // New method for cart payment success
    public function cartSuccess(Request $request)
    {
        try {
            $session = Session::retrieve($request->get('session_id'));
            
            if ($session->payment_status === 'paid') {
                $cart = Cart::find($session->metadata->cart_id);
                if ($cart) {
                    // Create payment record
                    $payment = Payment::create([
                        'user_id' => $session->metadata->user_id,
                        'amount' => $session->amount_total / 100,
                        'payment_method' => 'stripe',
                        'status' => 'completed',
                        'transaction_id' => $session->payment_intent,
                    ]);

                    // Create payment items
                    foreach ($cart->items as $item) {
                        PaymentItem::create([
                            'payment_id' => $payment->id,
                            'shop_item_id' => $item->shop_item_id,
                            'quantity' => $item->quantity,
                            'price' => $item->shopItem->price,
                        ]);
                    }

                    // Clear the cart
                    $cart->items()->delete();
                    $cart->delete();

                    // Send confirmation email
                    Mail::to(Auth::user()->email)->send(new OrderConfirmation($payment));

                    return redirect()->route('imentet.cart.checkout.success')->with('success', 'Payment successful! Thank you for your order.');
                }
            }

            return redirect()->route('gem.cart.checkout')->with('error', 'Payment verification failed');
        } catch (\Exception $e) {
            return redirect()->route('gem.cart.checkout')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    // New method for cart payment cancellation
    public function cartCancel()
    {
        return redirect()->route('gem.cart.checkout')
            ->with('error', 'Payment cancelled.');
    }
}
