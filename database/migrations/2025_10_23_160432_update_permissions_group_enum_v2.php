<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PermissionGroup;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the enum values for the group column
        Schema::table('permissions', function (Blueprint $table) {
            $table->enum('group', PermissionGroup::values())->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to previous enum values
        Schema::table('permissions', function (Blueprint $table) {
            $table->enum('group', ['config', 'users', 'permissions', 'reports', 'statistics', 'qa', 'blog', 'faq'])->change();
        });
    }
};
