<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;
use App\Enums\PostStatus;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing categories and tags
        $categories = PostCategory::all();
        $tags = PostTag::all();
        $users = User::all();

        if ($categories->isEmpty() || $tags->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Please run PostCategorySeeder, PostTagSeeder, and UserSeeder first.');
            return;
        }

        // Create some featured posts
        Post::factory()
            ->count(5)
            ->featured()
            ->published()
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(2, 5))->pluck('id')->toArray()
                );
            });

        // Create published posts
        Post::factory()
            ->count(25)
            ->published()
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(1, 4))->pluck('id')->toArray()
                );
            });

        // Create some draft posts
        Post::factory()
            ->count(8)
            ->draft()
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()
                );
            });

        // Create some archived posts
        Post::factory()
            ->count(5)
            ->archived()
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()
                );
            });

        // Create some popular posts with high view counts
        Post::factory()
            ->count(10)
            ->published()
            ->popular()
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(2, 6))->pluck('id')->toArray()
                );
            });

        // Create some random posts
        Post::factory()
            ->count(20)
            ->create([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags
                $post->tags()->attach(
                    $tags->random(rand(1, 4))->pluck('id')->toArray()
                );
            });
    }
}