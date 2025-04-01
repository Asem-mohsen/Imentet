<?php 
namespace App\Services;

use App\Repositories\{MembershipRepository, UserRepository};
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\{MembershipConfirmationMail, MembershipReminderMail};
use App\Models\User;
use App\Models\UserMembership;

class MembershipService
{
    public function __construct(protected MembershipRepository $membershipRepository, protected UserRepository $userRepository)
    {
        $this->membershipRepository = $membershipRepository;
        $this->userRepository = $userRepository;
    }

    public function getMemberships(array $excludedNames = [])
    {
        return $this->membershipRepository->getAllMemberships(excludedNames: $excludedNames);
    }

    public function getUserActiveMembership(?User $user)
    {
        if (!$user) {
            return null;
        }

        return $user->latestActiveMembership();
    }

    public function findMembership(int $id)
    {
        $membership = $this->membershipRepository->findById($id);

        if (!$membership) {
            return null;
        }

        return $this->formatMembershipDetails($membership);
    }

    public function findMembershipPrice(int $id)
    {
        $membershipPrice = $this->membershipRepository->findPriceById($id);

        return $membershipPrice ?? null;
    }

    public function handleSuccessfulPayment($userId, $membershipId, $priceId)
    {
        $userMembership = $this->membershipRepository->createUserMembership($userId, $membershipId, $priceId);

        $submissionLink = route('gem.memberships.upload-documents', ['token' => encrypt($userMembership->id)]);
        
        $userEmail = $this->userRepository->findById($userId)?->email;

        Mail::to($userEmail)->send(new MembershipConfirmationMail($submissionLink));

        return $userMembership;
    }

    public function checkAndSuspendPendingMemberships()
    {
        $pendingMemberships = UserMembership::where('status', 'pending_documents')
            ->where('document_submission_deadline', '<', now())
            ->get();

        foreach ($pendingMemberships as $membership) {
            $this->membershipRepository->suspendMembership($membership->id);
            Mail::to($membership->user->email)->send(new MembershipReminderMail($membership));
        }
    }

    public function handleDocumentUpload(array $data)
    {
        $membershipId = decrypt($data['token']);

        $userMembership = $this->membershipRepository->findById($membershipId);

        // Update user info
        $this->userRepository->update($userMembership->user_id, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        // Attach documents using Spatie
        $userMembership->addMediaFromRequest('personal_id')->toMediaCollection('personal_id');
        $userMembership->addMediaFromRequest('personal_photo')->toMediaCollection('personal_photo');

        if (!$data['is_egyptian']) {
            $userMembership->addMediaFromRequest('passport')->toMediaCollection('passport');
        }

        return $userMembership;
    }

    private function formatMembershipDetails($membership)
    {
        $minPrice = $membership->prices->min('price');
        $maxPrice = $membership->prices->max('price');

        $durations = $membership->prices->pluck('duration')->unique();
        $isMultipleDurations = $durations->count() > 1;
        
        $formattedDurations = $isMultipleDurations
            ? $durations->map(fn($d) => ucfirst($d->value))->implode(' - ')
            : ucfirst($durations->first()->value);

        return [
            'membership' => $membership,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'isMultipleDurations' => $isMultipleDurations,
            'formattedDurations' => $formattedDurations,
        ];
    }

    public function initiatePayment($user, $membership, $price)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => ['name' => $membership->name],
                    'unit_amount' => $price->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
           'success_url' => route('gem.memberships.success', ['membership' => $membership->id, 'membershipPrice' => $price->id]),
            'cancel_url' => url('/GEM/memberships/cancel'),
        ]);

        return $session->url;
    }
}