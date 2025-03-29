<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Donations\{StoreDonationRequest, SuccessPaymentRequest, CancelPaymentRequest};
use App\Services\DonationService;

class DonationController extends Controller
{
    public function __construct(protected DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function gemDonations()
    {
        $data = $this->donationService->getDonationsData();

        return view('website.gem.donations', $data);
    }

    public function store(StoreDonationRequest $request)
    {
        try {
            $checkoutUrl = $this->donationService->createDonation($request->all());
            return redirect($checkoutUrl);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function success(SuccessPaymentRequest $request)
    {
        return $this->donationService->handleSuccessfulPayment($request->validated());
    }

    public function cancel(CancelPaymentRequest $request)
    {
        return $this->donationService->handleCanceledPayment($request->validated());
    }
}
