<?php

namespace App\Listeners;

use App\Models\LoginAttempt;
use App\Enums\LoginAttemptStatus;
use App\Services\LoggingService;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogAuthenticationEvents
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle successful login events
     */
    public function handle(Login $event)
    {
        $this->logLoginAttempt($event->user->email, LoginAttemptStatus::SUCCESS, $event->user->id);
        
        // Log to system logs
        LoggingService::loginAttempt($event->user->email, true);
        LoggingService::userActivity("User logged in successfully", [
            'user_id' => $event->user->id,
            'user_email' => $event->user->email,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent()
        ]);
    }

    /**
     * Log login attempt
     */
    private function logLoginAttempt(string $email, LoginAttemptStatus $status, ?int $userId = null, ?string $failureReason = null): void
    {
        try {
            $ipAddress = $this->request->ip();
            $userAgent = $this->request->userAgent();
            
            // Get geo information
            $geoInfo = $this->getGeoInfo($ipAddress);
            
            // Check if this is a suspicious attempt
            $isSuspicious = $this->isSuspiciousAttempt($email, $ipAddress);
            
            // Create login attempt record
            LoginAttempt::create([
                'email' => $email,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'status' => $status,
                'failure_reason' => $failureReason,
                'attempted_at' => now(),
                'user_id' => $userId,
                'country' => $geoInfo['country'] ?? null,
                'city' => $geoInfo['city'] ?? null,
                'is_suspicious' => $isSuspicious,
                'blocked_until' => $this->shouldBlock($isSuspicious) ? now()->addHours(24) : null,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error logging login attempt: ' . $e->getMessage());
        }
    }

    /**
     * Get geo information for IP address
     */
    private function getGeoInfo(string $ipAddress): array
    {
        // For local IPs, return default information
        if ($this->isLocalIP($ipAddress)) {
            return [
                'country' => 'PT',
                'city' => 'Local'
            ];
        }
        
        // For real IPs, use geolocation service
        try {
            $response = file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=country,countryCode,city");
            $data = json_decode($response, true);
            
            if ($data && $data['countryCode']) {
                return [
                    'country' => $data['countryCode'],
                    'city' => $data['city'] ?? 'Unknown'
                ];
            }
        } catch (\Exception $e) {
            Log::warning("Error getting geolocation for IP {$ipAddress}: " . $e->getMessage());
        }
        
        return [
            'country' => 'XX',
            'city' => 'Unknown'
        ];
    }

    /**
     * Check if IP is local
     */
    private function isLocalIP(string $ipAddress): bool
    {
        return str_starts_with($ipAddress, '127.') || 
               str_starts_with($ipAddress, '192.168.') || 
               str_starts_with($ipAddress, '10.') ||
               str_starts_with($ipAddress, '172.');
    }

    /**
     * Check if this is a suspicious attempt
     */
    private function isSuspiciousAttempt(string $email, string $ipAddress): bool
    {
        // Check for multiple failures from same IP in last hour
        $recentFailures = LoginAttempt::where('ip_address', $ipAddress)
            ->where('status', LoginAttemptStatus::FAILED)
            ->where('attempted_at', '>=', now()->subHour())
            ->count();
            
        if ($recentFailures >= 5) {
            return true;
        }
        
        // Check for attempts from different countries for same email in last 24h
        $recentAttempts = LoginAttempt::where('email', $email)
            ->where('attempted_at', '>=', now()->subDay())
            ->distinct('country')
            ->count('country');
            
        if ($recentAttempts >= 3) {
            return true;
        }
        
        return false;
    }

    /**
     * Check if should block the IP
     */
    private function shouldBlock(bool $isSuspicious): bool
    {
        return $isSuspicious;
    }
}