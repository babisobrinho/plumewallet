<?php

namespace App\Console\Commands;

use App\Models\SystemLog;
use App\Services\LoggingService;
use Illuminate\Console\Command;

class ClearAndGenerateLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear-and-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all existing logs and generate new ones with proper translations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing existing logs...');
        
        // Clear all existing logs
        SystemLog::truncate();
        
        $this->info('Generating new logs with proper translations...');

        // Generate various types of logs with proper translations
        LoggingService::system('System startup completed', ['version' => '1.0.0']);
        LoggingService::info('Application initialized successfully');
        LoggingService::debug('Debug information: Database connection established');
        
        LoggingService::userActivity('User performed test action', [
            'action' => 'test',
            'details' => 'This is a test log entry'
        ]);
        
        LoggingService::security('Security event detected', [
            'event_type' => 'suspicious_activity',
            'severity' => 'medium'
        ]);
        
        LoggingService::api('API endpoint accessed', [
            'endpoint' => '/api/test',
            'method' => 'GET',
            'response_time' => 150
        ]);
        
        LoggingService::login('User login attempt', [
            'email' => 'test@example.com',
            'success' => true
        ]);
        
        LoggingService::warning('Warning: High memory usage detected', [
            'memory_usage' => '85%',
            'threshold' => '80%'
        ]);
        
        LoggingService::error('Error: Database connection failed', [
            'error_code' => 'DB_CONNECTION_FAILED',
            'retry_count' => 3
        ]);
        
        LoggingService::audit('Audit: Configuration changed', [
            'setting' => 'app.debug',
            'old_value' => 'false',
            'new_value' => 'true'
        ]);
        
        LoggingService::created('Test Entity', [
            'entity_id' => 123,
            'name' => 'Test Item',
            'type' => 'demo'
        ]);
        
        LoggingService::updated('Test Entity', [
            'entity_id' => 123,
            'name' => 'Updated Test Item',
            'changes' => ['name' => 'Test Item -> Updated Test Item']
        ]);
        
        LoggingService::deleted('Test Entity', [
            'entity_id' => 123,
            'name' => 'Updated Test Item'
        ]);

        // Generate some additional realistic logs
        LoggingService::system('Database migration completed', ['migration' => 'create_users_table']);
        LoggingService::info('Cache cleared successfully');
        LoggingService::debug('Session started for user', ['user_id' => 1]);
        
        LoggingService::userActivity('User created new account', [
            'user_id' => 2,
            'email' => 'newuser@example.com',
            'role' => 'client'
        ]);
        
        LoggingService::security('Failed login attempt blocked', [
            'email' => 'hacker@example.com',
            'ip_address' => '192.168.1.100',
            'reason' => 'Too many failed attempts'
        ]);
        
        LoggingService::api('API rate limit exceeded', [
            'endpoint' => '/api/users',
            'method' => 'POST',
            'rate_limit' => '100/hour'
        ]);
        
        LoggingService::login('Password reset requested', [
            'email' => 'user@example.com',
            'ip_address' => '192.168.1.50'
        ]);
        
        LoggingService::warning('Disk space low', [
            'usage' => '90%',
            'available' => '1GB'
        ]);
        
        LoggingService::error('Email sending failed', [
            'recipient' => 'user@example.com',
            'error' => 'SMTP connection timeout'
        ]);
        
        LoggingService::audit('User permissions updated', [
            'user_id' => 3,
            'permissions' => ['read', 'write', 'delete'],
            'updated_by' => 1
        ]);

        $this->info('✅ Logs cleared and new logs generated successfully!');
        $this->info('You can now view them in the logs page with proper translations.');
        
        return 0;
    }
}
