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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a tabela users
            $table->enum('transaction_type', ['income', 'expense', 'transfer']); // Tipo de transação
            $table->foreignId('account_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a tabela accounts
            $table->decimal('amount', 10, 2); // Valor da transação
            $table->string('description'); // Descrição da transação
            $table->date('transaction_date'); // Data da transação
            $table->enum('status', ['pending', 'completed'])->default('completed'); // Status da transação
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Chave estrangeira para a tabela categories (opcional)
            $table->text('obs')->nullable(); // Observações (opcional)
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

