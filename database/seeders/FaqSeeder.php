<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar FAQs específicas do Plume Wallet
        $faqs = [
            [
                'question' => 'Como funciona o Plume Wallet?',
                'answer' => 'O Plume Wallet é uma plataforma que permite controlar suas finanças pessoais de forma simples e eficiente. Você pode registrar gastos pelo WhatsApp e acompanhar tudo em um painel elegante e fácil de usar. Nossa inteligência artificial categoriza automaticamente suas transações, facilitando o controle financeiro.',
                'category' => 'Geral',
                'order' => 1,
                'is_active' => true,
                'views' => 450,
                'helpful_yes' => 38,
                'helpful_no' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'É gratuito usar o Plume Wallet?',
                'answer' => 'Sim! O Plume Wallet oferece uma versão gratuita completa para uso pessoal. Oferecemos também planos premium com funcionalidades avançadas para usuários que desejam recursos extras como relatórios detalhados, integrações bancárias e suporte prioritário.',
                'category' => 'Preços',
                'order' => 2,
                'is_active' => true,
                'views' => 320,
                'helpful_yes' => 28,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Como registro meus gastos pelo WhatsApp?',
                'answer' => 'É muito simples! Após conectar seu WhatsApp ao Plume Wallet, você pode enviar mensagens como "Gastei 25€ no supermercado" e nossa inteligência artificial reconhece automaticamente o valor e a categoria. O sistema aprende com seus padrões para melhorar a precisão ao longo do tempo.',
                'category' => 'Como Usar',
                'order' => 3,
                'is_active' => true,
                'views' => 680,
                'helpful_yes' => 52,
                'helpful_no' => 3,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Meus dados estão seguros?',
                'answer' => 'Absolutamente! Utilizamos criptografia de ponta a ponta e seguimos rigorosamente a LGPD (Lei Geral de Proteção de Dados). Seus dados nunca são compartilhados com terceiros e são armazenados em servidores seguros com certificações internacionais de segurança.',
                'category' => 'Segurança',
                'order' => 4,
                'is_active' => true,
                'views' => 290,
                'helpful_yes' => 25,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Posso usar o Plume Wallet no meu celular?',
                'answer' => 'Sim! O Plume Wallet é totalmente responsivo e funciona perfeitamente em smartphones, tablets e computadores. Você pode acessar de qualquer dispositivo com internet. Além disso, nossa integração com WhatsApp funciona diretamente no seu celular.',
                'category' => 'Dispositivos',
                'order' => 5,
                'is_active' => true,
                'views' => 180,
                'helpful_yes' => 15,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Como cancelo minha conta?',
                'answer' => 'Para cancelar sua conta, entre em contato conosco através da página de contato ou envie um email para plume.wal@gmail.com. Processaremos sua solicitação em até 48 horas e você receberá um email de confirmação. Todos os seus dados serão excluídos conforme nossa política de privacidade.',
                'category' => 'Conta',
                'order' => 6,
                'is_active' => true,
                'views' => 95,
                'helpful_yes' => 8,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Posso exportar meus dados?',
                'answer' => 'Sim! Você pode exportar todos os seus dados financeiros em formato CSV ou PDF através do painel de controle. Isso inclui todas as transações, relatórios e análises. Esta funcionalidade está disponível na seção "Exportar Dados" do seu dashboard.',
                'category' => 'Dados',
                'order' => 7,
                'is_active' => true,
                'views' => 120,
                'helpful_yes' => 12,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'O Plume Wallet funciona offline?',
                'answer' => 'O registro pelo WhatsApp funciona mesmo com conexão limitada, mas para visualizar o painel e relatórios você precisa de conexão com a internet. Os dados são sincronizados automaticamente quando a conexão é restabelecida, garantindo que nada seja perdido.',
                'category' => 'Conectividade',
                'order' => 8,
                'is_active' => true,
                'views' => 75,
                'helpful_yes' => 6,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Como funciona a categorização automática?',
                'answer' => 'Nossa inteligência artificial analisa suas mensagens e identifica automaticamente valores, categorias e tipos de transação. O sistema aprende com seus padrões de gastos para melhorar a precisão ao longo do tempo. Você também pode ajustar categorias manualmente quando necessário.',
                'category' => 'Funcionalidades',
                'order' => 9,
                'is_active' => true,
                'views' => 200,
                'helpful_yes' => 18,
                'helpful_no' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Posso compartilhar minha conta com familiares?',
                'answer' => 'Sim! O Plume Wallet oferece funcionalidades de compartilhamento que permitem que membros da família visualizem e gerenciem as finanças em conjunto, mantendo a privacidade individual quando necessário. Você pode definir diferentes níveis de acesso para cada membro.',
                'category' => 'Compartilhamento',
                'order' => 10,
                'is_active' => true,
                'views' => 150,
                'helpful_yes' => 14,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Como recebo suporte técnico?',
                'answer' => 'Oferecemos suporte através de email (plume.wal@gmail.com), chat online e telefone (987 456 890). Nosso horário de atendimento é de segunda a sexta, das 12h às 18h. Também temos uma seção de FAQ e tutoriais em vídeo disponíveis 24/7.',
                'category' => 'Suporte',
                'order' => 11,
                'is_active' => true,
                'views' => 110,
                'helpful_yes' => 9,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'O Plume Wallet integra com bancos?',
                'answer' => 'Atualmente, o Plume Wallet funciona como um sistema de controle manual através do WhatsApp. Estamos trabalhando em integrações bancárias que serão lançadas em breve. Inscreva-se em nossa newsletter para ser notificado sobre novos recursos.',
                'category' => 'Integrações',
                'order' => 12,
                'is_active' => true,
                'views' => 85,
                'helpful_yes' => 7,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Posso definir metas financeiras?',
                'answer' => 'Sim! O Plume Wallet permite definir metas de economia, gastos mensais e objetivos financeiros. Você pode acompanhar seu progresso através de gráficos e relatórios detalhados, recebendo notificações quando estiver próximo de atingir suas metas.',
                'category' => 'Funcionalidades',
                'order' => 13,
                'is_active' => true,
                'views' => 160,
                'helpful_yes' => 16,
                'helpful_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Como funciona o sistema de relatórios?',
                'answer' => 'Nossos relatórios são gerados automaticamente e incluem análises de gastos por categoria, tendências mensais, comparações entre períodos e insights personalizados. Você pode visualizar relatórios diários, semanais, mensais ou personalizados conforme sua necessidade.',
                'category' => 'Funcionalidades',
                'order' => 14,
                'is_active' => true,
                'views' => 140,
                'helpful_yes' => 13,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'question' => 'Posso usar o Plume Wallet para minha empresa?',
                'answer' => 'Atualmente, o Plume Wallet é focado em finanças pessoais. Estamos desenvolvendo uma versão empresarial que será lançada em breve, com funcionalidades específicas para pequenas e médias empresas.',
                'category' => 'Empresarial',
                'order' => 15,
                'is_active' => true,
                'views' => 65,
                'helpful_yes' => 5,
                'helpful_no' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }

        // Criar algumas FAQs adicionais usando a factory
        Faq::factory(5)->active()->create([
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}