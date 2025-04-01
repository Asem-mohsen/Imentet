<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('website.index' , compact('user'));
    }

    public function about()
    {
        $user = Auth::user();
        return view('website.about' , compact('user'));
    }
}
