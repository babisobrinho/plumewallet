<?php

namespace App\Providers;

use App\Services\LoggingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Don't log system startup here - it's causing too many duplicates
        // System startup should be logged elsewhere or removed entirely
        
        // Log authentication events (login attempts are handled by middleware)
        Event::listen(Logout::class, function ($event) {
            LoggingService::logout();
        });
        
        Event::listen(PasswordReset::class, function ($event) {
            LoggingService::passwordChanged();
        });
        
        Event::listen(Verified::class, function ($event) {
            LoggingService::userActivity("Email verified", [
                'user_id' => $event->user->id,
                'user_email' => $event->user->email
            ]);
        });
        
        // Log system errors
        Event::listen('Illuminate\Log\Events\MessageLogged', function ($event) {
            if (in_array($event->level, ['error', 'critical', 'alert', 'emergency'])) {
                LoggingService::error($event->message, $event->context);
            }
        });
    }
}
