<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountTypeFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Dinheiro',
                'Conta Corrente',
                'Poupança',
                'Investimentos',
                'Cartão Alimentação',
                'Outros'
            ]),
            'code' => $this->faker->unique()->randomElement([
                'cash',
                'checking_account',
                'savings',
                'investments',
                'meal_card',
                'others'
            ]),
            'icon' => $this->faker->randomElement([
                'cash',
                'building-bank',
                'pig-money',
                'trending-up',
                'tools-kitchen-2',
                'wallet'
            ]),
            'is_active' => true
        ];
    }
}
