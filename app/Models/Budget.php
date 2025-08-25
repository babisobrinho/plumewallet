<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'total_income',
        'total_budgeted',
        'total_spent',
        'total_available',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_income' => 'decimal:2',
        'total_budgeted' => 'decimal:2',
        'total_spent' => 'decimal:2',
        'total_available' => 'decimal:2'
    ];

    /**
     * Relacionamento com User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com BudgetEnvelopes
     */
    public function envelopes(): HasMany
    {
        return $this->hasMany(BudgetEnvelope::class);
    }

    /**
     * Scope para budgets ativos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope para budgets do usuário atual
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para budget do mês atual
     */
    public function scopeCurrentMonth($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    /**
     * Calcular total disponível
     */
    public function calculateAvailable()
    {
        $this->total_available = $this->total_income - $this->total_budgeted;
        $this->save();
        return $this->total_available;
    }

    /**
     * Verificar se o budget está ativo
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Verificar se o budget está completo
     */
    public function isComplete(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Obter o mês do budget
     */
    public function getMonthName(): string
    {
        return Carbon::parse($this->start_date)->format('F Y');
    }
}
