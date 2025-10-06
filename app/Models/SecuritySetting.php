<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecuritySetting extends Model
{
    protected $fillable = [
        'max_login_attempts',
        'password_expiry_days',
        'session_timeout_minutes',
        'two_factor_required',
        'ip_whitelist',
        'brute_force_protection',
        'failed_login_lockout_minutes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'two_factor_required' => 'boolean',
        'ip_whitelist' => 'array',
        'brute_force_protection' => 'boolean',
    ];

    /**
     * Relação com o usuário que criou
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relação com o usuário que atualizou
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
