<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
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
                'email' => 'exemplo@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Buscar os tipos de conta
        $cashType = AccountType::where('code', 'cash')->first();
        $checkingType = AccountType::where('code', 'checking_account')->first();
        $savingsType = AccountType::where('code', 'savings')->first();
        $investmentsType = AccountType::where('code', 'investments')->first();
        $mealCardType = AccountType::where('code', 'meal_card')->first();
        $othersType = AccountType::where('code', 'others')->first();

        // Criar carteiras de exemplo
        $accounts = [
            [
                'name' => 'Carteira Principal',
                'account_type_id' => $cashType->id,
                'balance' => 150.00,
                'color' => '#13243a',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => $user->id
            ],
            [
                'name' => 'Conta Bancária',
                'account_type_id' => $checkingType->id,
                'balance' => 2500.75,
                'color' => '#0b4c64',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => $user->id
            ],
            [
                'name' => 'Poupança',
                'account_type_id' => $savingsType->id,
                'balance' => 5000.00,
                'color' => '#00675b',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => $user->id
            ],
            [
                'name' => 'Investimentos',
                'account_type_id' => $investmentsType->id,
                'balance' => 3500.00,
                'color' => '#227c7c',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => $user->id
            ],
            [
                'name' => 'Vale Refeição',
                'account_type_id' => $mealCardType->id,
                'balance' => 250.00,
                'color' => '#029b89',
                'is_active' => true,
                'is_balance_effective' => false,
                'user_id' => $user->id
            ],
            [
                'name' => 'Outras Carteiras',
                'account_type_id' => $othersType->id,
                'balance' => 800.50,
                'color' => '#455f76',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => $user->id
            ]
        ];

        foreach ($accounts as $accountData) {
            Account::create($accountData);
        }
    }
}
