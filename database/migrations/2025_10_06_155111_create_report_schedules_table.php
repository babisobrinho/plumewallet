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
        Schema::create('report_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('template_id')->constrained('report_templates')->onDelete('cascade');
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly']);
            $table->integer('day_of_week')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->time('time_of_day');
            $table->json('recipients');
            $table->timestamp('last_run')->nullable();
            $table->timestamp('next_run')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index(['is_active', 'next_run']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_schedules');
    }
};
