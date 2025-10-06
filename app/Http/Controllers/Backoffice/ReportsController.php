<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\User;
use App\Models\SupportTicket;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends BaseBackofficeController
{
    /**
     * Dashboard de relatórios
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'open_tickets' => SupportTicket::where('status', 'open')->count(),
            'published_posts' => BlogPost::where('status', 'published')->count(),
        ];

        return view('backoffice.reports.index', compact('stats'));
    }

    /**
     * Métricas e gráficos
     */
    public function metrics()
    {
        // Dados para gráficos
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

        $ticketsByStatus = SupportTicket::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return view('backoffice.reports.metrics', compact('usersByMonth', 'ticketsByStatus'));
    }

    /**
     * Templates de relatórios
     */
    public function templates()
    {
        return view('backoffice.reports.templates');
    }

    /**
     * Relatórios salvos
     */
    public function saved()
    {
        return view('backoffice.reports.saved');
    }
}
