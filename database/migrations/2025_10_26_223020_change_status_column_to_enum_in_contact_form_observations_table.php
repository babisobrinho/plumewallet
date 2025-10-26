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
        // First, update any existing string values to match enum values
        DB::table('contact_form_observations')
            ->whereNotNull('status')
            ->update(['status' => DB::raw("CASE 
                WHEN status = 'new' THEN 'new'
                WHEN status = 'in_progress' THEN 'in_progress'
                WHEN status = 'waiting_response' THEN 'waiting_response'
                WHEN status = 'resolved' THEN 'resolved'
                WHEN status = 'closed' THEN 'closed'
                ELSE NULL
            END")]);

        // Change the column to enum
        DB::statement("ALTER TABLE contact_form_observations MODIFY COLUMN `status` ENUM('new', 'in_progress', 'waiting_response', 'resolved', 'closed') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Change back to string
        Schema::table('contact_form_observations', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
        });
    }
};