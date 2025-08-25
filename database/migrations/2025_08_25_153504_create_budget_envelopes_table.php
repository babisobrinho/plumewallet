<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budget_envelopes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('budgeted_amount', 12, 2)->default(0); // Valor alocado no envelope
            $table->decimal('spent_amount', 12, 2)->default(0); // Valor gasto
            $table->decimal('available_amount', 12, 2)->default(0); // Valor disponível
            $table->decimal('rollover_amount', 12, 2)->default(0); // Valor que passa para o próximo mês
            $table->enum('status', ['active', 'overspent', 'completed'])->default('active');
            $table->text('notes')->nullable(); // Notas sobre o envelope
            $table->timestamps();
            
            // Índices para performance
            $table->index(['budget_id', 'category_id']);
            $table->index(['budget_id', 'status']);
            
            // Garantir que cada categoria só aparece uma vez por budget
            $table->unique(['budget_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_envelopes');
    }
};
