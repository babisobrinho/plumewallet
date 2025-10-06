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
        Schema::create('security_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('max_login_attempts')->default(5);
            $table->integer('password_expiry_days')->nullable();
            $table->integer('session_timeout_minutes')->default(120);
            $table->boolean('two_factor_required')->default(false);
            $table->json('ip_whitelist')->nullable();
            $table->boolean('brute_force_protection')->default(true);
            $table->integer('failed_login_lockout_minutes')->default(15);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_settings');
    }
};
