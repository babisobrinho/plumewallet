<?php

namespace Database\Factories;

use App\Models\Faq;
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
        $faqs = [
            [
                'question' => 'Como funciona o Plume Wallet?',
                'answer' => 'O Plume Wallet é uma plataforma que permite controlar suas finanças pessoais de forma simples e eficiente. Você pode registrar gastos pelo WhatsApp e acompanhar tudo em um painel elegante e fácil de usar.',
                'category' => 'Geral'
            ],
            [
                'question' => 'É gratuito usar o Plume Wallet?',
                'answer' => 'Sim! O Plume Wallet oferece uma versão gratuita completa para uso pessoal. Oferecemos também planos premium com funcionalidades avançadas para usuários que desejam recursos extras.',
                'category' => 'Preços'
            ],
            [
                'question' => 'Como registro meus gastos pelo WhatsApp?',
                'answer' => 'É muito simples! Após conectar seu WhatsApp ao Plume Wallet, você pode enviar mensagens como "Gastei 25€ no supermercado" e nossa inteligência artificial reconhece automaticamente o valor e a categoria.',
                'category' => 'Como Usar'
            ],
            [
                'question' => 'Meus dados estão seguros?',
                'answer' => 'Absolutamente! Utilizamos criptografia de ponta a ponta e seguimos rigorosamente a LGPD. Seus dados nunca são compartilhados com terceiros e são armazenados em servidores seguros.',
                'category' => 'Segurança'
            ],
            [
                'question' => 'Posso usar o Plume Wallet no meu celular?',
                'answer' => 'Sim! O Plume Wallet é totalmente responsivo e funciona perfeitamente em smartphones, tablets e computadores. Você pode acessar de qualquer dispositivo com internet.',
                'category' => 'Dispositivos'
            ],
            [
                'question' => 'Como cancelo minha conta?',
                'answer' => 'Para cancelar sua conta, entre em contato conosco através da página de contato ou envie um email para plume.wal@gmail.com. Processaremos sua solicitação em até 48 horas.',
                'category' => 'Conta'
            ],
            [
                'question' => 'Posso exportar meus dados?',
                'answer' => 'Sim! Você pode exportar todos os seus dados financeiros em formato CSV ou PDF através do painel de controle. Isso inclui todas as transações, relatórios e análises.',
                'category' => 'Dados'
            ],
            [
                'question' => 'O Plume Wallet funciona offline?',
                'answer' => 'O registro pelo WhatsApp funciona mesmo com conexão limitada, mas para visualizar o painel e relatórios você precisa de conexão com a internet. Os dados são sincronizados automaticamente quando a conexão é restabelecida.',
                'category' => 'Conectividade'
            ],
            [
                'question' => 'Como funciona a categorização automática?',
                'answer' => 'Nossa inteligência artificial analisa suas mensagens e identifica automaticamente valores, categorias e tipos de transação. O sistema aprende com seus padrões de gastos para melhorar a precisão ao longo do tempo.',
                'category' => 'Funcionalidades'
            ],
            [
                'question' => 'Posso compartilhar minha conta com familiares?',
                'answer' => 'Sim! O Plume Wallet oferece funcionalidades de compartilhamento que permitem que membros da família visualizem e gerenciem as finanças em conjunto, mantendo a privacidade individual quando necessário.',
                'category' => 'Compartilhamento'
            ],
            [
                'question' => 'Como recebo suporte técnico?',
                'answer' => 'Oferecemos suporte através de email (plume.wal@gmail.com), chat online e telefone (987 456 890). Nosso horário de atendimento é de segunda a sexta, das 12h às 18h.',
                'category' => 'Suporte'
            ],
            [
                'question' => 'O Plume Wallet integra com bancos?',
                'answer' => 'Atualmente, o Plume Wallet funciona como um sistema de controle manual através do WhatsApp. Estamos trabalhando em integrações bancárias que serão lançadas em breve.',
                'category' => 'Integrações'
            ]
        ];

        $faq = $this->faker->randomElement($faqs);

        return [
            'question' => $faq['question'],
            'answer' => $faq['answer'],
            'category' => $faq['category'],
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(95), // 95% chance de estar ativo
            'views' => $this->faker->numberBetween(0, 500),
            'helpful_yes' => $this->faker->numberBetween(0, 50),
            'helpful_no' => $this->faker->numberBetween(0, 10),
            'created_by' => 1,
            'updated_by' => 1,
        ];
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
     * Create FAQ with specific category.
     */
    public function category(string $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
        ]);
    }
}