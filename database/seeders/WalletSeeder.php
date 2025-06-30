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

        // Criar carteiras de exemplo
        $wallets = [
            [
                'name' => 'Carteira Principal',
                'type' => 'dinheiro',
                'balance' => 150.00,
                'color' => '#13243a',
                'icon' => 'cash'
            ],
            [
                'name' => 'Conta Millennium',
                'type' => 'conta_corrente',
                'balance' => 2500.75,
                'color' => '#0b4c64',
                'icon' => 'building-bank'
            ],
            [
                'name' => 'Poupança',
                'type' => 'poupanca',
                'balance' => 5000.00,
                'color' => '#00675b',
                'icon' => 'pig-money'
            ],
            [
                'name' => 'Cartão Débito',
                'type' => 'cartao_debito',
                'balance' => 800.50,
                'color' => '#a37f48',
                'icon' => 'credit-card'
            ]
        ];

        foreach ($wallets as $walletData) {
            Wallet::create(array_merge($walletData, ['user_id' => $user->id]));
        }
    }
}

