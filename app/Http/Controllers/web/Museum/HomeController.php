<?php

namespace App\Http\Controllers\web\Museum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.gem.index');
    }
}
