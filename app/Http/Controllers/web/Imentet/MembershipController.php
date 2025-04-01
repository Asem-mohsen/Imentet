<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Memberships\{MembershipCheckoutRequest, MembershipDocsRequest};
use App\Models\{MembershipPrice, Membership};
use App\Services\MembershipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function __construct(protected MembershipService $membershipService)
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
        $validated  = $request->validated();

        $user       = Auth::user();
        $price      = $this->membershipService->findMembershipPrice($validated['price_id']);

        $checkoutUrl = $this->membershipService->initiatePayment($user, $membership, $price);

        return redirect($checkoutUrl);
    }

    public function paymentSuccess(Request $request ,Membership $membership, MembershipPrice $membershipPrice)
    {
        $user = Auth::user();

        if (!$membership || !$membershipPrice) {
            return redirect()->route('gem.memberships.index')->with('error', 'Invalid membership or price.');
        }

        $this->membershipService->handleSuccessfulPayment($user->id, $membership->id, $membershipPrice->id);

        return redirect()->route('gem.memberships.show', ['membership' => $membership->id])->with('success', 'Membership purchased successfully! Check your email for next steps.');
    }

    public function paymentCancel(Request $request)
    {
        return redirect()->route('gem.memberships.index')->with('error', 'Payment canceled.');
    }

    public function uploadDocuments($token)
    {
        return view('website.gem.memberships.upload-documents', compact('token'));
    }

    public function handleUploadDocuments(MembershipDocsRequest $request)
    {
        $userMembership = $this->membershipService->handleDocumentUpload($request->validated());

        return redirect()
            ->route('gem.memberships.show', ['membership' => $userMembership->membership_id])
            ->with('success', 'Documents submitted successfully!');
    }

}
