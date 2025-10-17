<?php

namespace Database\Factories;

use App\Models\CategoryGroup;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionCategory>
 */
class TransactionCategoryFactory extends Factory
{
    protected $model = TransactionCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => CategoryGroup::factory(),
            'name' => $this->faker->word(),
            'assigned_amount' => $this->faker->randomFloat(2, 0, 5000),
        ];
    }

    /**
     * Set specific category group.
     */
    public function forGroup(CategoryGroup $group): static
    {
        return $this->state(fn (array $attributes) => [
            'group_id' => $group->id,
        ]);
    }

    /**
     * Set assigned amount.
     */
    public function withAssignedAmount(float $amount): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_amount' => $amount,
        ]);
    }

    /**
     * Set no assigned amount.
     */
    public function withoutAssignedAmount(): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_amount' => 0,
        ]);
    }
}
