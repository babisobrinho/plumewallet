<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    /**
     * Define themodel's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Como Organizar Suas Finanças Pessoais em 2025',
            '5 Dicas Essenciais para Economizar Dinheiro',
            'Investimentos para Iniciantes: Por Onde Começar',
            'Planejamento Financeiro para Famílias',
            'Como Criar um Orçamento Eficaz',
            'Entendendo os Juros Compostos',
            'Dicas para Reduzir Gastos Desnecessários',
            'Como Preparar-se para Emergências Financeiras',
            'Investimentos de Baixo Risco para Conservadores',
            'Planejamento de Aposentadoria: Nunca é Cedo Demais',
            'Como Negociar Melhores Condições com Bancos',
            'Finanças Digitais: O Futuro do Dinheiro',
            'Como Ensinar Educação Financeira para Crianças',
            'Dicas para Freelancers Gerenciarem Suas Finanças',
            'Como Avaliar Oportunidades de Investimento'
        ];

        $title = $this->faker->randomElement($titles);
        $slug = \Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->faker->paragraph(3),
            'content' => $this->generateContent(),
            'featured_image' => $this->faker->imageUrl(800, 600, 'business', true, 'Plume Wallet'),
            'category_id' => BlogCategory::factory(),
            'author_id' => User::factory(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->optional(0.8)->dateTimeBetween('-1 year', 'now'),
            'meta_title' => $title,
            'meta_description' => $this->faker->paragraph(1),
            'tags' => $this->faker->words(3, false),
            'view_count' => $this->faker->numberBetween(0, 1000),
            'is_featured' => $this->faker->boolean(20), // 20% chance de ser destaque
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    /**
     * Generate realistic blog content
     */
    private function generateContent(): string
    {
        $paragraphs = [];
        
        // Introduction paragraph
        $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        
        // Main content paragraphs
        for ($i = 0; $i < $this->faker->numberBetween(3, 6); $i++) {
            $paragraphs[] = '<p>' . $this->faker->paragraph(5) . '</p>';
        }
        
        // Add some headings
        $headings = [
            '<h2>Principais Benefícios</h2>',
            '<h2>Como Implementar</h2>',
            '<h2>Dicas Práticas</h2>',
            '<h2>Conclusão</h2>'
        ];
        
        // Insert random headings
        if ($this->faker->boolean(70)) {
            $paragraphs[] = $this->faker->randomElement($headings);
            $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        }
        
        // Add a list
        if ($this->faker->boolean(50)) {
            $paragraphs[] = '<h3>Pontos Importantes:</h3>';
            $paragraphs[] = '<ul>';
            for ($i = 0; $i < $this->faker->numberBetween(3, 7); $i++) {
                $paragraphs[] = '<li>' . $this->faker->sentence() . '</li>';
            }
            $paragraphs[] = '</ul>';
        }
        
        // Conclusion
        $paragraphs[] = '<p>' . $this->faker->paragraph(3) . '</p>';
        
        return implode("\n", $paragraphs);
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the post is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ]);
    }
}