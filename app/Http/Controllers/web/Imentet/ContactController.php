<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(protected ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function gemContact()
    {
        return view('website.gem.contact');
    }

    public function pyramidsContact()
    {
        return view('website.pyramids.contact');
    }
    
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        $this->contactService->handleContactForm($validated);

        return back()->with('success', 'Your message has been sent successfully.');
    }

}
