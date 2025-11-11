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

        // Cria 10 posts curtos, sem tags e sem view_count, com conteúdo relevante ao projeto
        Post::factory()
            ->count(10)
            ->create([
                'author_id' => $users->random()->id,
            ]);
    }
}