<?php

namespace Database\Factories;

use App\Models\Payee;
use App\Models\Team;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payee>
 */
class PayeeFactory extends Factory
{
    protected $model = Payee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->company(),
            'is_listed' => $this->faker->boolean(90), // 90% chance of being listed
            'category_id' => TransactionCategory::factory(),
        ];
    }

    /**
     * Indicate that the payee is listed.
     */
    public function listed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_listed' => true,
        ]);
    }

    /**
     * Indicate that the payee is unlisted.
     */
    public function unlisted(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_listed' => false,
        ]);
    }

    /**
     * Set specific team for the payee.
     */
    public function forTeam(Team $team): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => $team->id,
        ]);
    }

    /**
     * Set specific category for the payee.
     */
    public function forCategory(TransactionCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $category->id,
        ]);
    }
}
