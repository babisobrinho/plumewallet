<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some predefined categories
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology trends, innovations, and digital transformation insights.',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business strategies, entrepreneurship, and professional development.',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial planning, investment strategies, and money management tips.',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Life tips, wellness, and personal development content.',
                'color' => '#EC4899',
                'is_active' => true,
            ],
            [
                'name' => 'Tutorials',
                'slug' => 'tutorials',
                'description' => 'Step-by-step guides and how-to articles.',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'name' => 'News',
                'slug' => 'news',
                'description' => 'Latest news and updates from the industry.',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'name' => 'Reviews',
                'slug' => 'reviews',
                'description' => 'Product reviews, service evaluations, and recommendations.',
                'color' => '#06B6D4',
                'is_active' => true,
            ],
            [
                'name' => 'Opinion',
                'slug' => 'opinion',
                'description' => 'Editorial content, opinions, and thought leadership.',
                'color' => '#84CC16',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            PostCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Create additional random categories only if we don't have many
        if (PostCategory::count() < 10) {
            try {
                PostCategory::factory()
                    ->count(7)
                    ->create();
            } catch (\Exception $e) {
                // If there are still conflicts, just skip
                $this->command->warn('Some categories could not be created due to conflicts. Continuing...');
            }
        }
    }
}