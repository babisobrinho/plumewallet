<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\User;
use App\Models\SupportTicket;
use App\Models\BlogPost;
use App\Models\SystemLog;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseBackofficeController
{
    /**
     * Exibir o dashboard do backoffice
     */
    public function index()
    {
        // Estatísticas gerais
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_tickets' => SupportTicket::count(),
            'open_tickets' => SupportTicket::where('status', 'open')->count(),
            'total_posts' => BlogPost::count(),
            'published_posts' => BlogPost::where('status', 'published')->count(),
        ];

        // Usuários recentes
        $recentUsers = User::latest()->take(5)->get();

        // Tickets recentes
        $recentTickets = SupportTicket::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Posts recentes
        $recentPosts = BlogPost::with(['author', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Logs de sistema recentes
        $recentLogs = SystemLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Tentativas de login recentes (apenas falhas)
        $recentFailedLogins = LoginAttempt::where('success', false)
            ->latest()
            ->take(10)
            ->get();

        // Gráfico de usuários por mês (últimos 6 meses)
        $usersByMonth = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Gráfico de tickets por status
        $ticketsByStatus = SupportTicket::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return view('backoffice.dashboard', compact(
            'stats',
            'recentUsers',
            'recentTickets',
            'recentPosts',
            'recentLogs',
            'recentFailedLogins',
            'usersByMonth',
            'ticketsByStatus'
        ));
    }
}
