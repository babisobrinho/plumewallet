<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Primeiro alteramos a estrutura da coluna
        Schema::table('accounts', function ($table) {
            $table->string('color', 20)->change(); // Aumenta o tamanho para classes Tailwind
        });

        // Depois convertemos os valores existentes
        $colorMap = [
            '#14b8a6' => 'bg-teal-500',
            '#8b5cf6' => 'bg-violet-500',
            '#84cc16' => 'bg-lime-500',
            '#f97316' => 'bg-orange-500',
            '#ef4444' => 'bg-red-500',
            '#06b6d4' => 'bg-cyan-500',
            '#a855f7' => 'bg-purple-500',
            '#0b4c64' => 'bg-teal-800' // Valor default da sua tabela
        ];

        foreach ($colorMap as $hex => $tailwind) {
            DB::table('accounts')
                ->where('color', $hex)
                ->update(['color' => $tailwind]);
        }
    }

    public function down()
    {
        // Mapeamento reverso
        $reverseColorMap = [
            'bg-teal-500' => '#14b8a6',
            'bg-violet-500' => '#8b5cf6',
            'bg-lime-500' => '#84cc16',
            'bg-orange-500' => '#f97316',
            'bg-red-500' => '#ef4444',
            'bg-cyan-500' => '#06b6d4',
            'bg-purple-500' => '#a855f7',
            'bg-teal-800' => '#0b4c64'
        ];

        foreach ($reverseColorMap as $tailwind => $hex) {
            DB::table('accounts')
                ->where('color', $tailwind)
                ->update(['color' => $hex]);
        }

        // Reverter a alteração da coluna
        Schema::table('accounts', function ($table) {
            $table->string('color', 7)->change(); // Volta ao tamanho original
        });
    }
};
