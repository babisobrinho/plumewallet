<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
        'data_type',
        'category',
        'is_public',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_public' => 'boolean',
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

    /**
     * Obter valor formatado baseado no tipo
     */
    public function getFormattedValueAttribute()
    {
        return match($this->data_type) {
            'boolean' => (bool) $this->value,
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }

    /**
     * Definir valor baseado no tipo
     */
    public function setFormattedValueAttribute($value)
    {
        $this->value = match($this->data_type) {
            'boolean' => $value ? '1' : '0',
            'integer' => (string) $value,
            'json' => json_encode($value),
            default => (string) $value,
        };
    }
}
