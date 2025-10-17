<?php

namespace Database\Factories;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\CategoryGroup;
use App\Models\Payee;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accountTypes = AccountType::cases();
        $randomType = $this->faker->randomElement($accountTypes);

        return [
            'team_id' => Team::factory(),
            'type' => $randomType->value,
            'name' => $this->faker->word() . ' ' . ucfirst(str_replace('_', ' ', $randomType->value)) . ' Account',
            'balance' => $this->faker->randomFloat(2, -10000, 50000),
            'is_closed' => $this->faker->boolean(10), // 10% chance of being closed
            'reconciled_at' => $this->faker->optional(0.3)->dateTimeBetween('-1 year', 'now'), // 30% chance of having reconciliation date
        ];
    }

    /**
     * Indicate that the account is open.
     */
    public function open(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_closed' => false,
        ]);
    }

    /**
     * Indicate that the account is closed.
     */
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_closed' => true,
        ]);
    }

    /**
     * Indicate that the account has been reconciled.
     */
    public function reconciled(): static
    {
        return $this->state(fn (array $attributes) => [
            'reconciled_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Set specific account type.
     */
    public function type(AccountType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type->value,
            'name' => $this->faker->word() . ' ' . ucfirst(str_replace('_', ' ', $type->value)) . ' Account',
        ]);
    }
}
