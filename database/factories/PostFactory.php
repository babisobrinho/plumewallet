<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement([
            PostCategory::TECHNOLOGY,
            PostCategory::BUSINESS,
            PostCategory::FINANCE,
            PostCategory::PRODUCTIVITY,
            PostCategory::EDUCATION,
        ]);

        $titles = [
            PostCategory::TECHNOLOGY->value => [
                'en' => 'How technology is changing finance',
                'pt' => 'Como a tecnologia está mudando as finanças',
                'fr' => 'Comment la technologie change la finance',
            ],
            PostCategory::BUSINESS->value => [
                'en' => 'Business tips for startups',
                'pt' => 'Dicas de negócios para startups',
                'fr' => 'Conseils d’affaires pour startups',
            ],
            PostCategory::FINANCE->value => [
                'en' => 'Personal finance basics',
                'pt' => 'Noções básicas de finanças pessoais',
                'fr' => 'Bases des finances personnelles',
            ],
            PostCategory::PRODUCTIVITY->value => [
                'en' => 'Productivity hacks for remote work',
                'pt' => 'Dicas de produtividade para trabalho remoto',
                'fr' => 'Astuces de productivité pour le télétravail',
            ],
            PostCategory::EDUCATION->value => [
                'en' => 'Learning finance online',
                'pt' => 'Aprendendo finanças online',
                'fr' => 'Apprendre la finance en ligne',
            ],
        ];

        $contents = [
            PostCategory::TECHNOLOGY->value => [
                'en' => 'Discover how new technologies are transforming the financial world and making transactions easier.',
                'pt' => 'Descubra como novas tecnologias estão transformando o mundo financeiro e facilitando transações.',
                'fr' => 'Découvrez comment les nouvelles technologies transforment le monde financier et facilitent les transactions.',
            ],
            PostCategory::BUSINESS->value => [
                'en' => 'Startups need to focus on innovation and customer experience to succeed in today’s market.',
                'pt' => 'Startups precisam focar em inovação e experiência do cliente para ter sucesso no mercado atual.',
                'fr' => 'Les startups doivent se concentrer sur l’innovation et l’expérience client pour réussir sur le marché actuel.',
            ],
            PostCategory::FINANCE->value => [
                'en' => 'Managing your personal finances is essential for a secure future. Learn the basics here.',
                'pt' => 'Gerenciar suas finanças pessoais é essencial para um futuro seguro. Aprenda o básico aqui.',
                'fr' => 'Gérer ses finances personnelles est essentiel pour un avenir sûr. Apprenez les bases ici.',
            ],
            PostCategory::PRODUCTIVITY->value => [
                'en' => 'Remote work can be productive with the right tools and habits. See our top tips.',
                'pt' => 'O trabalho remoto pode ser produtivo com as ferramentas e hábitos certos. Veja nossas principais dicas.',
                'fr' => 'Le télétravail peut être productif avec les bons outils et habitudes. Découvrez nos meilleurs conseils.',
            ],
            PostCategory::EDUCATION->value => [
                'en' => 'Online courses make learning finance accessible to everyone. Find out how to start.',
                'pt' => 'Cursos online tornam o aprendizado de finanças acessível a todos. Veja como começar.',
                'fr' => 'Les cours en ligne rendent l’apprentissage de la finance accessible à tous. Découvrez comment commencer.',
            ],
        ];

        $lang = app()->getLocale();
        $lang = in_array($lang, ['en', 'pt', 'fr']) ? $lang : 'en';

    // Titles may repeat; ensure slug is unique by appending a short random suffix to the slug only
    $baseTitle = $titles[$category->value][$lang];
    $uniqueSuffix = Str::lower(Str::random(6));
    $title = $baseTitle;
    $content = '<p>' . $contents[$category->value][$lang] . '</p>';

        return [
            'title' => $title,
            'slug' => Str::slug($title . ' ' . $uniqueSuffix),
            'content' => $content,
            'excerpt' => $content,
            'meta_title' => $title,
            'meta_description' => $content,
            'featured_image' => 'images/placeholders/plume-wallet-placeholder.svg',
            'status' => PostStatus::PUBLISHED,
            'published_at' => now(),
            'author_id' => User::factory(),
            'category' => $category,
            'is_featured' => false,
        ];
    }

    /**
     * Generate realistic blog post content
     */
    private function generateRealisticContent(): string
    {
        $paragraphs = [];
        
        // Introduction paragraph
        $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        
        // Main content paragraphs (3-8 paragraphs)
        $paragraphCount = rand(3, 8);
        for ($i = 0; $i < $paragraphCount; $i++) {
            $paragraphs[] = '<p>' . $this->faker->paragraph(6) . '</p>';
        }
        
        // Add some headings
        if ($this->faker->boolean(70)) {
            $paragraphs[] = '<h2>' . $this->faker->sentence(4) . '</h2>';
            $paragraphs[] = '<p>' . $this->faker->paragraph(5) . '</p>';
        }
        
        if ($this->faker->boolean(50)) {
            $paragraphs[] = '<h3>' . $this->faker->sentence(3) . '</h3>';
            $paragraphs[] = '<p>' . $this->faker->paragraph(4) . '</p>';
        }
        
        // Conclusion paragraph
        $paragraphs[] = '<p>' . $this->faker->paragraph(3) . '</p>';
        
        return implode("\n\n", $paragraphs);
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::PUBLISHED,
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the post is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::DRAFT,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the post is archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::ARCHIVED,
            'published_at' => $this->faker->dateTimeBetween('-1 year', '-1 month'),
        ]);
    }

    /**
     * Indicate that the post is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the post has high view count.
     */
    public function popular(): static
    {
        // view_count removed from posts; keep method for API compatibility but do nothing
        return $this->state(fn (array $attributes) => []);
    }

    /**
     * Create a post with a specific category.
     */
    public function withCategory(PostCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
        ]);
    }

    /**
     * Create a post with specific tags.
     */
    public function withTags(array $tags): static
    {
        // tags removed from posts; ignore tags passed
        return $this->state(fn (array $attributes) => []);
    }

    // Métodos específicos removidos pois não são mais necessários para a proposta do projeto
}
