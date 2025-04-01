<?php

namespace App\Http\Controllers\web\Museum;

use App\Http\Controllers\Controller;
use App\Services\Museum\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = $this->homeService->getHomeData(placeName: 'Grand Egyptian Museum');
        
        return view('website.gem.index' , $data);
    }
}
