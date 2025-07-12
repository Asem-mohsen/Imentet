<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LogoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct(protected LogoutService $logoutService) {}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login.index');
    }

    /**
     * Logout from the current session (Revoke current token).
     */
    public function logoutFromCurrentSession()
    {
        $this->logoutService->logoutFromCurrentSession();
        
        return redirect()->route('auth.login.index')->with('status', 'Successfully logged out from current session');
    }

    /**
     * Logout from all sessions (Revoke all tokens for the user).
     */
    public function logoutFromAllSessions()
    {
        $this->logoutService->logoutFromAllSessions();
        
        return redirect()->route('auth.login.index')->with('status', 'Successfully logged out from all sessions');
    }

    /**
     * Logout from all other sessions except the current one.
     */
    public function logoutFromOtherSessions()
    {
        $this->logoutService->logoutFromOtherSessions();
        
        return redirect()->route('auth.login.index')->with('status', 'Successfully logged out from other sessions');
    }
}
