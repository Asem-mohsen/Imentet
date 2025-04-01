<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function gemAbout()
    {
        return view('website.gem.about');
    }

    public function pyramidsAbout()
    {
        return view('website.pyramids.about');
    }
}
