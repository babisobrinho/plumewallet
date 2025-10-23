<?php

namespace Database\Seeders;

use App\Models\PostTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'Livewire', 'color' => '#4E56A6'],
            ['name' => 'MySQL', 'color' => '#4479A1'],
            ['name' => 'Git', 'color' => '#F05032'],
            ['name' => 'Docker', 'color' => '#2496ED'],
            ['name' => 'AWS', 'color' => '#FF9900'],
            ['name' => 'Tutorial', 'color' => '#8B5CF6'],
            ['name' => 'Dicas', 'color' => '#10B981'],
            ['name' => 'Notícias', 'color' => '#EF4444'],
            ['name' => 'Desenvolvimento', 'color' => '#3B82F6'],
            ['name' => 'Web Design', 'color' => '#F59E0B'],
        ];

        foreach ($tags as $tag) {
            PostTag::create([
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']),
                'color' => $tag['color'],
                'is_active' => true,
            ]);
        }
    }
}
