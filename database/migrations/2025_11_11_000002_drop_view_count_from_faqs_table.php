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
        if (Schema::hasColumn('faqs', 'view_count')) {
            Schema::table('faqs', function (Blueprint $table) {
                // drop index if exists
                if (Schema::hasColumn('faqs', 'view_count')) {
                    // Some DB drivers require explicit index drop
                    try {
                        $table->dropIndex('faqs_views_idx');
                    } catch (\Exception $e) {
                        // index may not exist, ignore
                    }

                    $table->dropColumn('view_count');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedInteger('view_count')->default(0)->after('is_active');
            $table->index('view_count', 'faqs_views_idx');
        });
    }
};
