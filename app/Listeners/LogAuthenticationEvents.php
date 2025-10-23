<?php

namespace App\Listeners;

use App\Models\LoginAttempt;
use App\Enums\LoginAttemptStatus;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;

class LogAuthenticationEvents
{
    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        match (true) {
            $event instanceof Attempting => $this->logAttempting($event),
            $event instanceof Failed => $this->logFailed($event),
            $event instanceof Login => $this->logSuccessful($event),
            $event instanceof Logout => $this->logLogout($event),
            default => null
        };
    }
    
    /**
     * Registra tentativa de login
     */
    private function logAttempting(Attempting $event): void
    {
        try {
            $credentials = $event->credentials;
            $email = $credentials['email'] ?? null;
            
            if (!$email) {
                return;
            }
            
            $ipAddress = Request::ip();
            $userAgent = Request::userAgent();
            
            // Verificar se já existe uma tentativa recente (evitar duplicatas)
            $existingAttempt = LoginAttempt::where('email', $email)
                ->where('ip_address', $ipAddress)
                ->where('attempted_at', '>=', now()->subMinutes(1))
                ->first();
                
            if ($existingAttempt) {
                return;
            }
            
            // Criar tentativa inicial (será atualizada quando soubermos o resultado)
            LoginAttempt::create([
                'email' => $email,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'status' => LoginAttemptStatus::FAILED, // Será atualizado
                'attempted_at' => now(),
                'country' => $this->getCountryFromIP($ipAddress),
                'city' => $this->getCityFromIP($ipAddress),
                'is_suspicious' => $this->isSuspiciousAttempt($email, $ipAddress),
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar tentativa de login: ' . $e->getMessage());
        }
    }
    
    /**
     * Registra login falhado
     */
    private function logFailed(Failed $event): void
    {
        try {
            $credentials = $event->credentials;
            $email = $credentials['email'] ?? null;
            
            if (!$email) {
                return;
            }
            
            $ipAddress = Request::ip();
            
            // Atualizar a tentativa mais recente para falhada
            $attempt = LoginAttempt::where('email', $email)
                ->where('ip_address', $ipAddress)
                ->where('attempted_at', '>=', now()->subMinutes(1))
                ->latest()
                ->first();
                
            if ($attempt) {
                $attempt->update([
                    'status' => LoginAttemptStatus::FAILED,
                    'failure_reason' => 'Invalid credentials',
                    'is_suspicious' => $this->isSuspiciousAttempt($email, $ipAddress),
                ]);
            }
            
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar login falhado: ' . $e->getMessage());
        }
    }
    
    /**
     * Registra login bem-sucedido
     */
    private function logSuccessful(Login $event): void
    {
        try {
            $user = $event->user;
            $email = $user->email;
            $ipAddress = Request::ip();
            
            // Atualizar a tentativa mais recente para bem-sucedida
            $attempt = LoginAttempt::where('email', $email)
                ->where('ip_address', $ipAddress)
                ->where('attempted_at', '>=', now()->subMinutes(1))
                ->latest()
                ->first();
                
            if ($attempt) {
                $attempt->update([
                    'status' => LoginAttemptStatus::SUCCESS,
                    'user_id' => $user->id,
                    'failure_reason' => null,
                    'is_suspicious' => false, // Reset suspicious flag on success
                ]);
            } else {
                // Se não encontrou tentativa recente, criar uma nova
                LoginAttempt::create([
                    'email' => $email,
                    'ip_address' => $ipAddress,
                    'user_agent' => Request::userAgent(),
                    'status' => LoginAttemptStatus::SUCCESS,
                    'attempted_at' => now(),
                    'user_id' => $user->id,
                    'country' => $this->getCountryFromIP($ipAddress),
                    'city' => $this->getCityFromIP($ipAddress),
                    'is_suspicious' => false,
                ]);
            }
            
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar login bem-sucedido: ' . $e->getMessage());
        }
    }
    
    /**
     * Registra logout
     */
    private function logLogout(Logout $event): void
    {
        try {
            $user = $event->user;
            
            // Criar log de logout como evento de sistema
            \App\Models\SystemLog::create([
                'type' => \App\Enums\LogType::AUDIT,
                'level' => \App\Enums\LogLevel::INFO,
                'message' => "Usuário {$user->name} fez logout",
                'user_id' => $user->id,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'url' => Request::url(),
                'method' => Request::method(),
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar logout: ' . $e->getMessage());
        }
    }
    
    /**
     * Verifica se a tentativa é suspeita
     */
    private function isSuspiciousAttempt(string $email, string $ipAddress): bool
    {
        // Verificar múltiplas falhas do mesmo IP nas últimas 1 hora
        $recentFailures = LoginAttempt::where('ip_address', $ipAddress)
            ->where('status', LoginAttemptStatus::FAILED)
            ->where('attempted_at', '>=', now()->subHour())
            ->count();
            
        if ($recentFailures >= 5) {
            return true;
        }
        
        // Verificar tentativas de diferentes países para o mesmo email nas últimas 24h
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
     * Obtém país do IP
     */
    private function getCountryFromIP(string $ipAddress): ?string
    {
        if ($this->isLocalIP($ipAddress)) {
            return 'PT';
        }
        
        try {
            $response = file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=countryCode");
            $data = json_decode($response, true);
            
            return $data['countryCode'] ?? 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
    
    /**
     * Obtém cidade do IP
     */
    private function getCityFromIP(string $ipAddress): ?string
    {
        if ($this->isLocalIP($ipAddress)) {
            return 'Local';
        }
        
        try {
            $response = file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=city");
            $data = json_decode($response, true);
            
            return $data['city'] ?? 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
    
    /**
     * Verifica se é um IP local
     */
    private function isLocalIP(string $ipAddress): bool
    {
        return str_starts_with($ipAddress, '127.') || 
               str_starts_with($ipAddress, '192.168.') || 
               str_starts_with($ipAddress, '10.') ||
               str_starts_with($ipAddress, '172.');
    }
}
