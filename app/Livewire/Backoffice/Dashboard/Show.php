<?php

namespace App\Livewire\Backoffice\Dashboard;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\LoginAttempt;
use App\Models\Post;
use App\Models\Faq;
use App\Models\ContactForm;
use App\Models\SystemLog;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    // Métricas principais
    public $totalUsers;
    public $staffUsers;
    public $clientUsers;
    public $activeSessions;
    
    // Métricas de segurança
    public $recentLoginAttempts;
    public $suspiciousAttempts;
    public $blockedIps;
    public $systemLogs;
    
    // Métricas de conteúdo
    public $totalPosts;
    public $publishedPosts;
    public $totalFaqs;
    public $pendingContacts;
    
    // Métricas detalhadas
    public $newUsersToday;
    public $verifiedUsers;
    public $pendingVerification;
    public $recentLogs;
    public $errorLogs;
    public $contactFormsToday;

    public function mount()
    {
        $this->loadMetrics();
    }

    public function loadMetrics()
    {
        // Métricas de Utilizadores
        $this->totalUsers = User::count();
        
        // Utilizadores por tipo (staff vs client)
        $this->staffUsers = User::whereHas('roles', function($query) {
            $query->where('type', 'staff');
        })->count();
        
        $this->clientUsers = User::whereHas('roles', function($query) {
            $query->where('type', 'client');
        })->count();
        
        // Sessões ativas (se usar sessions na BD)
        try {
            $this->activeSessions = DB::table('sessions')->count();
        } catch (\Exception $e) {
            $this->activeSessions = 0; // Fallback se a tabela não existir
        }
        
        // Métricas de Segurança (últimas 24h)
        $this->recentLoginAttempts = LoginAttempt::where('attempted_at', '>=', now()->subDay())->count();
        $this->suspiciousAttempts = LoginAttempt::where('is_suspicious', true)->count();
        
        // IPs bloqueados (se tiver a funcionalidade)
        $this->blockedIps = 0; // Pode implementar depois
        
        // Métricas de Logs
        $this->systemLogs = SystemLog::count();
        $this->recentLogs = SystemLog::where('created_at', '>=', now()->subDay())->count();
        $this->errorLogs = SystemLog::where('level', 'error')->count();
        
        // Métricas de Conteúdo
        $this->totalPosts = Post::count();
        $this->publishedPosts = Post::where('status', 'published')->count();
        $this->totalFaqs = Faq::count();
        
        // Métricas de Contactos
        $this->pendingContacts = ContactForm::where('status', 'pending')->count();
        $this->contactFormsToday = ContactForm::whereDate('created_at', today())->count();
        
        // Métricas de Utilizadores (detalhadas)
        $this->newUsersToday = User::whereDate('created_at', today())->count();
        $this->verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $this->pendingVerification = User::whereNull('email_verified_at')->count();
    }

    public function render()
    {
        return view('livewire.backoffice.dashboard.show');
    }
}