<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the enum to include the new permission group
        DB::statement("ALTER TABLE permissions MODIFY COLUMN `group` ENUM('config', 'users', 'permissions', 'reports', 'statistics', 'qa', 'blog', 'faq', 'logs', 'contact_forms', 'login_attempts') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the contact_forms from the enum
        DB::statement("ALTER TABLE permissions MODIFY COLUMN `group` ENUM('config', 'users', 'permissions', 'reports', 'statistics', 'qa', 'blog', 'faq', 'logs', 'login_attempts') NOT NULL");
    }
};
