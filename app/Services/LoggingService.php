<?php

namespace App\Services;

use App\Models\SystemLog;
use App\Enums\LogType;
use App\Enums\LogLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggingService
{
    /**
     * Log a system event
     */
    public static function system(string $message, array $context = [], LogLevel $level = LogLevel::INFO): void
    {
        self::log(LogType::SYSTEM, $level, $message, $context);
    }

    /**
     * Log an audit event
     */
    public static function audit(string $message, array $context = [], LogLevel $level = LogLevel::INFO): void
    {
        self::log(LogType::AUDIT, $level, $message, $context);
    }

    /**
     * Log an API event
     */
    public static function api(string $message, array $context = [], LogLevel $level = LogLevel::INFO): void
    {
        self::log(LogType::API, $level, $message, $context);
    }

    /**
     * Log a login event
     */
    public static function login(string $message, array $context = [], LogLevel $level = LogLevel::INFO): void
    {
        self::log(LogType::LOGIN, $level, $message, $context);
    }

    /**
     * Log user activity
     */
    public static function userActivity(string $message, array $context = [], LogLevel $level = LogLevel::INFO): void
    {
        $context['user_id'] = Auth::id();
        $context['user_email'] = Auth::user()?->email;
        self::audit($message, $context, $level);
    }

    /**
     * Log security events
     */
    public static function security(string $message, array $context = [], LogLevel $level = LogLevel::WARNING): void
    {
        self::audit("SECURITY: {$message}", $context, $level);
    }

    /**
     * Log errors
     */
    public static function error(string $message, array $context = [], LogType $type = LogType::SYSTEM): void
    {
        self::log($type, LogLevel::ERROR, $message, $context);
    }

    /**
     * Log critical errors
     */
    public static function critical(string $message, array $context = [], LogType $type = LogType::SYSTEM): void
    {
        self::log($type, LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Log warnings
     */
    public static function warning(string $message, array $context = [], LogType $type = LogType::SYSTEM): void
    {
        self::log($type, LogLevel::WARNING, $message, $context);
    }

    /**
     * Log info
     */
    public static function info(string $message, array $context = [], LogType $type = LogType::SYSTEM): void
    {
        self::log($type, LogLevel::INFO, $message, $context);
    }

    /**
     * Log debug information
     */
    public static function debug(string $message, array $context = [], LogType $type = LogType::SYSTEM): void
    {
        self::log($type, LogLevel::DEBUG, $message, $context);
    }

    /**
     * Core logging method
     */
    private static function log(LogType $type, LogLevel $level, string $message, array $context = []): void
    {
        try {
            $request = request();
            
            SystemLog::create([
                'type' => $type,
                'level' => $level,
                'message' => $message,
                'context' => $context,
                'user_id' => Auth::id(),
                'ip_address' => $request?->ip(),
                'user_agent' => $request?->userAgent(),
                'url' => $request?->fullUrl(),
                'method' => $request?->method(),
            ]);
        } catch (\Exception $e) {
            // Fallback to Laravel's log if database logging fails
            \Log::error("Failed to log to database: " . $e->getMessage(), [
                'original_message' => $message,
                'context' => $context
            ]);
        }
    }

    /**
     * Log CRUD operations
     */
    public static function created(string $model, array $data = []): void
    {
        self::userActivity("Created {$model}", [
            'model' => $model,
            'data' => $data
        ]);
    }

    public static function updated(string $model, array $data = [], array $oldData = []): void
    {
        self::userActivity("Updated {$model}", [
            'model' => $model,
            'data' => $data,
            'old_data' => $oldData
        ]);
    }

    public static function deleted(string $model, array $data = []): void
    {
        self::userActivity("Deleted {$model}", [
            'model' => $model,
            'data' => $data
        ]);
    }

    /**
     * Log authentication events
     */
    public static function loginAttempt(string $email, bool $success, string $reason = null): void
    {
        $message = $success ? "Successful login attempt" : "Failed login attempt";
        $level = $success ? LogLevel::INFO : LogLevel::WARNING;
        
        self::login($message, [
            'email' => $email,
            'success' => $success,
            'reason' => $reason
        ], $level);
    }

    public static function logout(): void
    {
        self::login("User logged out", [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()?->email
        ]);
    }

    public static function passwordChanged(): void
    {
        self::security("Password changed", [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()?->email
        ]);
    }

    /**
     * Log file operations
     */
    public static function fileUploaded(string $filename, string $path, int $size): void
    {
        self::userActivity("File uploaded", [
            'filename' => $filename,
            'path' => $path,
            'size' => $size
        ]);
    }

    public static function fileDeleted(string $filename, string $path): void
    {
        self::userActivity("File deleted", [
            'filename' => $filename,
            'path' => $path
        ]);
    }

    /**
     * Log system events
     */
    public static function systemStartup(): void
    {
        self::system("System started", [], LogLevel::INFO);
    }

    public static function systemShutdown(): void
    {
        self::system("System shutdown", [], LogLevel::INFO);
    }

    public static function maintenanceMode(bool $enabled): void
    {
        $message = $enabled ? "Maintenance mode enabled" : "Maintenance mode disabled";
        self::system($message, ['enabled' => $enabled], LogLevel::INFO);
    }

    /**
     * Log database operations
     */
    public static function databaseQuery(string $query, float $time): void
    {
        if ($time > 1.0) { // Log slow queries
            self::warning("Slow database query", [
                'query' => $query,
                'execution_time' => $time
            ]);
        }
    }

    /**
     * Log email operations
     */
    public static function emailSent(string $to, string $subject, bool $success): void
    {
        $message = $success ? "Email sent successfully" : "Email failed to send";
        $level = $success ? LogLevel::INFO : LogLevel::ERROR;
        
        self::system($message, [
            'to' => $to,
            'subject' => $subject,
            'success' => $success
        ], $level);
    }

    /**
     * Log API requests
     */
    public static function apiRequest(string $endpoint, string $method, int $statusCode, float $responseTime): void
    {
        $level = $statusCode >= 400 ? LogLevel::WARNING : LogLevel::INFO;
        
        self::api("API request", [
            'endpoint' => $endpoint,
            'method' => $method,
            'status_code' => $statusCode,
            'response_time' => $responseTime
        ], $level);
    }
}
