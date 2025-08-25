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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nome do budget (ex: "Janeiro 2025")
            $table->date('start_date'); // Data de início do mês
            $table->date('end_date'); // Data de fim do mês
            $table->decimal('total_income', 12, 2)->default(0); // Receita total do mês
            $table->decimal('total_budgeted', 12, 2)->default(0); // Total alocado nos envelopes
            $table->decimal('total_spent', 12, 2)->default(0); // Total gasto
            $table->decimal('total_available', 12, 2)->default(0); // Total disponível
            $table->enum('status', ['active', 'completed', 'archived'])->default('active');
            $table->timestamps();
            
            // Índices para performance
            $table->index(['user_id', 'start_date']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
