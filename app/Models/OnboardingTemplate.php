<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'persona_type',
        'detail_level',
        'categories',
        'accounts',
        'questions',
        'description',
        'is_active'
    ];

    protected $casts = [
        'categories' => 'array',
        'accounts' => 'array',
        'questions' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Scope para templates ativos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar por tipo de persona
     */
    public function scopeByPersona($query, $personaType)
    {
        return $query->where('persona_type', $personaType);
    }

    /**
     * Scope para filtrar por nível de detalhe
     */
    public function scopeByDetailLevel($query, $detailLevel)
    {
        return $query->where('detail_level', $detailLevel);
    }

    /**
     * Obter template recomendado baseado nas respostas
     */
    public static function getRecommendedTemplate($answers)
    {
        $persona = $answers['situacao'] ?? 'professional';
        $organizacao = $answers['organizacao'] ?? 'mixed';
        
        // Mapear respostas para tipos
        $personaMap = [
            'A' => 'student',
            'B' => 'professional', 
            'C' => 'business',
            'D' => 'debt_focused',
            'E' => 'family'
        ];
        
        $detailMap = [
            'A' => 'detailed',
            'B' => 'simple',  // Mais ou menos organizado = simples
            'C' => 'simple'
        ];
        
        $personaType = $personaMap[$persona] ?? 'professional';
        $detailLevel = $detailMap[$organizacao] ?? 'mixed';
        
        $template = self::active()
            ->byPersona($personaType)
            ->byDetailLevel($detailLevel)
            ->first();
            
        // Fallback: se não encontrar, usar template básico
        if (!$template) {
            $template = self::active()
                ->byPersona('professional')
                ->byDetailLevel('simple')
                ->first();
        }
        
        return $template;
    }
}
