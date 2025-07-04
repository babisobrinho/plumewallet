<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Criar a tabela account_types primeiro
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome em português
            $table->string('code')->unique(); // Código em inglês
            $table->string('icon');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Popular a tabela account_types com os valores padrão
        DB::table('account_types')->insert([
            ['name' => 'Dinheiro', 'code' => 'cash', 'icon' => 'cash', 'is_active' => true],
            ['name' => 'Conta Corrente', 'code' => 'checking_account', 'icon' => 'building-bank', 'is_active' => true],
            ['name' => 'Poupança', 'code' => 'savings', 'icon' => 'pig-money', 'is_active' => true],
            ['name' => 'Investimentos', 'code' => 'investments', 'icon' => 'trending-up', 'is_active' => true],
            ['name' => 'Cartão Alimentação', 'code' => 'meal_card', 'icon' => 'tools-kitchen-2', 'is_active' => true],
            ['name' => 'Outros', 'code' => 'others', 'icon' => 'wallet', 'is_active' => true],
        ]);

        // 3. Mapeamento dos tipos antigos para os novos codes em inglês
        $typeMapping = [
            'dinheiro' => 'cash',
            'conta_corrente' => 'checking_account',
            'poupanca' => 'savings',
            'investimentos' => 'investments',
            'cartao_alimentacao' => 'meal_card',
            'outros' => 'others'
        ];

        // 4. Adicionar a coluna account_type_id temporariamente nullable
        Schema::table('accounts', function (Blueprint $table) {
            $table->foreignId('account_type_id')->nullable()->after('user_id');
        });

        // 5. Atualizar os account_type_id baseado no mapeamento
        $types = DB::table('account_types')->pluck('id', 'code');

        DB::table('accounts')->orderBy('id')->chunk(100, function ($accounts) use ($types, $typeMapping) {
            foreach ($accounts as $account) {
                $newCode = $typeMapping[$account->type] ?? 'others';
                DB::table('accounts')
                    ->where('id', $account->id)
                    ->update(['account_type_id' => $types[$newCode]]);
            }
        });

        // 6. Tornar a coluna account_type_id não nula e adicionar a FK
        Schema::table('accounts', function (Blueprint $table) {
            $table->foreignId('account_type_id')->nullable(false)->change();
            $table->foreign('account_type_id')->references('id')->on('account_types')->onDelete('cascade');
        });

        // 7. Remover colunas desnecessárias
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['icon', 'type']);
        });
    }


    public function down()
    {
        // Reverter as alterações
        Schema::table('accounts', function (Blueprint $table) {
            $table->enum('type', [
                'dinheiro',
                'conta_corrente',
                'poupanca',
                'investimentos',
                'cartao_alimentacao',
                'outros'
            ])->after('user_id');

            $table->string('icon')->nullable()->after('color');

            $table->dropForeign(['account_type_id']);
            $table->dropColumn('account_type_id');
        });

        Schema::dropIfExists('account_types');
    }
};
