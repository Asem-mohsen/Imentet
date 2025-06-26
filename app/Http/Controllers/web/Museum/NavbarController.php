<?php

namespace App\Http\Controllers\web\Museum;

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

        return view('layout.navbar.gem-navbar', $data);
    }
}
