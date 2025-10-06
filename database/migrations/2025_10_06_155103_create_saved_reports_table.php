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
        Schema::create('saved_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('template_id')->nullable()->constrained('report_templates')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('filters')->nullable();
            $table->json('data')->nullable();
            $table->enum('format', ['pdf', 'excel', 'csv'])->default('pdf');
            $table->string('file_path')->nullable();
            $table->boolean('is_scheduled')->default(false);
            $table->timestamp('last_generated_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'is_scheduled']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_reports');
    }
};
