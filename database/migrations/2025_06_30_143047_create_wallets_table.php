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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['dinheiro', 'conta_corrente', 'poupanca', 'cartao_debito', 'cartao_credito']);
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->string('color', 7)->default('#0b4c64'); // Cor em hexadecimal
            $table->string('icon')->nullable(); // Ícone do Tabler
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};

