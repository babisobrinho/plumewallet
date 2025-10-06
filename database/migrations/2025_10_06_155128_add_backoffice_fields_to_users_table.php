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
        Schema::table('users', function (Blueprint $table) {
            $table->string('timezone')->default('UTC')->after('email_verified_at');
            $table->string('locale')->default('pt')->after('timezone');
            $table->timestamp('last_login_at')->nullable()->after('locale');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->integer('login_count')->default(0)->after('last_login_ip');
            $table->boolean('is_active')->default(true)->after('login_count');
            $table->timestamp('deactivated_at')->nullable()->after('is_active');
            $table->text('deactivation_reason')->nullable()->after('deactivated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'timezone',
                'locale', 
                'last_login_at',
                'last_login_ip',
                'login_count',
                'is_active',
                'deactivated_at',
                'deactivation_reason'
            ]);
        });
    }
};
