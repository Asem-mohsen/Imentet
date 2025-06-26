<?php

namespace App\Http\Controllers\web\Pyramids;

use App\Http\Controllers\Controller;
use App\Services\NavbarService;

class NavbarController extends Controller
{
    public function __construct(protected NavbarService $navbarService)
    {
        $this->navbarService = $navbarService;
    }

    public function index()
    {
        $data = $this->navbarService->getNavbarData();

        return view('layout.navbar.pyramids-navbar', $data);
    }
}
