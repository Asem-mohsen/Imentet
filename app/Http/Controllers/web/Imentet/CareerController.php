<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Careers\StoreCareerRequest;
use App\Services\CareerService;

class CareerController extends Controller
{
    public function __construct(protected CareerService $careerService)
    {
        $this->careerService = $careerService;
    }

    public function gemCareers()
    {
        $data = $this->careerService->getCareers('Grand Egyptian Museum');

        return view('website.gem.careers', $data);
    }

    public function pyramidsCareers()
    {
        $data = $this->careerService->getCareers('Pyramids');

        return view('website.pyramids.careers', $data);
    }

    public function store(StoreCareerRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        $cvFile = $request->file('cv'); 

        $this->careerService->submitApplication($validated,$user,$cvFile);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

}
