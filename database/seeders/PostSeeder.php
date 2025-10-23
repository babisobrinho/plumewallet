<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;
use App\Enums\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user as author
        $author = User::first();
        if (!$author) {
            return;
        }

        // Get categories
        $categories = PostCategory::all();
        $tags = PostTag::all();

        $posts = [
            [
                'title' => 'Introdução ao Laravel Livewire',
                'content' => 'Laravel Livewire é uma biblioteca full-stack para Laravel que torna a construção de interfaces dinâmicas simples, sem escrever JavaScript. Neste artigo, vamos explorar os conceitos básicos e como começar a usar Livewire em seus projetos.',
                'excerpt' => 'Aprenda os conceitos básicos do Laravel Livewire e como criar interfaces dinâmicas sem JavaScript.',
                'meta_title' => 'Introdução ao Laravel Livewire - Guia Completo',
                'meta_description' => 'Descubra como usar Laravel Livewire para criar interfaces dinâmicas sem JavaScript. Guia completo com exemplos práticos.',
                'status' => PostStatus::PUBLISHED,
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'category_name' => 'Tecnologia',
                'tags' => ['Laravel', 'Livewire', 'Tutorial'],
            ],
            [
                'title' => 'Gestão Financeira Pessoal: Dicas Essenciais',
                'content' => 'A gestão financeira pessoal é fundamental para alcançar a estabilidade econômica. Neste artigo, compartilhamos dicas essenciais para organizar suas finanças, criar um orçamento eficiente e alcançar seus objetivos financeiros.',
                'excerpt' => 'Dicas essenciais para melhorar sua gestão financeira pessoal e alcançar a estabilidade econômica.',
                'meta_title' => 'Gestão Financeira Pessoal: Dicas Essenciais',
                'meta_description' => 'Aprenda como organizar suas finanças pessoais com dicas práticas e eficazes para alcançar seus objetivos.',
                'status' => PostStatus::PUBLISHED,
                'published_at' => now()->subDays(3),
                'is_featured' => false,
                'category_name' => 'Finanças',
                'tags' => ['Finanças', 'Dicas', 'Orçamento'],
            ],
            [
                'title' => 'Como Configurar Tailwind CSS no Laravel',
                'content' => 'Tailwind CSS é um framework CSS utilitário que permite criar designs personalizados rapidamente. Neste tutorial, vamos mostrar como configurar e usar Tailwind CSS em um projeto Laravel.',
                'excerpt' => 'Tutorial completo para configurar e usar Tailwind CSS em projetos Laravel.',
                'meta_title' => 'Como Configurar Tailwind CSS no Laravel - Tutorial',
                'meta_description' => 'Aprenda a configurar Tailwind CSS no Laravel com este tutorial passo a passo.',
                'status' => PostStatus::PUBLISHED,
                'published_at' => now()->subDays(1),
                'is_featured' => false,
                'category_name' => 'Tutoriais',
                'tags' => ['Laravel', 'Tailwind CSS', 'Tutorial', 'CSS'],
            ],
            [
                'title' => 'Novidades do PHP 8.3',
                'content' => 'O PHP 8.3 trouxe várias melhorias e novas funcionalidades. Neste artigo, exploramos as principais novidades desta versão e como elas podem beneficiar seus projetos.',
                'excerpt' => 'Descubra as principais novidades e melhorias do PHP 8.3.',
                'meta_title' => 'Novidades do PHP 8.3 - Principais Funcionalidades',
                'meta_description' => 'Conheça as principais novidades e melhorias do PHP 8.3 e como elas podem beneficiar seus projetos.',
                'status' => PostStatus::DRAFT,
                'published_at' => null,
                'is_featured' => false,
                'category_name' => 'Notícias',
                'tags' => ['PHP', 'Notícias', 'Desenvolvimento'],
            ],
        ];

        foreach ($posts as $postData) {
            $category = $categories->where('name', $postData['category_name'])->first();
            
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'content' => $postData['content'],
                'excerpt' => $postData['excerpt'],
                'meta_title' => $postData['meta_title'],
                'meta_description' => $postData['meta_description'],
                'status' => $postData['status'],
                'published_at' => $postData['published_at'],
                'author_id' => $author->id,
                'category_id' => $category?->id,
                'is_featured' => $postData['is_featured'],
                'view_count' => rand(10, 500),
            ]);

            // Attach tags
            foreach ($postData['tags'] as $tagName) {
                $tag = $tags->where('name', $tagName)->first();
                if ($tag) {
                    $post->tags()->attach($tag->id);
                }
            }
        }
    }
}
