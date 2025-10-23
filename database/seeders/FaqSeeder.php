<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Enums\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // General
            [
                'question' => 'O que é o Plumewallet?',
                'answer' => 'O Plumewallet é uma plataforma de gestão financeira pessoal que permite controlar suas receitas, despesas e investimentos de forma simples e eficiente.',
                'category' => FaqCategory::GENERAL,
                'order' => 1,
            ],
            [
                'question' => 'Como posso começar a usar a plataforma?',
                'answer' => 'Para começar, você precisa criar uma conta gratuita, verificar seu email e configurar suas primeiras contas financeiras. O sistema oferece um tutorial interativo para guiá-lo.',
                'category' => FaqCategory::GENERAL,
                'order' => 2,
            ],

            // Account
            [
                'question' => 'Como posso alterar meus dados pessoais?',
                'answer' => 'Você pode alterar seus dados pessoais acessando o menu "Perfil" e clicando em "Editar Perfil". Lá você pode atualizar nome, email, telefone e outras informações.',
                'category' => FaqCategory::ACCOUNT,
                'order' => 1,
            ],
            [
                'question' => 'Posso ter múltiplas contas na plataforma?',
                'answer' => 'Sim, você pode criar múltiplas contas para diferentes finalidades, como conta pessoal, conta empresarial, etc. Cada conta mantém seus dados separados.',
                'category' => FaqCategory::ACCOUNT,
                'order' => 2,
            ],

            // Transactions
            [
                'question' => 'Como adicionar uma nova transação?',
                'answer' => 'Para adicionar uma transação, vá para a seção "Transações" e clique no botão "Nova Transação". Preencha os dados necessários como valor, descrição, categoria e data.',
                'category' => FaqCategory::TRANSACTIONS,
                'order' => 1,
            ],
            [
                'question' => 'Posso importar transações de um arquivo?',
                'answer' => 'Sim, você pode importar transações através de arquivos CSV ou Excel. Acesse "Transações" > "Importar" e siga as instruções na tela.',
                'category' => FaqCategory::TRANSACTIONS,
                'order' => 2,
            ],

            // Security
            [
                'question' => 'Meus dados estão seguros?',
                'answer' => 'Sim, utilizamos criptografia de ponta a ponta e seguimos as melhores práticas de segurança. Seus dados são armazenados em servidores seguros e nunca são compartilhados com terceiros.',
                'category' => FaqCategory::SECURITY,
                'order' => 1,
            ],
            [
                'question' => 'Como posso ativar a autenticação de dois fatores?',
                'answer' => 'Para ativar a autenticação de dois fatores, vá em "Perfil" > "Segurança" e siga as instruções para configurar um aplicativo autenticador.',
                'category' => FaqCategory::SECURITY,
                'order' => 2,
            ],

            // Billing
            [
                'question' => 'Quais são os planos disponíveis?',
                'answer' => 'Oferecemos um plano gratuito com funcionalidades básicas e planos premium com recursos avançados. Consulte nossa página de preços para mais detalhes.',
                'category' => FaqCategory::BILLING,
                'order' => 1,
            ],
            [
                'question' => 'Como cancelar minha assinatura?',
                'answer' => 'Você pode cancelar sua assinatura a qualquer momento acessando "Perfil" > "Assinatura" > "Cancelar Assinatura". O cancelamento é efetivo no final do período atual.',
                'category' => FaqCategory::BILLING,
                'order' => 2,
            ],

            // Technical
            [
                'question' => 'A plataforma funciona em dispositivos móveis?',
                'answer' => 'Sim, nossa plataforma é totalmente responsiva e funciona perfeitamente em smartphones e tablets através do navegador web.',
                'category' => FaqCategory::TECHNICAL,
                'order' => 1,
            ],
            [
                'question' => 'Quais navegadores são suportados?',
                'answer' => 'Suportamos os principais navegadores modernos: Chrome, Firefox, Safari e Edge. Recomendamos sempre usar a versão mais recente.',
                'category' => FaqCategory::TECHNICAL,
                'order' => 2,
            ],

            // Features
            [
                'question' => 'Posso criar relatórios personalizados?',
                'answer' => 'Sim, você pode criar relatórios personalizados com diferentes filtros e períodos. Acesse "Relatórios" para explorar as opções disponíveis.',
                'category' => FaqCategory::FEATURES,
                'order' => 1,
            ],
            [
                'question' => 'Existe integração com bancos?',
                'answer' => 'Atualmente não oferecemos integração direta com bancos por questões de segurança. Você pode importar extratos manualmente ou usar nossa API.',
                'category' => FaqCategory::FEATURES,
                'order' => 2,
            ],

            // Support
            [
                'question' => 'Como posso entrar em contato com o suporte?',
                'answer' => 'Você pode entrar em contato através do chat online, email de suporte ou formulário de contato. Nossa equipe responde em até 24 horas.',
                'category' => FaqCategory::SUPPORT,
                'order' => 1,
            ],
            [
                'question' => 'Existe documentação da API?',
                'answer' => 'Sim, temos documentação completa da API disponível para desenvolvedores. Acesse nossa seção de desenvolvedores para mais informações.',
                'category' => FaqCategory::SUPPORT,
                'order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'category' => $faq['category'],
                'order' => $faq['order'],
                'is_active' => true,
                'view_count' => rand(5, 100),
            ]);
        }
    }
}
