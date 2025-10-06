<?php

namespace App\Traits;

use App\Models\AuditLog;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Registra uma ação de auditoria
     */
    protected function logAudit($event, $auditable, $oldValues = null, $newValues = null)
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'auditable_type' => get_class($auditable),
            'auditable_id' => $auditable->id,
            'old_values' => $oldValues,
            'new_values' => $newValues ? $newValues->toArray() : null,
            'url' => request()->url(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Registra um log do sistema
     */
    protected function logSystem($level, $message, $context = [])
    {
        SystemLog::create([
            'level' => $level,
            'message' => $message,
            'context' => $context,
            'user_id' => Auth::id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->url(),
            'method' => request()->method(),
            'referrer' => request()->header('referer'),
        ]);
    }
}
