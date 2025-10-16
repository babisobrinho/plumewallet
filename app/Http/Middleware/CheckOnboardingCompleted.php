<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOnboardingCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip onboarding check for onboarding routes, logout, and API routes
        if ($request->is('onboarding/*') || 
            $request->is('logout') || 
            $request->is('api/*') ||
            $request->is('livewire/*') ||
            $request->is('_ignition/*')) {
            return $next($request);
        }

        // Check if user is authenticated and hasn't completed onboarding
        if (auth()->check() && !auth()->user()->hasCompletedOnboarding()) {
            // Only redirect if we're not already on an onboarding route
            if (!$request->is('onboarding')) {
                return redirect()->route('onboarding.welcome');
            }
        }

        return $next($request);
    }
}
