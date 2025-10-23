<?php

namespace Database\Seeders;

use App\Models\LoginAttempt;
use App\Models\User;
use App\Enums\LoginAttemptStatus;
use Illuminate\Database\Seeder;

class LoginAttemptSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        $loginAttempts = [
            // Successful logins
            [
                'email' => 'admin@plumewallet.com',
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::SUCCESS,
                'failure_reason' => null,
                'attempted_at' => now()->subHours(2),
                'user_id' => $users->first()->id,
                'country' => 'PT',
                'city' => 'Lisboa',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            [
                'email' => 'lenice@plumewallet.com',
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::SUCCESS,
                'failure_reason' => null,
                'attempted_at' => now()->subHours(1),
                'user_id' => $users->where('name', 'lenice')->first()?->id,
                'country' => 'PT',
                'city' => 'Porto',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            
            // Failed logins
            [
                'email' => 'admin@plumewallet.com',
                'ip_address' => '192.168.1.102',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::FAILED,
                'failure_reason' => 'Invalid password',
                'attempted_at' => now()->subMinutes(30),
                'user_id' => null,
                'country' => 'PT',
                'city' => 'Coimbra',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            [
                'email' => 'test@example.com',
                'ip_address' => '192.168.1.103',
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::FAILED,
                'failure_reason' => 'User not found',
                'attempted_at' => now()->subMinutes(15),
                'user_id' => null,
                'country' => 'BR',
                'city' => 'São Paulo',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            
            // Suspicious attempts
            [
                'email' => 'admin@plumewallet.com',
                'ip_address' => '203.0.113.1',
                'user_agent' => 'curl/7.68.0',
                'status' => LoginAttemptStatus::SUSPICIOUS,
                'failure_reason' => 'Multiple failed attempts from same IP',
                'attempted_at' => now()->subMinutes(10),
                'user_id' => null,
                'country' => 'US',
                'city' => 'New York',
                'is_suspicious' => true,
                'blocked_until' => now()->addHours(1),
            ],
            [
                'email' => 'admin@plumewallet.com',
                'ip_address' => '203.0.113.2',
                'user_agent' => 'python-requests/2.28.1',
                'status' => LoginAttemptStatus::SUSPICIOUS,
                'failure_reason' => 'Automated login attempt detected',
                'attempted_at' => now()->subMinutes(5),
                'user_id' => null,
                'country' => 'CN',
                'city' => 'Beijing',
                'is_suspicious' => true,
                'blocked_until' => now()->addHours(2),
            ],
            
            // Blocked attempts
            [
                'email' => 'admin@plumewallet.com',
                'ip_address' => '203.0.113.3',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::BLOCKED,
                'failure_reason' => 'IP blocked due to suspicious activity',
                'attempted_at' => now()->subMinutes(2),
                'user_id' => null,
                'country' => 'RU',
                'city' => 'Moscow',
                'is_suspicious' => true,
                'blocked_until' => now()->addDays(1),
            ],
            
            // Multiple attempts from same IP
            [
                'email' => 'user1@example.com',
                'ip_address' => '192.168.1.200',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::FAILED,
                'failure_reason' => 'Invalid password',
                'attempted_at' => now()->subMinutes(45),
                'user_id' => null,
                'country' => 'PT',
                'city' => 'Braga',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            [
                'email' => 'user2@example.com',
                'ip_address' => '192.168.1.200',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::FAILED,
                'failure_reason' => 'User not found',
                'attempted_at' => now()->subMinutes(40),
                'user_id' => null,
                'country' => 'PT',
                'city' => 'Braga',
                'is_suspicious' => false,
                'blocked_until' => null,
            ],
            [
                'email' => 'user3@example.com',
                'ip_address' => '192.168.1.200',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'status' => LoginAttemptStatus::FAILED,
                'failure_reason' => 'Invalid password',
                'attempted_at' => now()->subMinutes(35),
                'user_id' => null,
                'country' => 'PT',
                'city' => 'Braga',
                'is_suspicious' => true,
                'blocked_until' => now()->addHours(1),
            ],
        ];

        foreach ($loginAttempts as $attempt) {
            LoginAttempt::create($attempt);
        }
    }
}