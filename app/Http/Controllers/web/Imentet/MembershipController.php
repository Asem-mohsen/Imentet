<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Memberships\{MembershipCheckoutRequest, MembershipDocsRequest};
use App\Models\{MembershipPrice, Membership, UserMembership};
use App\Services\MembershipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    protected $membershipService;

    public function __construct(MembershipService $membershipService)
    {
        $this->membershipService = $membershipService;
    }

    public function gemMemberships()
    {
        $memberships = $this->membershipService->getMemberships(excludedNames: ['Supporting' , 'Patron']);

        return view('website.gem.memberships.index', compact('memberships'));
    }

    public function pyramidsMemberships()
    {
        $memberships = $this->membershipService->getMemberships(excludedNames: ['Supporting' , 'Patron']);

        return view('website.pyramids.memberships.index', compact('memberships'));
    }

    public function showInPyramids(Membership $membership)
    {
        $membershipData  = $this->membershipService->findMembership($membership->id);

        if (!$membershipData) {
            return view('website.pyramids.memberships.show', ['membership' => null]);
        }

        $user = Auth::user();
        $userMembership = $this->membershipService->getUserActiveMembership($user);

        return view(
            in_array($membershipData['membership']->type, ['Supporting', 'Patron']) 
                ? 'website.pyramids.memberships.vip' 
                : 'website.pyramids.memberships.show',
            array_merge($membershipData, compact('userMembership'))
        );
    }
    
    public function show(Membership $membership)
    {        
        $membershipData  = $this->membershipService->findMembership($membership->id);

        if (!$membershipData) {
            return view('website.gem.memberships.show', ['membership' => null]);
        }

        $user = Auth::user();
        $userMembership = $this->membershipService->getUserActiveMembership($user);

        return view(
            in_array($membershipData['membership']->type, ['Supporting', 'Patron']) 
                ? 'website.gem.memberships.vip' 
                : 'website.gem.memberships.show',
            array_merge($membershipData, compact('userMembership'))
        );
    }

    public function checkout(MembershipCheckoutRequest $request, Membership $membership)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $price = MembershipPrice::findOrFail($validated['price_id']);

        if ($price->membership_id !== $membership->id) {
            return redirect()->back()->with('error', 'Invalid price selection.');
        }

        $checkoutUrl = $this->membershipService->initiatePayment($user, $membership, $price);

        return redirect($checkoutUrl);
    }

    public function paymentSuccess(Request $request, Membership $membership, MembershipPrice $price)
    {
        $user = Auth::user();

        if (!$membership || !$price) {
            return redirect()->route('gem.memberships.index')->with('error', 'Invalid membership or price.');
        }

        if ($price->membership_id !== $membership->id) {
            return redirect()->route('gem.memberships.index')->with('error', 'Invalid price selection.');
        }

        $this->membershipService->handleSuccessfulPayment($user->id, $membership->id, $price->id);

        return redirect()->route('gem.memberships.show', ['membership' => $membership->id])
            ->with('success', 'Membership purchased successfully! Check your email for next steps.');
    }

    public function paymentCancel(Request $request)
    {
        return redirect()->route('gem.memberships.index')->with('error', 'Payment canceled.');
    }

    public function uploadDocuments($token)
    {
        try {
            $userMembershipId = decrypt($token);
            dd($userMembershipId);
            $userMembership = UserMembership::findOrFail($userMembershipId);

            if ($userMembership->status === 'active') {
                return redirect()->route('gem.memberships.show', $userMembership->membership_id)
                    ->with('info', 'You have already submitted your documents.');
            }

            return view('website.gem.memberships.upload-documents', compact('token'));
        } catch (\Exception $e) {
            return redirect()->route('gem.memberships.index')
                ->with('error', 'Invalid or expired submission link.');
        }
    }

    public function handleUploadDocuments(MembershipDocsRequest $request)
    {
        $user = Auth::user();
        $userMembership = $this->membershipService->handleDocumentUpload($user, $request->token, $request->validated());

        if ($userMembership instanceof \Illuminate\Http\RedirectResponse) {
            return $userMembership;
        }

        return redirect()->route('gem.memberships.show', ['membership' => $userMembership->membership_id])
            ->with('success', 'Documents submitted successfully!');
    }

}
