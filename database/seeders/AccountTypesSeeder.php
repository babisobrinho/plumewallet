<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypesSeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'name' => 'Dinheiro',
                'code' => 'cash',
                'icon' => 'cash',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conta Corrente',
                'code' => 'checking_account',
                'icon' => 'building-bank',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Poupança',
                'code' => 'savings',
                'icon' => 'pig-money',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Investimentos',
                'code' => 'investments',
                'icon' => 'trending-up',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cartão Alimentação',
                'code' => 'meal_card',
                'icon' => 'tools-kitchen-2',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outros',
                'code' => 'others',
                'icon' => 'wallet',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('account_types')->insert($types);
    }
}
