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
        Schema::table('contact_form_observations', function (Blueprint $table) {
            $table->renameColumn('status_change', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_form_observations', function (Blueprint $table) {
            $table->renameColumn('status', 'status_change');
        });
    }
};