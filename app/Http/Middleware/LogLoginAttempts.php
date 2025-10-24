<?php

namespace App\Http\Middleware;

use App\Models\LoginAttempt;
use App\Enums\LoginAttemptStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogLoginAttempts
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Capturar tentativa de login apenas em rotas de autenticação
        if ($this->isLoginAttempt($request)) {
            $this->logLoginAttempt($request, $response);
        }
        
        return $response;
    }
    
    /**
     * Verifica se é uma tentativa de login
     */
    private function isLoginAttempt(Request $request): bool
    {
        return $request->routeIs('login.store') && 
               $request->isMethod('post') && 
               $request->has('email');
    }
    
    /**
     * Registra a tentativa de login
     */
    private function logLoginAttempt(Request $request, Response $response): void
    {
        try {
            $email = $request->input('email');
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            
            // Determinar status baseado na resposta
            $status = $this->determineStatus($response);
            
            // Verificar se é suspeito
            $isSuspicious = $this->isSuspiciousAttempt($email, $ipAddress);
            
            // Obter informações geográficas
            $geoInfo = $this->getGeoInfo($ipAddress);
            
            // Criar registro da tentativa
            LoginAttempt::create([
                'email' => $email,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'status' => $status,
                'failure_reason' => $this->getFailureReason($response),
                'attempted_at' => now(),
                'user_id' => $this->getUserId($email, $status),
                'country' => $geoInfo['country'] ?? null,
                'city' => $geoInfo['city'] ?? null,
                'is_suspicious' => $isSuspicious,
                'blocked_until' => $this->shouldBlock($isSuspicious) ? now()->addHours(24) : null,
            ]);
            
        } catch (\Exception $e) {
            // Log do erro sem quebrar o fluxo de autenticação
            \Log::error('Erro ao registrar tentativa de login: ' . $e->getMessage());
        }
    }
    
    /**
     * Determina o status da tentativa baseado na resposta
     */
    private function determineStatus(Response $response): LoginAttemptStatus
    {
        $statusCode = $response->getStatusCode();
        
        // Se redirecionou para dashboard, foi sucesso
        if ($statusCode === 302 && str_contains($response->headers->get('Location', ''), 'dashboard')) {
            return LoginAttemptStatus::SUCCESS;
        }
        
        // Se redirecionou de volta para login, foi falha
        if ($statusCode === 302 && str_contains($response->headers->get('Location', ''), 'login')) {
            return LoginAttemptStatus::FAILED;
        }
        
        // Status 200 geralmente indica falha (formulário com erro)
        if ($statusCode === 200) {
            return LoginAttemptStatus::FAILED;
        }
        
        return LoginAttemptStatus::FAILED;
    }
    
    /**
     * Obtém o motivo da falha
     */
    private function getFailureReason(Response $response): ?string
    {
        $statusCode = $response->getStatusCode();
        
        if ($statusCode === 200) {
            return 'Invalid credentials or user not found';
        }
        
        return null;
    }
    
    /**
     * Obtém o ID do usuário se o login foi bem-sucedido
     */
    private function getUserId(string $email, LoginAttemptStatus $status): ?int
    {
        if ($status === LoginAttemptStatus::SUCCESS) {
            $user = \App\Models\User::where('email', $email)->first();
            return $user?->id;
        }
        
        return null;
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
     * Verifica se deve bloquear o IP
     */
    private function shouldBlock(bool $isSuspicious): bool
    {
        return $isSuspicious;
    }
    
    /**
     * Obtém informações geográficas do IP
     */
    private function getGeoInfo(string $ipAddress): array
    {
        // Para IPs locais, retornar informações padrão
        if ($this->isLocalIP($ipAddress)) {
            return [
                'country' => 'PT',
                'city' => 'Local'
            ];
        }
        
        // Para IPs reais, usar serviço de geolocalização
        try {
            // Usar serviço gratuito para obter informações geográficas
            $response = file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=country,countryCode,city");
            $data = json_decode($response, true);
            
            if ($data && $data['countryCode']) {
                return [
                    'country' => $data['countryCode'],
                    'city' => $data['city'] ?? 'Unknown'
                ];
            }
        } catch (\Exception $e) {
            \Log::warning("Erro ao obter geolocalização para IP {$ipAddress}: " . $e->getMessage());
        }
        
        return [
            'country' => 'Unknown',
            'city' => 'Unknown'
        ];
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
