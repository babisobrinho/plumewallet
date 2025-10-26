<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LoginAttemptStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->enum('status', LoginAttemptStatus::values());
            $table->string('failure_reason')->nullable();
            $table->timestamp('attempted_at');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('country', 10)->nullable();
            $table->string('city')->nullable();
            $table->boolean('is_suspicious')->default(false);
            $table->timestamp('blocked_until')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['email']);
            $table->index(['ip_address']);
            $table->index(['status']);
            $table->index(['attempted_at']);
            $table->index(['is_suspicious']);
            $table->index(['blocked_until']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_attempts');
    }
};
