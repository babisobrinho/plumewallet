<?php

namespace Database\Factories;

use App\Models\CategoryGroup;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryGroup>
 */
class CategoryGroupFactory extends Factory
{
    protected $model = CategoryGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groupNames = ['Essential Expenses', 'Non-Essential Expenses', 'Income', 'Savings & Investments', 'Debt Payments'];

        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->randomElement($groupNames),
            'is_hidden' => $this->faker->boolean(5), // 5% chance of being hidden
        ];
    }

    /**
     * Indicate that the category group is visible.
     */
    public function visible(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_hidden' => false,
        ]);
    }

    /**
     * Indicate that the category group is hidden.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_hidden' => true,
        ]);
    }

    /**
     * Set specific team for the category group.
     */
    public function forTeam(Team $team): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => $team->id,
        ]);
    }
}
