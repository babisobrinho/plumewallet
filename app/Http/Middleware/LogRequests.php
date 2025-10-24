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
        $startTime = microtime(true);
        
        $response = $next($request);
        
        $endTime = microtime(true);
        $responseTime = round(($endTime - $startTime) * 1000, 2); // Convert to milliseconds
        
        // Only log API requests and important pages
        if ($this->shouldLog($request)) {
            LoggingService::apiRequest(
                $request->path(),
                $request->method(),
                $response->getStatusCode(),
                $responseTime
            );
        }
        
        return $response;
    }
    
    /**
     * Determine if the request should be logged
     */
    private function shouldLog(Request $request): bool
    {
        // Log API routes
        if ($request->is('api/*')) {
            return true;
        }
        
        // Log backoffice routes
        if ($request->is('backoffice/*')) {
            return true;
        }
        
        // Log authentication routes
        if ($request->is('login') || $request->is('register') || $request->is('logout')) {
            return true;
        }
        
        // Log important app routes
        if ($request->is('dashboard') || $request->is('transactions') || $request->is('accounts')) {
            return true;
        }
        
        return false;
    }
}
