<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
       return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $this->authService->webLoign($credentials);

            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}
