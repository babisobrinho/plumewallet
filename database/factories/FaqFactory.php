<?php

namespace Database\Factories;

use App\Models\Faq;
use App\Enums\FaqCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement(FaqCategory::cases());
        
        return [
            'question' => $this->generateQuestion($category),
            'answer' => $this->generateAnswer($category),
            'category' => $category,
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            // view_count removed from FAQs: no longer tracked
        ];
    }

    /**
     * Generate realistic questions based on category
     */
    private function generateQuestion(FaqCategory $category): string
    {
        $questions = match($category) {
            FaqCategory::GENERAL => [
                'What is this platform about?',
                'How do I get started?',
                'Is this service free?',
                'What are the main features?',
                'How can I contact support?',
                'What browsers are supported?',
                'Is my data secure?',
                'How often is the platform updated?',
            ],
            FaqCategory::ACCOUNT => [
                'How do I create an account?',
                'How do I reset my password?',
                'Can I change my email address?',
                'How do I delete my account?',
                'Why can\'t I log in?',
                'How do I update my profile?',
                'What if I forget my username?',
                'How do I enable two-factor authentication?',
            ],
            FaqCategory::TRANSACTIONS => [
                'How do I add a transaction?',
                'Can I edit past transactions?',
                'How do I categorize transactions?',
                'What if I made a mistake?',
                'How do I export my data?',
                'Can I import transactions?',
                'How do I reconcile accounts?',
                'What are transaction tags?',
            ],
            FaqCategory::SECURITY => [
                'How is my data protected?',
                'What security measures are in place?',
                'Can I trust this platform?',
                'How do I report security issues?',
                'Is my financial data encrypted?',
                'Who has access to my data?',
                'How do I secure my account?',
                'What if I suspect unauthorized access?',
            ],
            FaqCategory::ACCOUNT => [
                'How does billing work?',
                'What payment methods are accepted?',
                'Can I cancel my subscription?',
                'How do I update payment info?',
                'What if payment fails?',
                'How do I get a receipt?',
                'Can I change my plan?',
                'What are the pricing tiers?',
            ],
            FaqCategory::TECHNICAL => [
                'What are the system requirements?',
                'How do I troubleshoot issues?',
                'What if the app crashes?',
                'How do I clear my cache?',
                'Why is the app slow?',
                'How do I update the app?',
                'What if features don\'t work?',
                'How do I report bugs?',
            ],
            FaqCategory::FEATURES => [
                'What features are available?',
                'How do I use the dashboard?',
                'Can I customize the interface?',
                'What are the reporting tools?',
                'How do I set up notifications?',
                'Can I integrate with other apps?',
                'What are the mobile features?',
                'How do I use the search function?',
            ],
            FaqCategory::SUPPORT => [
                'How do I get help?',
                'What support options are available?',
                'How long does support take?',
                'Can I request new features?',
                'How do I provide feedback?',
                'What if I need training?',
                'How do I report problems?',
                'Is there a user community?',
            ],
        };

        return $this->faker->randomElement($questions);
    }

    /**
     * Generate realistic answers based on category
     */
    private function generateAnswer(FaqCategory $category): string
    {
        $baseAnswer = $this->faker->paragraphs(rand(2, 4), true);
        
        // Add some formatting
        $formattedAnswer = '<p>' . $baseAnswer . '</p>';
        
        // Sometimes add a list
        if ($this->faker->boolean(30)) {
            $formattedAnswer .= '<ul>';
            for ($i = 0; $i < rand(2, 5); $i++) {
                $formattedAnswer .= '<li>' . $this->faker->sentence(8) . '</li>';
            }
            $formattedAnswer .= '</ul>';
        }
        
        // Sometimes add another paragraph
        if ($this->faker->boolean(40)) {
            $formattedAnswer .= '<p>' . $this->faker->paragraph(3) . '</p>';
        }
        
        return $formattedAnswer;
    }

    /**
     * Indicate that the FAQ is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the FAQ is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Create FAQ for specific category
     */
    public function forCategory(FaqCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
            'question' => $this->generateQuestion($category),
            'answer' => $this->generateAnswer($category),
        ]);
    }

    /**
     * Create popular FAQ with high view count
     */
    public function popular(): static
    {
        // view_count removed; keep method for API compatibility but do nothing
        return $this->state(fn (array $attributes) => []);
    }
}
