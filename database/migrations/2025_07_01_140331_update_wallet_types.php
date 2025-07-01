<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWalletTypes extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Atualizar os registros existentes para os novos tipos
        DB::table('wallets')->where('type', 'cartao_debito')->update(['type' => 'conta_corrente']);
        DB::table('wallets')->where('type', 'cartao_credito')->update(['type' => 'outros']);

        // Se quiser mapear de forma diferente, ajuste conforme necessário
        // Exemplo alternativo:
        // DB::table('wallets')->where('type', 'cartao_debito')->update(['type' => 'dinheiro']);
        // DB::table('wallets')->where('type', 'cartao_credito')->update(['type' => 'outros']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Reverter as alterações (se necessário)
        DB::table('wallets')->where('type', 'conta_corrente')->where('type', '!=', 'cartao_debito')->update(['type' => 'cartao_debito']);
        DB::table('wallets')->where('type', 'outros')->where('type', '!=', 'cartao_credito')->update(['type' => 'cartao_credito']);
    }
}
