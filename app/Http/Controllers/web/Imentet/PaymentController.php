<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $cartService;

    public function __construct(PaymentService $paymentService, CartService $cartService)
    {
        $this->paymentService = $paymentService;
        $this->cartService = $cartService;
    }

    public function process(Request $request)
    {
        try {
            $cart = $this->cartService->getCart();
            
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('gem.cart.index')->with('error', 'Your cart is empty');
            }

            $paymentMethod = $request->input('payment_method');
            
            if ($paymentMethod === 'stripe') {
                return redirect()->route('gem.stripe.cart.checkout');
            }

            // Handle cash payment
            $total = $cart->items->sum(function($item) {
                return $item->shopItem->price * $item->quantity;
            });

            // Create payment record
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'amount' => $total,
                'payment_method' => 'cash',
                'status' => 'pending',
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

            return redirect()->route('imentet.cart.checkout.success')->with('success', 'Order placed successfully! Thank you for your order.');
        } catch (\Exception $e) {
            return redirect()->route('gem.cart.checkout')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('website.gem.cart.success');
    }
}