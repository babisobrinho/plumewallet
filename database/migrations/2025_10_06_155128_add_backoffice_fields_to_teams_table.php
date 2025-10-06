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
        Schema::table('teams', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->boolean('is_active')->default(true)->after('description');
            $table->integer('max_members')->nullable()->after('is_active');
            $table->json('settings')->nullable()->after('max_members');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->after('settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn([
                'description',
                'is_active',
                'max_members',
                'settings',
                'created_by'
            ]);
        });
    }
};
