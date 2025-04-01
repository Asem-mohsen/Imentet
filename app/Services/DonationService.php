<?php 
namespace App\Services;

use App\Models\Donation;
use App\Repositories\{UserRepository, DonationRepository, PaymentRepository, PlaceRepository};
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;

class DonationService
{
    public function __construct(
        protected PlaceRepository $placeRepository, 
        protected UserRepository $userRepository,
        protected DonationRepository $donationRepository,
        protected PaymentRepository $paymentRepository
        )
    {

    }

    public function getDonationsData()
    {
        $places = $this->placeRepository->getAllPlaces();
        
        return get_defined_vars();
    }

    public function createDonation(array $data)
    {
        return DB::transaction(function () use ($data) {

            // Get or create user
            $user = $this->userRepository->getOrCreateUser(
                $data['email'], $data['first_name'], $data['last_name'], $data['phone']
            );

            $donation = $this->donationRepository->createDonation($data);

            // Create a pending payment
            $payment = $this->paymentRepository->createPayment([
                'user_id' => $user->id,
                'amount' => $donation->amount,
                'status' => 'pending',
                'transaction_id' => null,
            ]);

            // Store payment item
            $this->paymentRepository->createPaymentItem([
                'payment_id' => $payment->id,
                'payable_type' => Donation::class,
                'payable_id' => $donation->id,
                'price' => $donation->amount,
            ]);

            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Donation for ' . $donation->place->name,
                        ],
                        'unit_amount' => $donation->amount * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('gem.donations.success', ['donation' => $donation->id]),
                'cancel_url' => route('gem.donations.cancel', ['donation' => $donation->id]),
            ]);

            return $session->url;
        });
    }

    public function handleSuccessfulPayment(array $validatedData)
    {
        $donation = $this->donationRepository->findById($validatedData['donation_id']);
        $payment = $this->paymentRepository->getPendingPayment($donation->user_id, $donation->amount);

        if ($payment) {
            $this->paymentRepository->updatePayment($payment, [
                'status' => 'successful',
                'transaction_id' => $validatedData['transaction_id'],
            ]);
        }

        return back()->with('success', 'Thank you for your donation!');
    }

    public function handleCanceledPayment(array $validatedData)
    {
        $donation = $this->donationRepository->findById($validatedData['donation_id']);
        $payment = $this->paymentRepository->getPendingPayment($donation->user_id, $donation->amount);

        if ($payment) {
            $this->paymentRepository->updatePayment($payment, ['status' => 'failed']);
        }

        return back()->with('error', 'Your payment was canceled.');
    }
}