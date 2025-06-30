<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'balance',
        'color',
        'icon',
        'is_active'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Relação com o utilizador
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tipos de carteira disponíveis
     */
    public static function getTypes(): array
    {
        return [
            'dinheiro' => 'Dinheiro',
            'conta_corrente' => 'Conta Corrente',
            'poupanca' => 'Poupança',
            'cartao_debito' => 'Cartão de Débito',
            'cartao_credito' => 'Cartão de Crédito'
        ];
    }

    /**
     * Ícones padrão para cada tipo
     */
    public static function getDefaultIcons(): array
    {
        return [
            'dinheiro' => 'cash',
            'conta_corrente' => 'building-bank',
            'poupanca' => 'pig-money',
            'cartao_debito' => 'credit-card',
            'cartao_credito' => 'credit-card-pay'
        ];
    }

    /**
     * Cores padrão baseadas no manual de marca
     */
    public static function getDefaultColors(): array
    {
        return [
            '#13243a', // Azul marinho (confiança)
            '#0b4c64', // Azul-petróleo (clareza e inovação)
            '#00675b', // Verde-água (vitalidade)
            '#a37f48', // Dourado (prosperidade)
            '#227c7c', // Verde-água secundário
            '#029b89', // Verde-água claro
            '#455f76', // Azul acinzentado
            '#57823a'  // Verde oliva
        ];
    }

    /**
     * Obter ícone padrão baseado no tipo
     */
    public function getDefaultIcon(): string
    {
        $icons = self::getDefaultIcons();
        return $icons[$this->type] ?? 'wallet';
    }

    /**
     * Formatar saldo para exibição
     */
    public function getFormattedBalanceAttribute(): string
    {
        return number_format($this->balance, 2, ',', '.') . '€';
    }

    /**
     * Scope para carteiras ativas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

