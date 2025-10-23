<?php

namespace App\Models;

use App\Enums\LoginAttemptStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'ip_address',
        'user_agent',
        'status',
        'failure_reason',
        'attempted_at',
        'user_id',
        'country',
        'city',
        'is_suspicious',
        'blocked_until',
    ];

    protected $casts = [
        'status' => LoginAttemptStatus::class,
        'attempted_at' => 'datetime',
        'is_suspicious' => 'boolean',
        'blocked_until' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeSuccessful($query)
    {
        return $query->where('status', LoginAttemptStatus::SUCCESS);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', LoginAttemptStatus::FAILED);
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', LoginAttemptStatus::BLOCKED);
    }

    public function scopeSuspicious($query)
    {
        return $query->where('status', LoginAttemptStatus::SUSPICIOUS);
    }

    public function scopeByIp($query, $ip)
    {
        return $query->where('ip_address', $ip);
    }

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeRecent($query, $hours = 24)
    {
        return $query->where('attempted_at', '>=', now()->subHours($hours));
    }

    public function scopeSuspiciousActivity($query)
    {
        return $query->where('is_suspicious', true);
    }
}
