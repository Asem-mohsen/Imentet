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

        $submissionLink = route('gem.memberships.upload-documents', [
            'token' => encrypt($userMembership->id),
            'price_id' => $priceId
        ]);
        
        Mail::to($userMembership->user->email)->send(new MembershipConfirmationMail($submissionLink));

        return $userMembership;
    }

    public function checkAndSuspendPendingMemberships()
    {
        $pendingMemberships = $this->membershipRepository->getAllUserMemberships([
            'status' => 'pending_documents',
            'document_submission_deadline' => '<', now()
        ]);

        foreach ($pendingMemberships as $membership) {
            $this->membershipRepository->suspendMembership($membership->id);
            Mail::to($membership->user->email)->send(new MembershipReminderMail($membership));
        }
    }

    public function handleDocumentUpload($user, $token, $data)
    {
        try {
            $userMembershipId = decrypt($token);
            $userMembership = UserMembership::findOrFail($userMembershipId);

            if ($userMembership->status === 'active') {
                return redirect()->route('gem.memberships.show', $userMembership->membership_id)
                    ->with('info', 'You have already submitted your documents.');
            }

            // Update user info
            $this->userRepository->updateUser($user, $data);

            // Update membership status
            $userMembership->update(['status' => 'active']);

            // Handle document uploads
            if (isset($data['personal_id'])) {
                $user->addMedia($data['personal_id'])->toMediaCollection('personal_id');
            }

            if (isset($data['personal_photo'])) {
                $user->addMedia($data['personal_photo'])->toMediaCollection('user_profile_image');
            }

            if (isset($data['passport'])) {
                $user->addMedia($data['passport'])->toMediaCollection('passport');
            }

            return $userMembership;
        } catch (\Exception $e) {
            return redirect()->route('gem.memberships.index')
                ->with('error', 'Invalid or expired submission link.');
        }
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
                    'product_data' => [
                        'name' => $membership->name,
                    ],
                    'unit_amount' => $price->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('gem.memberships.success', ['membership' => $membership->id, 'membershipPrice' => $price->id]),
            'cancel_url' => route('gem.memberships.cancel'),
        ]);

        return $session->url;
    }
}