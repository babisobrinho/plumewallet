<?php

namespace Database\Factories;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostTag>
 */
class PostTagFactory extends Factory
{
    protected $model = PostTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue.js',
            'React',
            'Node.js',
            'Database',
            'API',
            'Security',
            'Performance',
            'Tutorial',
            'Tips',
            'Best Practices',
            'Development',
            'Programming',
            'Web Development',
            'Mobile',
            'Design',
            'UI/UX',
            'Testing',
            'DevOps',
            'Cloud',
            'AWS',
            'Docker',
            'Git',
            'Agile',
            'Startup',
            'Business',
            'Marketing',
            'SEO',
            'Analytics',
            'Productivity',
            'Remote Work',
            'Career',
            'Learning',
            'Innovation',
            'Future',
            'Trends',
            'News',
            'Updates'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'color' => $this->faker->randomElement([
                '#3B82F6', // Blue
                '#10B981', // Green
                '#F59E0B', // Yellow
                '#EF4444', // Red
                '#8B5CF6', // Purple
                '#06B6D4', // Cyan
                '#F97316', // Orange
                '#84CC16', // Lime
                '#EC4899', // Pink
                '#6B7280', // Gray
                '#14B8A6', // Teal
                '#A855F7', // Violet
                '#F43F5E', // Rose
                '#0EA5E9', // Sky
                '#22C55E', // Emerald
            ]),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }

    /**
     * Indicate that the tag is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the tag is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
