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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['payment', 'sms', 'email', 'analytics', 'storage', 'other']);
            $table->text('api_key')->nullable();
            $table->text('api_secret')->nullable();
            $table->string('webhook_url')->nullable();
            $table->boolean('is_active')->default(false);
            $table->json('config')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->enum('status', ['connected', 'disconnected', 'error'])->default('disconnected');
            $table->text('error_message')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
