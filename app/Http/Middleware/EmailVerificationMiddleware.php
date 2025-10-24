<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply this middleware to email verification routes
        if ($request->routeIs('verification.verify')) {
            $userId = $request->route('id');
            
            if ($userId && Auth::check()) {
                $authenticatedUser = Auth::user();
                $userToVerify = User::find($userId);
                
                // If the authenticated user is different from the user being verified
                if ($userToVerify && $authenticatedUser->id !== $userToVerify->id) {
                    return redirect()->route('email.verification.different-account')
                        ->with('verification_user_email', $userToVerify->email)
                        ->with('authenticated_user_email', $authenticatedUser->email);
                }
            }
        }

        return $next($request);
    }
}
