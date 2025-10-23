<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tecnologia',
                'description' => 'Artigos sobre tecnologia e inovação',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Finanças',
                'description' => 'Dicas e informações sobre gestão financeira',
                'color' => '#10B981',
            ],
            [
                'name' => 'Tutoriais',
                'description' => 'Guias passo a passo e tutoriais',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Notícias',
                'description' => 'Últimas notícias e atualizações',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Dicas',
                'description' => 'Dicas úteis e conselhos práticos',
                'color' => '#8B5CF6',
            ],
        ];

        foreach ($categories as $category) {
            PostCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'color' => $category['color'],
                'is_active' => true,
            ]);
        }
    }
}
