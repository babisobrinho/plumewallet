<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BudgetEnvelope extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'category_id',
        'budgeted_amount',
        'spent_amount',
        'available_amount',
        'rollover_amount',
        'status',
        'notes'
    ];

    protected $casts = [
        'budgeted_amount' => 'decimal:2',
        'spent_amount' => 'decimal:2',
        'available_amount' => 'decimal:2',
        'rollover_amount' => 'decimal:2'
    ];

    /**
     * Relacionamento com Budget
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * Relacionamento com Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Calcular valor disponível
     */
    public function calculateAvailable()
    {
        $this->available_amount = $this->budgeted_amount - $this->spent_amount + $this->rollover_amount;
        $this->save();
        return $this->available_amount;
    }

    /**
     * Verificar se o envelope está no limite
     */
    public function isAtLimit(): bool
    {
        return $this->available_amount <= 0;
    }

    /**
     * Verificar se o envelope está excedido
     */
    public function isOverspent(): bool
    {
        return $this->available_amount < 0;
    }

    /**
     * Verificar se o envelope tem saldo disponível
     */
    public function hasAvailable(): bool
    {
        return $this->available_amount > 0;
    }

    /**
     * Obter percentual de uso
     */
    public function getUsagePercentage(): float
    {
        if ($this->budgeted_amount == 0) {
            return 0;
        }
        
        return round(($this->spent_amount / $this->budgeted_amount) * 100, 1);
    }

    /**
     * Obter percentual disponível
     */
    public function getAvailablePercentage(): float
    {
        if ($this->budgeted_amount == 0) {
            return 0;
        }
        
        return round(($this->available_amount / $this->budgeted_amount) * 100, 1);
    }

    /**
     * Atualizar status baseado no valor disponível
     */
    public function updateStatus()
    {
        if ($this->available_amount < 0) {
            $this->status = 'overspent';
        } elseif ($this->spent_amount >= $this->budgeted_amount) {
            $this->status = 'completed';
        } else {
            $this->status = 'active';
        }
        
        $this->save();
    }
}
