<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        $user = $request->user();

        // Check if user is authenticated and has any of the required role types
        if (!$user || !$user->hasAnyRoleType($types)) {
            // Custom redirect or abort response
            abort(403, 'Unauthorized access for your role type.');
        }

        return $next($request);
    }
}
