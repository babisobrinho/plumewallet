<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->boolean('is_balance_effective')
                ->default(true)
                ->after('is_active')
                ->comment('Determina se o saldo deve ser considerado no total');
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('is_balance_effective');
        });
    }
};
