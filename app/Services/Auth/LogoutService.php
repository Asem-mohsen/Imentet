<?php 
namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutService
{
     /**
     * Logout from the current session.
     */
    public function logoutFromCurrentSession(): void
    {
        Auth::logout();
    }

    /**
     * Logout from all sessions (for web sessions, this is the same as current session).
     */
    public function logoutFromAllSessions(): void
    {
        Auth::logout();
    }

    /**
     * Logout from other sessions (for web sessions, this doesn't apply.
     */
    public function logoutFromOtherSessions(): void
    {
        // For web sessions, there's no concept of "other sessions" like with API tokens
        // This method is kept for consistency with the API structure
        // In a web session context, this could be used to invalidate other session data if needed
    }
}