<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Payee;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isTransfer = $this->faker->boolean(10); // 10% chance of being a transfer

        if ($isTransfer) {
            $transactionable = Account::factory()->create();
            $transactionableType = Account::class;
        } else {
            $transactionable = Payee::factory()->create();
            $transactionableType = Payee::class;
        }

        return [
            'account_id' => Account::factory(),
            'transactionable_id' => $transactionable->id,
            'transactionable_type' => $transactionableType,
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'category_id' => TransactionCategory::factory(),
            'description' => $this->faker->sentence(4),
            'amount' => $this->faker->randomFloat(2, -5000, 5000),
            'is_cleared' => $this->faker->boolean(80), // 80% chance of being cleared
            'is_reconciled' => $this->faker->boolean(60), // 60% chance of being reconciled
        ];
    }

    /**
     * Set specific transactionable (payee or account)
     */
    public function forTransactionable($transactionable): static
    {
        return $this->state(fn (array $attributes) => [
            'transactionable_id' => $transactionable->id,
            'transactionable_type' => get_class($transactionable),
        ]);
    }

    /**
     * Make transaction a payee transaction
     */
    public function payeeTransaction(Payee $payee = null): static
    {
        $payee = $payee ?? Payee::factory()->create();

        return $this->state(fn (array $attributes) => [
            'transactionable_id' => $payee->id,
            'transactionable_type' => Payee::class,
        ]);
    }

    /**
     * Make transaction an account transfer
     */
    public function transferTransaction(Account $account = null): static
    {
        $account = $account ?? Account::factory()->create();

        return $this->state(fn (array $attributes) => [
            'transactionable_id' => $account->id,
            'transactionable_type' => Account::class,
        ]);
    }

    /**
     * Set specific account for the transaction.
     */
    public function forAccount(Account $account): static
    {
        return $this->state(fn (array $attributes) => [
            'account_id' => $account->id,
        ]);
    }

    /**
     * Set specific category for the transaction.
     */
    public function forCategory(TransactionCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $category->id,
        ]);
    }

    /**
     * Set specific date for the transaction.
     */
    public function onDate(\DateTimeInterface $date): static
    {
        return $this->state(fn (array $attributes) => [
            'date' => $date,
        ]);
    }

    /**
     * Set positive amount (income).
     */
    public function income(): static
    {
        return $this->state(fn (array $attributes) => [
            'amount' => $this->faker->randomFloat(2, 1, 5000),
        ]);
    }

    /**
     * Set negative amount (expense).
     */
    public function expense(): static
    {
        return $this->state(fn (array $attributes) => [
            'amount' => $this->faker->randomFloat(2, -5000, -1),
        ]);
    }

    /**
     * Indicate that the transaction is cleared.
     */
    public function cleared(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_cleared' => true,
        ]);
    }

    /**
     * Indicate that the transaction is not cleared.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_cleared' => false,
        ]);
    }

    /**
     * Indicate that the transaction is reconciled.
     */
    public function reconciled(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_reconciled' => true,
        ]);
    }
}
