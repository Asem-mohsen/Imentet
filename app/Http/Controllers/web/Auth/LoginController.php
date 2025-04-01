<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
       return view('website.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->authService->webLoign($validated);

            return redirect()->route('index');
        } catch (\Exception $e) {
            Log::error('Login failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
