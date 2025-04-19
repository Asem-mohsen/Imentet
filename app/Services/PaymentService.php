<?php 
namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Mail\OrderConfirmation;
use Exception;

class PaymentService
{
    public function __construct(
        protected PaymentRepository $paymentRepository,
        protected CartService $cartService
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->cartService = $cartService;
        
        if (config('services.stripe.secret')) {
            Stripe::setApiKey(config('services.stripe.secret'));
        }
    }

    public function processPayment($paymentMethod, $paymentMethodId = null)
    {
        $cart = $this->cartService->getCart();
        $amount = $cart->items->sum(fn($item) => $item->shopItem->price * $item->quantity);

        try {
            if ($paymentMethod === 'stripe') {
                // Create Stripe payment
                $paymentIntent = PaymentIntent::create([
                    'amount' => $amount * 100, // Convert to cents
                    'currency' => 'egp',
                    'payment_method' => $paymentMethodId,
                    'confirm' => true,
                    'return_url' => route('gem.checkout.success'),
                ]);

                $payment = $this->createPayment([
                    'user_id' => Auth::id(),
                    'payment_method' => 'stripe',
                    'amount' => $amount,
                    'status' => 'completed',
                    'transaction_id' => $paymentIntent->id,
                ]);
            } else {
                // Create cash payment
                $payment = $this->createPayment([
                    'user_id' => Auth::id(),
                    'payment_method' => 'cash',
                    'amount' => $amount,
                    'status' => 'pending',
                    'transaction_id' => 'CASH-' . uniqid(),
                ]);
            }

            // Create payment items and update stock
            foreach ($cart->items as $item) {
                $this->createPaymentItem([
                    'payment_id' => $payment->id,
                    'payable_type' => 'App\\Models\\ShopItem',
                    'payable_id' => $item->shop_item_id,
                    'quantity' => $item->quantity,
                    'price' => $item->shopItem->price,
                ]);

                // Update stock quantity
                $item->shopItem->decrement('stock_quantity', $item->quantity);
            }

            // Send confirmation email
            $this->sendOrderConfirmationEmail($payment);

            // Clear the cart
            $this->cartService->clearCart();

            return [
                'status' => 'success',
                'payment' => $payment,
                'message' => 'Payment processed successfully!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    protected function createPayment($data)
    {
        return $this->paymentRepository->createPayment($data);
    }

    protected function createPaymentItem($data)
    {
        return $this->paymentRepository->createPaymentItem($data);
    }

    protected function sendOrderConfirmationEmail($payment)
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new OrderConfirmation($payment));
    }
}
