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
        Schema::create('onboarding_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('persona_type'); // student, professional, business, debt_focused, family
            $table->string('detail_level'); // simple, mixed, detailed
            $table->json('categories'); // categorias padrão
            $table->json('accounts'); // contas sugeridas
            $table->json('questions'); // perguntas específicas do template
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_templates');
    }
};
