<?php

namespace App\Console\Commands;

use App\Models\SystemLog;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Console\Command;

class TestLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'logs:test';

    /**
     * The console command description.
     */
    protected $description = 'Testa o sistema de logs criando alguns registros de exemplo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testando sistema de logs...');

        // Criar alguns logs do sistema
        SystemLog::create([
            'level' => 'info',
            'message' => 'Sistema iniciado com sucesso',
            'context' => ['version' => '1.0.0', 'environment' => 'testing'],
            'user_id' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Laravel Test Command',
            'url' => 'artisan:logs:test',
            'method' => 'CLI',
        ]);

        SystemLog::create([
            'level' => 'warning',
            'message' => 'Tentativa de login com credenciais inválidas',
            'context' => ['email' => 'test@example.com', 'attempts' => 3],
            'user_id' => null,
            'ip_address' => '192.168.1.100',
            'user_agent' => 'Mozilla/5.0 (Test Browser)',
            'url' => '/login',
            'method' => 'POST',
        ]);

        SystemLog::create([
            'level' => 'error',
            'message' => 'Falha ao conectar com API externa',
            'context' => ['api' => 'payment-gateway', 'error_code' => 'TIMEOUT'],
            'user_id' => null,
            'ip_address' => '10.0.0.1',
            'user_agent' => 'Laravel Application',
            'url' => '/api/payments',
            'method' => 'POST',
        ]);

        // Criar alguns logs de auditoria
        $user = User::first();
        if ($user) {
            AuditLog::create([
                'user_id' => $user->id,
                'event' => 'created',
                'auditable_type' => 'App\Models\Transaction',
                'auditable_id' => 999,
                'old_values' => null,
                'new_values' => [
                    'id' => 999,
                    'amount' => 150.00,
                    'type' => 'expense',
                    'description' => 'Teste de log de auditoria'
                ],
                'url' => '/transactions',
                'ip_address' => '192.168.1.50',
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
            ]);

            AuditLog::create([
                'user_id' => $user->id,
                'event' => 'updated',
                'auditable_type' => 'App\Models\Account',
                'auditable_id' => 888,
                'old_values' => [
                    'id' => 888,
                    'name' => 'Conta Antiga',
                    'balance' => 1000.00
                ],
                'new_values' => [
                    'id' => 888,
                    'name' => 'Conta Atualizada',
                    'balance' => 1200.00
                ],
                'url' => '/accounts/888',
                'ip_address' => '192.168.1.50',
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
            ]);

            AuditLog::create([
                'user_id' => $user->id,
                'event' => 'deleted',
                'auditable_type' => 'App\Models\Category',
                'auditable_id' => 777,
                'old_values' => [
                    'id' => 777,
                    'name' => 'Categoria Removida',
                    'type' => 'expense',
                    'color' => 'red-500'
                ],
                'new_values' => null,
                'url' => '/categories/777',
                'ip_address' => '192.168.1.50',
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
            ]);
        }

        $this->info('✅ Logs de teste criados com sucesso!');
        $this->info('📊 Verifique o backoffice em: /backoffice/logs');
        $this->info('   - Logs do Sistema: /backoffice/logs/system');
        $this->info('   - Logs de Auditoria: /backoffice/logs/audit');
        $this->info('   - Logs de API: /backoffice/logs/api');

        return Command::SUCCESS;
    }
}
