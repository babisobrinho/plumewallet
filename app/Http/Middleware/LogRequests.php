<?php

namespace App\Http\Middleware;

use App\Services\LoggingService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Temporarily disable all logging to identify the source of duplicate logs
        return $next($request);
        
        // $startTime = microtime(true);
        
        // $response = $next($request);
        
        // $endTime = microtime(true);
        // $responseTime = round(($endTime - $startTime) * 1000, 2); // Convert to milliseconds
        
        // // Only log API requests and important pages
        // if ($this->shouldLog($request)) {
        //     LoggingService::apiRequest(
        //         $request->path(),
        //         $request->method(),
        //         $response->getStatusCode(),
        //         $responseTime
        //     );
        // }
        
        // return $response;
    }
    
    /**
     * Determine if the request should be logged
     */
    private function shouldLog(Request $request): bool
    {
        // Don't log any AJAX requests (including Livewire)
        if ($request->ajax()) {
            return false;
        }
        
        // Don't log Livewire requests
        if ($request->header('X-Livewire')) {
            return false;
        }
        
        // Only log actual page loads, not internal requests
        if ($request->isMethod('GET') && !$request->ajax()) {
            // Don't log API routes - they're too noisy
            // if ($request->is('api/*')) {
            //     return true;
            // }
            
            // Log authentication routes
            if ($request->is('login') || $request->is('register') || $request->is('logout')) {
                return true;
            }
            
            // Log important app routes
            if ($request->is('dashboard') || $request->is('transactions') || $request->is('accounts')) {
                return true;
            }
            
            // Log backoffice page loads
            if ($request->is('backoffice/*')) {
                return true;
            }
        }
        
        return false;
    }
}
