<?php

namespace App\Livewire\Backoffice\Dashboard;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public $totalUsers;
    public $activeUsers;
    public $totalTransactions;
    public $totalAccounts;
    public $recentUsers;
    public $recentTransactions;

    public function mount()
    {
        $this->loadMetrics();
    }

    public function loadMetrics()
    {
        // Total de utilizadores registados
        $this->totalUsers = User::count();
        
        // Utilizadores ativos (verificados por email)
        $this->activeUsers = User::whereNotNull('email_verified_at')->count();
        
        // Total de transações
        $this->totalTransactions = Transaction::count();
        
        // Total de contas
        $this->totalAccounts = Account::count();
        
        // Utilizadores recentes (últimos 7 dias)
        $this->recentUsers = User::where('created_at', '>=', now()->subDays(7))->count();
        
        // Transações recentes (últimos 7 dias)
        $this->recentTransactions = Transaction::where('created_at', '>=', now()->subDays(7))->count();
    }

    public function render()
    {
        return view('livewire.backoffice.dashboard.show');
    }
}
