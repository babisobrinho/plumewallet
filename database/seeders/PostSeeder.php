<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('Please run UserSeeder first.');
            return;
        }

        // Create some featured posts
        Post::factory()
            ->count(5)
            ->featured()
            ->published()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create published posts
        Post::factory()
            ->count(25)
            ->published()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some draft posts
        Post::factory()
            ->count(8)
            ->draft()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some archived posts
        Post::factory()
            ->count(5)
            ->archived()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some popular posts with high view counts
        Post::factory()
            ->count(10)
            ->published()
            ->popular()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some technology posts
        Post::factory()
            ->count(8)
            ->technology()
            ->published()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some business posts
        Post::factory()
            ->count(6)
            ->business()
            ->published()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some tutorial posts
        Post::factory()
            ->count(10)
            ->tutorial()
            ->published()
            ->create([
                'author_id' => $users->random()->id,
            ]);

        // Create some random posts
        Post::factory()
            ->count(20)
            ->create([
                'author_id' => $users->random()->id,
            ]);
    }
}