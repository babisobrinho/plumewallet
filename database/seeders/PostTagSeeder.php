<?php

namespace Database\Seeders;

use App\Models\PostTag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some predefined tags
        $tags = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'color' => '#FF2D20',
                'is_active' => true,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'color' => '#777BB4',
                'is_active' => true,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'color' => '#F7DF1E',
                'is_active' => true,
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vue-js',
                'color' => '#4FC08D',
                'is_active' => true,
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'color' => '#61DAFB',
                'is_active' => true,
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'color' => '#336791',
                'is_active' => true,
            ],
            [
                'name' => 'API',
                'slug' => 'api',
                'color' => '#FF6B6B',
                'is_active' => true,
            ],
            [
                'name' => 'Security',
                'slug' => 'security',
                'color' => '#FF4757',
                'is_active' => true,
            ],
            [
                'name' => 'Performance',
                'slug' => 'performance',
                'color' => '#2ED573',
                'is_active' => true,
            ],
            [
                'name' => 'Tutorial',
                'slug' => 'tutorial',
                'color' => '#5352ED',
                'is_active' => true,
            ],
            [
                'name' => 'Tips',
                'slug' => 'tips',
                'color' => '#FFA502',
                'is_active' => true,
            ],
            [
                'name' => 'Best Practices',
                'slug' => 'best-practices',
                'color' => '#2F3542',
                'is_active' => true,
            ],
            [
                'name' => 'Development',
                'slug' => 'development',
                'color' => '#3742FA',
                'is_active' => true,
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'color' => '#2F1B69',
                'is_active' => true,
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'color' => '#FF6348',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile',
                'slug' => 'mobile',
                'color' => '#7BED9F',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'color' => '#FF9FF3',
                'is_active' => true,
            ],
            [
                'name' => 'UI/UX',
                'slug' => 'ui-ux',
                'color' => '#54A0FF',
                'is_active' => true,
            ],
            [
                'name' => 'Testing',
                'slug' => 'testing',
                'color' => '#5F27CD',
                'is_active' => true,
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'color' => '#00D2D3',
                'is_active' => true,
            ],
            [
                'name' => 'Cloud',
                'slug' => 'cloud',
                'color' => '#FF9F43',
                'is_active' => true,
            ],
            [
                'name' => 'AWS',
                'slug' => 'aws',
                'color' => '#FF9900',
                'is_active' => true,
            ],
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'color' => '#2496ED',
                'is_active' => true,
            ],
            [
                'name' => 'Git',
                'slug' => 'git',
                'color' => '#F05032',
                'is_active' => true,
            ],
            [
                'name' => 'Agile',
                'slug' => 'agile',
                'color' => '#C44569',
                'is_active' => true,
            ],
        ];

        foreach ($tags as $tag) {
            PostTag::firstOrCreate(
                ['slug' => $tag['slug']],
                $tag
            );
        }

        // Create additional random tags only if we don't have many
        if (PostTag::count() < 30) {
            try {
                PostTag::factory()
                    ->count(15)
                    ->create();
            } catch (\Exception $e) {
                // If there are still conflicts, just skip
                $this->command->warn('Some tags could not be created due to conflicts. Continuing...');
            }
        }
    }
}