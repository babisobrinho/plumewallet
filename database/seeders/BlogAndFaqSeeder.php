<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogAndFaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting Blog and FAQ seeding...');

        // Seed in the correct order to respect foreign key constraints
        $this->command->info('📂 Creating post categories...');
        $this->call(PostCategorySeeder::class);

        $this->command->info('🏷️ Creating post tags...');
        $this->call(PostTagSeeder::class);

        $this->command->info('📝 Creating blog posts...');
        $this->call(PostSeeder::class);

        $this->command->info('❓ Creating FAQs...');
        $this->call(FaqSeeder::class);

        $this->command->info('✅ Blog and FAQ seeding completed successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Post Categories: ' . \App\Models\PostCategory::count());
        $this->command->info('   - Post Tags: ' . \App\Models\PostTag::count());
        $this->command->info('   - Blog Posts: ' . \App\Models\Post::count());
        $this->command->info('   - FAQs: ' . \App\Models\Faq::count());
    }
}
