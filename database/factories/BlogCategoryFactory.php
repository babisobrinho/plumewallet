<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Finanças Pessoais',
            'Dicas de Economia',
            'Investimentos',
            'Orçamento Familiar',
            'Educação Financeira',
            'Tecnologia',
            'Produtividade',
            'Lifestyle',
            'Carreira',
            'Empreendedorismo'
        ];

        return [
            'name' => $this->faker->randomElement($categories),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(2),
            'is_active' => $this->faker->boolean(90), // 90% chance de estar ativo
            'meta_title' => $this->faker->sentence(3),
            'meta_description' => $this->faker->paragraph(1),
            'created_by' => 1, // Assumindo que o usuário ID 1 existe
            'updated_by' => 1,
        ];
    }
}