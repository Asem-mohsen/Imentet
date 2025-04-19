<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{ ResetPasswordRequest , SendResetLinkEmailRequest };
use App\Services\Auth\AuthService;

class PasswordResetController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function showRequestForm()
    {
        return view('website.auth.passwords.email');
    }

    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->authService->sendPasswordResetLink($validated['email']);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showResetForm($token)
    {
        return view('website.auth.passwords.reset', ['token' => $token]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->authService->resetPassword($validated['email'], $validated['token'], $validated['password']);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }

        return redirect()->route('auth.login.index')->with('status', 'Your password has been reset!');
    }
}

