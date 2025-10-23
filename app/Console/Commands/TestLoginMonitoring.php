<?php

namespace App\Console\Commands;

use App\Models\LoginAttempt;
use App\Models\SystemLog;
use App\Enums\LoginAttemptStatus;
use App\Enums\LogType;
use App\Enums\LogLevel;
use Illuminate\Console\Command;

class TestLoginMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:login-monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa o sistema de monitoramento de tentativas de login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testando Sistema de Monitoramento de Login...');
        
        // Limpar dados de teste anteriores
        LoginAttempt::where('email', 'like', 'test%')->delete();
        
        // Simular diferentes tipos de tentativas
        $this->simulateLoginAttempts();
        
        // Mostrar estatísticas
        $this->showStatistics();
        
        $this->info('✅ Teste concluído! Verifique o backoffice em /backoffice/login-attempts');
    }
    
    private function simulateLoginAttempts()
    {
        $this->info('📝 Simulando tentativas de login...');
        
        // Tentativas bem-sucedidas
        LoginAttempt::create([
            'email' => 'test@plumewallet.com',
            'ip_address' => '192.168.1.100',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (Chrome)',
            'status' => LoginAttemptStatus::SUCCESS,
            'attempted_at' => now()->subMinutes(5),
            'country' => 'PT',
            'city' => 'Lisboa',
            'is_suspicious' => false,
        ]);
        
        // Tentativas falhadas
        LoginAttempt::create([
            'email' => 'test@plumewallet.com',
            'ip_address' => '192.168.1.101',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (Safari)',
            'status' => LoginAttemptStatus::FAILED,
            'failure_reason' => 'Invalid password',
            'attempted_at' => now()->subMinutes(3),
            'country' => 'PT',
            'city' => 'Porto',
            'is_suspicious' => false,
        ]);
        
        // Tentativas suspeitas
        LoginAttempt::create([
            'email' => 'test@plumewallet.com',
            'ip_address' => '203.0.113.1',
            'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (Mobile Safari)',
            'status' => LoginAttemptStatus::SUSPICIOUS,
            'failure_reason' => 'Multiple failed attempts from different countries',
            'attempted_at' => now()->subMinutes(1),
            'country' => 'US',
            'city' => 'New York',
            'is_suspicious' => true,
        ]);
        
        // Tentativas bloqueadas
        LoginAttempt::create([
            'email' => 'test@plumewallet.com',
            'ip_address' => '203.0.113.2',
            'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (Firefox)',
            'status' => LoginAttemptStatus::BLOCKED,
            'failure_reason' => 'IP blocked due to suspicious activity',
            'attempted_at' => now(),
            'country' => 'CN',
            'city' => 'Beijing',
            'is_suspicious' => true,
            'blocked_until' => now()->addHours(24),
        ]);
        
        $this->info('✅ Tentativas simuladas criadas!');
    }
    
    private function showStatistics()
    {
        $this->info('📊 Estatísticas do Sistema:');
        
        $total = LoginAttempt::count();
        $successful = LoginAttempt::where('status', LoginAttemptStatus::SUCCESS)->count();
        $failed = LoginAttempt::where('status', LoginAttemptStatus::FAILED)->count();
        $suspicious = LoginAttempt::where('status', LoginAttemptStatus::SUSPICIOUS)->count();
        $blocked = LoginAttempt::where('status', LoginAttemptStatus::BLOCKED)->count();
        
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Total de Tentativas', $total],
                ['Bem-sucedidas', $successful],
                ['Falhadas', $failed],
                ['Suspeitas', $suspicious],
                ['Bloqueadas', $blocked],
            ]
        );
        
        // Mostrar tentativas recentes
        $recent = LoginAttempt::latest()->take(5)->get(['email', 'ip_address', 'status', 'country', 'city', 'attempted_at']);
        
        $this->info('🕒 Tentativas Recentes:');
        $this->table(
            ['Email', 'IP', 'Status', 'País', 'Cidade', 'Tentado em'],
            $recent->map(function ($attempt) {
                return [
                    $attempt->email,
                    $attempt->ip_address,
                    $attempt->status->value,
                    $attempt->country,
                    $attempt->city,
                    $attempt->attempted_at->format('d/m/Y H:i'),
                ];
            })->toArray()
        );
    }
}
