<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Enums\PostCategory;
use App\Models\User;
use App\Enums\PostStatus;
use Illuminate\Console\Command;

class GenerateBlogTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:generate-test-data {--count=20 : Number of posts to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate additional test blog posts for development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->option('count');
        
        $this->info("📝 Generating {$count} additional blog posts...");

        $categories = PostCategory::cases();
        $users = User::all();

        if (empty($categories)) {
            $this->error('No post categories found. Please run the blog seeders first.');
            return 1;
        }

        if ($users->isEmpty()) {
            $this->error('No users found. Please run the user seeders first.');
            return 1;
        }

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        for ($i = 0; $i < $count; $i++) {
            $post = Post::factory()
                ->create([
                    'author_id' => $users->random()->id,
                    'category' => $categories[array_rand($categories)],
                ]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("✅ Generated {$count} blog posts successfully!");
        $this->info("📊 Total blog posts: " . Post::count());
        $this->info("📊 Published posts: " . Post::published()->count());
        $this->info("📊 Draft posts: " . Post::draft()->count());
        $this->info("📊 Featured posts: " . Post::featured()->count());

        return 0;
    }
}
