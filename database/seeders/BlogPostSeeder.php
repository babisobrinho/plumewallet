<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garantir que temos pelo menos um usuário
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Plume',
                'email' => 'admin@plumewallet.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Garantir que temos categorias
        if (BlogCategory::count() === 0) {
            $this->call(BlogCategorySeeder::class);
        }

        // Criar posts específicos do Plume Wallet
        $posts = [
            [
                'title' => 'Bem-vindo ao Plume Wallet: Sua Jornada Financeira Começa Aqui',
                'slug' => 'bem-vindo-ao-plume-wallet',
                'excerpt' => 'Descubra como o Plume Wallet pode revolucionar sua forma de gerenciar finanças pessoais com simplicidade e eficiência.',
                'content' => $this->generateWelcomeContent(),
                'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'category_id' => BlogCategory::where('slug', 'financas-pessoais')->first()->id,
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => now()->subDays(30),
                'meta_title' => 'Bem-vindo ao Plume Wallet - Controle Financeiro Simplificado',
                'meta_description' => 'Conheça o Plume Wallet e como ele pode transformar sua relação com o dinheiro.',
                'tags' => ['plume wallet', 'finanças', 'controle financeiro'],
                'view_count' => 1250,
                'is_featured' => true,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ],
            [
                'title' => 'Como Registrar Gastos pelo WhatsApp: Guia Completo',
                'slug' => 'como-registrar-gastos-whatsapp',
                'excerpt' => 'Aprenda a usar o WhatsApp para registrar seus gastos de forma rápida e eficiente com o Plume Wallet.',
                'content' => $this->generateWhatsAppContent(),
                'featured_image' => 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'category_id' => BlogCategory::where('slug', 'tecnologia')->first()->id,
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => now()->subDays(25),
                'meta_title' => 'Registrar Gastos pelo WhatsApp - Plume Wallet',
                'meta_description' => 'Guia completo para registrar gastos pelo WhatsApp usando o Plume Wallet.',
                'tags' => ['whatsapp', 'gastos', 'tutorial'],
                'view_count' => 890,
                'is_featured' => true,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ],
            [
                'title' => '5 Dicas Essenciais para Economizar Dinheiro em 2025',
                'slug' => '5-dicas-essenciais-economizar-dinheiro-2025',
                'excerpt' => 'Descubra estratégias comprovadas para economizar dinheiro e alcançar seus objetivos financeiros.',
                'content' => $this->generateEconomyContent(),
                'featured_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'category_id' => BlogCategory::where('slug', 'dicas-de-economia')->first()->id,
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'meta_title' => '5 Dicas para Economizar Dinheiro em 2025',
                'meta_description' => 'Estratégias práticas para economizar dinheiro e melhorar suas finanças pessoais.',
                'tags' => ['economia', 'poupança', 'dicas'],
                'view_count' => 2100,
                'is_featured' => true,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]
        ];

        foreach ($posts as $post) {
            BlogPost::firstOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }

        // Criar posts adicionais usando a factory
        BlogPost::factory(12)->published()->create([
            'author_id' => $user->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
    }

    private function generateWelcomeContent(): string
    {
        return '<p>Bem-vindo ao Plume Wallet, a plataforma que vai revolucionar a forma como você gerencia suas finanças pessoais!</p>

<h2>Por que escolher o Plume Wallet?</h2>

<p>Em um mundo onde o controle financeiro pode parecer complicado e demorado, o Plume Wallet surge como uma solução simples e eficiente. Nossa missão é tornar o gerenciamento de finanças pessoais acessível a todos, independentemente do nível de conhecimento financeiro.</p>

<h3>Principais Benefícios:</h3>
<ul>
<li><strong>Simplicidade:</strong> Registre gastos pelo WhatsApp em segundos</li>
<li><strong>Inteligência Artificial:</strong> Categorização automática de transações</li>
<li><strong>Relatórios Detalhados:</strong> Visualize seus padrões de gastos</li>
<li><strong>Segurança Total:</strong> Seus dados protegidos com criptografia</li>
<li><strong>Interface Intuitiva:</strong> Dashboard elegante e fácil de usar</li>
</ul>

<h2>Como Começar</h2>

<p>Começar a usar o Plume Wallet é extremamente simples:</p>

<ol>
<li>Crie sua conta gratuita</li>
<li>Conecte seu WhatsApp</li>
<li>Comece a registrar seus gastos</li>
<li>Acompanhe tudo no dashboard</li>
</ol>

<p>Em poucos minutos, você terá uma visão completa das suas finanças e poderá tomar decisões mais inteligentes sobre seu dinheiro.</p>

<h2>Junte-se à Comunidade</h2>

<p>Milhares de pessoas já transformaram sua relação com o dinheiro usando o Plume Wallet. Faça parte dessa revolução financeira e descubra como é possível ter controle total sobre suas finanças sem complicação.</p>

<p>Comece hoje mesmo sua jornada rumo à liberdade financeira!</p>';
    }

    private function generateWhatsAppContent(): string
    {
        return '<p>Uma das funcionalidades mais inovadoras do Plume Wallet é a possibilidade de registrar gastos diretamente pelo WhatsApp. Esta funcionalidade torna o controle financeiro extremamente prático e acessível.</p>

<h2>Como Funciona</h2>

<p>O processo é simples e intuitivo:</p>

<ol>
<li>Conecte seu número de WhatsApp ao Plume Wallet</li>
<li>Envie mensagens descrevendo seus gastos</li>
<li>Nossa IA processa automaticamente as informações</li>
<li>Os dados aparecem organizados no seu dashboard</li>
</ol>

<h3>Exemplos de Mensagens</h3>

<p>Você pode enviar mensagens como:</p>
<ul>
<li>"Gastei 25€ no supermercado"</li>
<li>"Paguei 150€ de conta de luz"</li>
<li>"Almoço: 12€"</li>
<li>"Combustível: 45€"</li>
</ul>

<h2>Inteligência Artificial</h2>

<p>Nossa IA é capaz de:</p>
<ul>
<li>Extrair valores automaticamente</li>
<li>Identificar categorias de gastos</li>
<li>Reconhecer padrões</li>
<li>Aprender com seus hábitos</li>
</ul>

<p>Quanto mais você usar, mais precisa a categorização se torna!</p>

<h2>Segurança</h2>

<p>Todas as mensagens são processadas de forma segura e seus dados são protegidos com criptografia de ponta a ponta. Sua privacidade é nossa prioridade.</p>

<p>Experimente hoje mesmo e descubra como é fácil controlar suas finanças pelo WhatsApp!</p>';
    }

    private function generateEconomyContent(): string
    {
        return '<p>Economizar dinheiro não precisa ser um sacrifício. Com as estratégias certas, você pode reduzir gastos significativamente sem comprometer sua qualidade de vida.</p>

<h2>1. Faça um Orçamento Realista</h2>

<p>O primeiro passo para economizar é saber exatamente para onde vai seu dinheiro. Crie um orçamento detalhado incluindo todas as suas receitas e despesas.</p>

<h2>2. Use a Regra 50/30/20</h2>

<p>Esta regra sugere dividir sua renda da seguinte forma:</p>
<ul>
<li>50% para necessidades essenciais</li>
<li>30% para desejos pessoais</li>
<li>20% para poupança e investimentos</li>
</ul>

<h2>3. Elimine Gastos Desnecessários</h2>

<p>Revise suas despesas mensais e identifique:</p>
<ul>
<li>Assinaturas não utilizadas</li>
<li>Serviços duplicados</li>
<li>Gastos por impulso</li>
</ul>

<h2>4. Automatize Suas Poupanças</h2>

<p>Configure transferências automáticas para uma conta de poupança. Assim, você economiza sem nem perceber!</p>

<h2>5. Use Ferramentas de Controle</h2>

<p>Ferramentas como o Plume Wallet ajudam você a:</p>
<ul>
<li>Monitorar gastos em tempo real</li>
<li>Identificar padrões de consumo</li>
<li>Definir metas de economia</li>
<li>Acompanhar seu progresso</li>
</ul>

<h2>Conclusão</h2>

<p>Economizar dinheiro é um hábito que se desenvolve com o tempo. Comece implementando uma estratégia por vez e mantenha-se consistente. Com disciplina e as ferramentas certas, você pode alcançar seus objetivos financeiros!</p>';
    }
}