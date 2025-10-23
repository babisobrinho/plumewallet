<?php

namespace App\Models;

use App\Enums\LogLevel;
use App\Enums\LogType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'level',
        'message',
        'context',
        'user_id',
        'ip_address',
        'user_agent',
        'url',
        'method',
    ];

    protected $casts = [
        'type' => LogType::class,
        'level' => LogLevel::class,
        'context' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByType($query, LogType $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByLevel($query, LogLevel $level)
    {
        return $query->where('level', $level);
    }

    public function scopeSystem($query)
    {
        return $query->where('type', LogType::SYSTEM);
    }

    public function scopeAudit($query)
    {
        return $query->where('type', LogType::AUDIT);
    }

    public function scopeApi($query)
    {
        return $query->where('type', LogType::API);
    }

    public function scopeErrors($query)
    {
        return $query->whereIn('level', [LogLevel::ERROR, LogLevel::CRITICAL]);
    }

    public function scopeWarnings($query)
    {
        return $query->where('level', LogLevel::WARNING);
    }

    public function scopeInfo($query)
    {
        return $query->where('level', LogLevel::INFO);
    }
}
