<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;
use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8));
        $slug = Str::slug($title);
        
        // Generate realistic content
        $content = $this->generateRealisticContent();
        
        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'excerpt' => $this->faker->paragraph(3),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(15),
            'featured_image' => $this->faker->imageUrl(800, 600, 'business', true, 'Blog Post'),
            'status' => $this->faker->randomElement(PostStatus::cases()),
            'published_at' => $this->faker->optional(0.8)->dateTimeBetween('-1 year', 'now'),
            'author_id' => User::factory(),
            'category_id' => PostCategory::factory(),
            'is_featured' => $this->faker->boolean(15), // 15% chance of being featured
            'view_count' => $this->faker->numberBetween(0, 5000),
        ];
    }

    /**
     * Generate realistic blog post content
     */
    private function generateRealisticContent(): string
    {
        $paragraphs = [];
        
        // Introduction paragraph
        $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        
        // Main content paragraphs (3-8 paragraphs)
        $paragraphCount = rand(3, 8);
        for ($i = 0; $i < $paragraphCount; $i++) {
            $paragraphs[] = '<p>' . $this->faker->paragraph(6) . '</p>';
        }
        
        // Add some headings
        if ($this->faker->boolean(70)) {
            $paragraphs[] = '<h2>' . $this->faker->sentence(4) . '</h2>';
            $paragraphs[] = '<p>' . $this->faker->paragraph(5) . '</p>';
        }
        
        if ($this->faker->boolean(50)) {
            $paragraphs[] = '<h3>' . $this->faker->sentence(3) . '</h3>';
            $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        }
        
        // Conclusion paragraph
        $paragraphs[] = '<p>' . $this->faker->paragraph(3) . '</p>';
        
        return implode("\n\n", $paragraphs);
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::PUBLISHED,
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the post is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::DRAFT,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the post is archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::ARCHIVED,
            'published_at' => $this->faker->dateTimeBetween('-1 year', '-1 month'),
        ]);
    }

    /**
     * Indicate that the post is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the post has high view count.
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'view_count' => $this->faker->numberBetween(1000, 10000),
        ]);
    }
}
