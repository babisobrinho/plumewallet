<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\SystemLog;
use App\Models\AuditLog;
use App\Models\ApiLog;
use Illuminate\Http\Request;

class LogsController extends BaseBackofficeController
{
    /**
     * Dashboard de logs
     */
    public function index()
    {
        return view('backoffice.logs.index');
    }

    /**
     * Logs do sistema
     */
    public function system(Request $request)
    {
        $query = SystemLog::with('user');

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $logs = $query->latest()->paginate(50);

        return view('backoffice.logs.system', compact('logs'));
    }

    /**
     * Logs de auditoria
     */
    public function audit(Request $request)
    {
        $query = AuditLog::with('user');

        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        $logs = $query->latest()->paginate(50);

        return view('backoffice.logs.audit', compact('logs'));
    }

    /**
     * Logs de API
     */
    public function api(Request $request)
    {
        $query = ApiLog::with('integration');

        if ($request->filled('status_code')) {
            $query->where('status_code', $request->status_code);
        }

        $logs = $query->latest()->paginate(50);

        return view('backoffice.logs.api', compact('logs'));
    }
}
