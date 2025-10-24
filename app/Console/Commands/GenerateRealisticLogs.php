<?php

namespace App\Console\Commands;

use App\Services\LoggingService;
use Illuminate\Console\Command;

class GenerateRealisticLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:generate-realistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate realistic logs for demonstration purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating realistic logs...');

        // System logs
        LoggingService::system('Application started', ['version' => '2.1.0', 'environment' => 'production']);
        LoggingService::system('Database connection pool initialized', ['connections' => 10]);
        LoggingService::system('Cache driver configured', ['driver' => 'redis', 'host' => 'localhost:6379']);
        LoggingService::system('Queue worker started', ['processes' => 4]);
        LoggingService::system('Scheduled tasks registered', ['tasks' => 12]);
        
        // Info logs
        LoggingService::info('User session created', ['user_id' => 1, 'session_id' => 'sess_123456']);
        LoggingService::info('Email sent successfully', ['to' => 'user@example.com', 'subject' => 'Welcome']);
        LoggingService::info('File uploaded', ['filename' => 'document.pdf', 'size' => '2.5MB']);
        LoggingService::info('Database backup completed', ['size' => '150MB', 'duration' => '5 minutes']);
        LoggingService::info('Cache warmed up', ['keys' => 1250]);
        
        // Debug logs
        LoggingService::debug('SQL query executed', ['query' => 'SELECT * FROM users WHERE active = 1', 'time' => '0.05s']);
        LoggingService::debug('API response generated', ['endpoint' => '/api/users', 'response_time' => '120ms']);
        LoggingService::debug('Memory usage check', ['current' => '45MB', 'peak' => '67MB']);
        LoggingService::debug('Session data stored', ['user_id' => 2, 'data_size' => '2KB']);
        
        // Warning logs
        LoggingService::warning('High CPU usage detected', ['usage' => '85%', 'threshold' => '80%']);
        LoggingService::warning('Slow database query', ['query' => 'SELECT * FROM transactions', 'time' => '2.5s']);
        LoggingService::warning('Memory usage approaching limit', ['usage' => '90%', 'limit' => '512MB']);
        LoggingService::warning('API rate limit approaching', ['current' => '95/100', 'reset_time' => '3600s']);
        LoggingService::warning('Disk space low', ['usage' => '88%', 'available' => '5GB']);
        
        // Error logs
        LoggingService::error('Database connection failed', ['error' => 'Connection timeout', 'retry_count' => 3]);
        LoggingService::error('Email delivery failed', ['to' => 'invalid@email.com', 'error' => 'Invalid email address']);
        LoggingService::error('File upload failed', ['filename' => 'large_file.zip', 'error' => 'File too large']);
        LoggingService::error('API authentication failed', ['endpoint' => '/api/secure', 'error' => 'Invalid token']);
        
        // Critical logs
        LoggingService::critical('System overload detected', ['cpu' => '95%', 'memory' => '98%', 'disk' => '92%']);
        LoggingService::critical('Database corruption detected', ['table' => 'transactions', 'affected_rows' => 150]);
        LoggingService::critical('Security breach attempt', ['ip' => '192.168.1.100', 'attempts' => 50]);
        
        // Audit logs
        LoggingService::audit('User role changed', ['user_id' => 3, 'old_role' => 'client', 'new_role' => 'admin']);
        LoggingService::audit('System configuration modified', ['setting' => 'app.debug', 'old_value' => 'false', 'new_value' => 'true']);
        LoggingService::audit('Data export completed', ['user_id' => 1, 'records' => 5000, 'format' => 'CSV']);
        LoggingService::audit('Permission granted', ['user_id' => 2, 'permission' => 'delete_users', 'granted_by' => 1]);
        LoggingService::audit('Data deleted', ['table' => 'old_logs', 'records' => 10000, 'deleted_by' => 1]);
        
        // API logs
        LoggingService::api('API request completed', ['endpoint' => 'GET /api/users', 'method' => 'GET', 'status' => 200, 'time' => 45]);
        LoggingService::api('API request completed', ['endpoint' => 'POST /api/transactions', 'method' => 'POST', 'status' => 201, 'time' => 120]);
        LoggingService::api('API request completed', ['endpoint' => 'PUT /api/users/1', 'method' => 'PUT', 'status' => 200, 'time' => 80]);
        LoggingService::api('API request completed', ['endpoint' => 'DELETE /api/logs/old', 'method' => 'DELETE', 'status' => 204, 'time' => 200]);
        LoggingService::api('API request completed', ['endpoint' => 'GET /api/reports', 'method' => 'GET', 'status' => 200, 'time' => 1500]);
        
        // Login logs
        LoggingService::login('User logged in', ['email' => 'admin@example.com', 'ip' => '192.168.1.10']);
        LoggingService::login('User logged out', ['email' => 'user@example.com', 'session_duration' => '2h 30m']);
        LoggingService::login('Password changed', ['email' => 'user@example.com', 'ip' => '192.168.1.15']);
        LoggingService::login('Two-factor authentication enabled', ['email' => 'admin@example.com']);
        LoggingService::login('Account locked', ['email' => 'hacker@example.com', 'reason' => 'Too many failed attempts']);
        
        // User activity logs
        LoggingService::userActivity('Profile updated', ['user_id' => 1, 'fields' => ['name', 'email']]);
        LoggingService::userActivity('Password reset requested', ['user_id' => 2, 'ip' => '192.168.1.20']);
        LoggingService::userActivity('Settings changed', ['user_id' => 3, 'setting' => 'notifications']);
        LoggingService::userActivity('Data exported', ['user_id' => 1, 'format' => 'PDF', 'records' => 100]);
        LoggingService::userActivity('Report generated', ['user_id' => 2, 'report_type' => 'monthly_summary']);
        
        // Security logs
        LoggingService::security('Suspicious login attempt', ['ip' => '10.0.0.1', 'country' => 'Unknown', 'attempts' => 15]);
        LoggingService::security('Brute force attack detected', ['ip' => '192.168.1.200', 'target' => 'admin@example.com']);
        LoggingService::security('Unusual data access pattern', ['user_id' => 4, 'pattern' => 'bulk_export']);
        LoggingService::security('File upload blocked', ['filename' => 'malware.exe', 'reason' => 'Suspicious file type']);
        LoggingService::security('API key compromised', ['key_id' => 'ak_123456', 'last_used' => '2024-01-15 10:30:00']);

        $this->info('✅ Realistic logs generated successfully!');
        $this->info('Total logs created: 50+ entries with various types and levels');
        
        return 0;
    }
}
