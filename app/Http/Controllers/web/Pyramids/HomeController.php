<?php

namespace App\Http\Controllers\web\Pyramids;

use App\Http\Controllers\Controller;
use App\Services\Museum\HomeService;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = $this->homeService->getPyramidsHomeData(placeName: 'Pyramids');
        
        return view('website.pyramids.index' , $data);
    }
}
