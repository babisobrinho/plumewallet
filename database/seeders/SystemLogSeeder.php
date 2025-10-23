<?php

namespace Database\Seeders;

use App\Models\SystemLog;
use App\Models\User;
use App\Enums\LogType;
use App\Enums\LogLevel;
use Illuminate\Database\Seeder;

class SystemLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        $systemLogs = [
            // System Logs
            [
                'type' => LogType::SYSTEM,
                'level' => LogLevel::INFO,
                'message' => 'Sistema iniciado com sucesso',
                'context' => ['version' => '1.0.0', 'environment' => 'production'],
                'user_id' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'System/1.0',
                'url' => '/',
                'method' => 'GET',
            ],
            [
                'type' => LogType::SYSTEM,
                'level' => LogLevel::WARNING,
                'message' => 'Alto uso de memória detectado',
                'context' => ['memory_usage' => '85%', 'threshold' => '80%'],
                'user_id' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'System/1.0',
                'url' => '/monitoring',
                'method' => 'GET',
            ],
            [
                'type' => LogType::SYSTEM,
                'level' => LogLevel::ERROR,
                'message' => 'Falha na conexão com base de dados',
                'context' => ['error' => 'Connection timeout', 'retry_count' => 3],
                'user_id' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'System/1.0',
                'url' => '/api/data',
                'method' => 'POST',
            ],
            
            // Audit Logs
            [
                'type' => LogType::AUDIT,
                'level' => LogLevel::INFO,
                'message' => 'Utilizador criado com sucesso',
                'context' => ['action' => 'user_created', 'target_user_id' => 2],
                'user_id' => $users->random()->id,
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'url' => '/backoffice/users',
                'method' => 'POST',
            ],
            [
                'type' => LogType::AUDIT,
                'level' => LogLevel::INFO,
                'message' => 'Post do blog publicado',
                'context' => ['action' => 'post_published', 'post_id' => 1],
                'user_id' => $users->random()->id,
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'url' => '/backoffice/blog',
                'method' => 'PUT',
            ],
            [
                'type' => LogType::AUDIT,
                'level' => LogLevel::WARNING,
                'message' => 'Tentativa de acesso não autorizado',
                'context' => ['action' => 'unauthorized_access', 'resource' => '/admin/settings'],
                'user_id' => $users->random()->id,
                'ip_address' => '192.168.1.102',
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36',
                'url' => '/admin/settings',
                'method' => 'GET',
            ],
            
            // API Logs
            [
                'type' => LogType::API,
                'level' => LogLevel::INFO,
                'message' => 'API request successful',
                'context' => ['endpoint' => '/api/v1/users', 'response_time' => '150ms'],
                'user_id' => $users->random()->id,
                'ip_address' => '203.0.113.1',
                'user_agent' => 'API-Client/1.0',
                'url' => '/api/v1/users',
                'method' => 'GET',
            ],
            [
                'type' => LogType::API,
                'level' => LogLevel::ERROR,
                'message' => 'API rate limit exceeded',
                'context' => ['endpoint' => '/api/v1/data', 'limit' => '100/hour', 'current' => '101'],
                'user_id' => $users->random()->id,
                'ip_address' => '203.0.113.2',
                'user_agent' => 'API-Client/1.0',
                'url' => '/api/v1/data',
                'method' => 'POST',
            ],
            [
                'type' => LogType::API,
                'level' => LogLevel::WARNING,
                'message' => 'Deprecated API endpoint used',
                'context' => ['endpoint' => '/api/v1/old-endpoint', 'deprecated_since' => '2024-01-01'],
                'user_id' => $users->random()->id,
                'ip_address' => '203.0.113.3',
                'user_agent' => 'Legacy-Client/0.9',
                'url' => '/api/v1/old-endpoint',
                'method' => 'GET',
            ],
        ];

        foreach ($systemLogs as $log) {
            SystemLog::create($log);
        }
    }
}