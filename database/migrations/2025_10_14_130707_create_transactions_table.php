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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->morphs('transactionable'); // polymorphic column
            $table->date('date');
            $table->foreignId('category_id')->constrained('transaction_categories');
            $table->string('description');
            $table->decimal('amount')->default(0);
            $table->boolean('is_cleared')->default(false);
            $table->boolean('is_reconciled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
