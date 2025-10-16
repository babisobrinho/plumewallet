<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOnboardingResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'answers',
        'selected_template',
        'completed'
    ];

    protected $casts = [
        'answers' => 'array',
        'completed' => 'boolean'
    ];

    /**
     * Relação com o utilizador
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para respostas completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Scope para respostas não completadas
     */
    public function scopeIncomplete($query)
    {
        return $query->where('completed', false);
    }
}
