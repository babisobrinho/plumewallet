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
        Schema::table('faqs', function (Blueprint $table) {
            // Add index for is_active filtering
            $table->index('is_active', 'faqs_active_idx');
            
            // Add index for view_count sorting
            $table->index('view_count', 'faqs_views_idx');
            
            // Add index for created_at sorting
            $table->index('created_at', 'faqs_created_idx');
            
            // Add index for order sorting
            $table->index('order', 'faqs_order_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex('faqs_active_idx');
            $table->dropIndex('faqs_views_idx');
            $table->dropIndex('faqs_created_idx');
            $table->dropIndex('faqs_order_idx');
        });
    }
};