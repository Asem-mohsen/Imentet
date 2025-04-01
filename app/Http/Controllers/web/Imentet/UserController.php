<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('website.auth.profile',compact('user'));
    }
}
