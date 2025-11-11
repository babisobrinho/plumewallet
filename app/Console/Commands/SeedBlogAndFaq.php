<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedBlogAndFaq extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:blog-faq {--fresh : Clear existing blog and FAQ data first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with blog posts and FAQs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('fresh')) {
            $this->info('🗑️ Clearing existing blog and FAQ data...');
            
            // Clear existing data
            \App\Models\Post::query()->delete();
            \App\Models\Faq::query()->delete();
            
            $this->info('✅ Existing data cleared.');
        }

        $this->info('🌱 Starting blog and FAQ seeding...');
        
        $this->call('db:seed', ['--class' => 'BlogAndFaqSeeder']);
        
        $this->info('🎉 Blog and FAQ seeding completed!');
        $this->info('You can now view the blog posts and FAQs in your application.');
    }
}
