<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\User;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar o primeiro utilizador ou criar um de exemplo
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Utilizador Exemplo',
                'email' => 'exemplo@plumewallet.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Criar carteiras de exemplo com os NOVOS tipos
        $wallets = [
            [
                'name' => 'Carteira Principal',
                'type' => 'dinheiro',
                'balance' => 150.00,
                'color' => '#13243a',
                'icon' => 'cash',
                'is_active' => true
            ],
            [
                'name' => 'Conta Bancária',
                'type' => 'conta_corrente',
                'balance' => 2500.75,
                'color' => '#0b4c64',
                'icon' => 'building-bank',
                'is_active' => true
            ],
            [
                'name' => 'Poupança',
                'type' => 'poupanca',
                'balance' => 5000.00,
                'color' => '#00675b',
                'icon' => 'pig-money',
                'is_active' => true
            ],
            [
                'name' => 'Investimentos',
                'type' => 'investimentos',
                'balance' => 3500.00,
                'color' => '#227c7c',
                'icon' => 'trending-up',
                'is_active' => true
            ],
            [
                'name' => 'Vale Refeição',
                'type' => 'vr_va',
                'balance' => 250.00,
                'color' => '#029b89',
                'icon' => 'tools-kitchen-2',
                'is_active' => true
            ],
            [
                'name' => 'Outras Carteiras',
                'type' => 'outros',
                'balance' => 800.50,
                'color' => '#455f76',
                'icon' => 'wallet',
                'is_active' => true
            ]
        ];

        foreach ($wallets as $walletData) {
            Wallet::create(array_merge($walletData, ['user_id' => $user->id]));
        }
    }
}
