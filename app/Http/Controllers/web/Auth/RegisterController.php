<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
       return view('website.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $result = $this->authService->register($validated);
            Auth::login($result['user']);
            return redirect()->route('index')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
