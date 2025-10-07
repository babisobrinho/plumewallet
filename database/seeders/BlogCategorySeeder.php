<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar categorias específicas do Plume Wallet
        $categories = [
            [
                'name' => 'Finanças Pessoais',
                'slug' => 'financas-pessoais',
                'description' => 'Dicas e estratégias para gerenciar suas finanças pessoais de forma eficiente.',
                'is_active' => true,
                'meta_title' => 'Finanças Pessoais - Plume Wallet',
                'meta_description' => 'Aprenda a gerenciar suas finanças pessoais com dicas práticas e eficazes.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Dicas de Economia',
                'slug' => 'dicas-de-economia',
                'description' => 'Estratégias comprovadas para economizar dinheiro e reduzir gastos desnecessários.',
                'is_active' => true,
                'meta_title' => 'Dicas de Economia - Plume Wallet',
                'meta_description' => 'Descubra como economizar dinheiro com dicas práticas e eficazes.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Investimentos',
                'slug' => 'investimentos',
                'description' => 'Guia completo sobre investimentos para iniciantes e investidores experientes.',
                'is_active' => true,
                'meta_title' => 'Investimentos - Plume Wallet',
                'meta_description' => 'Aprenda sobre investimentos e como fazer seu dinheiro trabalhar para você.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Orçamento Familiar',
                'slug' => 'orcamento-familiar',
                'description' => 'Como criar e manter um orçamento familiar eficaz e sustentável.',
                'is_active' => true,
                'meta_title' => 'Orçamento Familiar - Plume Wallet',
                'meta_description' => 'Dicas para criar um orçamento familiar que funciona para toda a família.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Educação Financeira',
                'slug' => 'educacao-financeira',
                'description' => 'Conceitos fundamentais de educação financeira para todas as idades.',
                'is_active' => true,
                'meta_title' => 'Educação Financeira - Plume Wallet',
                'meta_description' => 'Aprenda os conceitos básicos de educação financeira.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Tecnologia',
                'slug' => 'tecnologia',
                'description' => 'Como a tecnologia pode ajudar no controle financeiro pessoal.',
                'is_active' => true,
                'meta_title' => 'Tecnologia Financeira - Plume Wallet',
                'meta_description' => 'Descubra como a tecnologia pode revolucionar seu controle financeiro.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Produtividade',
                'slug' => 'produtividade',
                'description' => 'Dicas para ser mais produtivo e eficiente no gerenciamento financeiro.',
                'is_active' => true,
                'meta_title' => 'Produtividade Financeira - Plume Wallet',
                'meta_description' => 'Aumente sua produtividade no controle das suas finanças.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Como manter um estilo de vida equilibrado sem comprometer as finanças.',
                'is_active' => true,
                'meta_title' => 'Lifestyle Financeiro - Plume Wallet',
                'meta_description' => 'Equilibre seu estilo de vida com suas finanças pessoais.',
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Criar algumas categorias adicionais usando a factory
        BlogCategory::factory(2)->create();
    }
}