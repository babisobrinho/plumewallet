<?php

namespace App\Console\Commands;

use App\Services\LoggingService;
use Illuminate\Console\Command;

class GenerateTestLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:generate-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test logs for demonstration purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating test logs...');

        // Generate various types of logs
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

        $this->info('Test logs generated successfully!');
        $this->info('You can now view them in the logs page.');
        
        return 0;
    }
}
