<?php

namespace Database\Seeders;

use App\Models\OnboardingTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OnboardingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            // ESTUDANTE - SIMPLES
            [
                'name' => 'Estudante Simples',
                'persona_type' => 'student',
                'detail_level' => 'simple',
                'description' => 'Template ideal para estudantes que preferem simplicidade',
                'categories' => [
                    ['name' => 'Bolsa/Trabalho', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Apoio Familiar', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'home'],
                    ['name' => 'Educação', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'book'],
                    ['name' => 'Gastos Mensais', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'shopping-cart'],
                    ['name' => 'Lazer', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'smile']
                ],
                'accounts' => [
                    ['name' => 'Carteira Principal', 'account_type_code' => 'cash', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Bancária', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo']
            ],

            // ESTUDANTE - DETALHADO
            [
                'name' => 'Estudante Organizado',
                'persona_type' => 'student',
                'detail_level' => 'detailed',
                'description' => 'Template detalhado para estudantes organizados',
                'categories' => [
                    ['name' => 'Bolsa de Estudos', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'graduation-cap'],
                    ['name' => 'Trabalho Part-time', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'briefcase'],
                    ['name' => 'Apoio Familiar', 'type' => 'income', 'color' => 'bg-green-700', 'icon' => 'home'],
                    ['name' => 'Propinas', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'book'],
                    ['name' => 'Material Escolar', 'type' => 'expense', 'color' => 'bg-blue-600', 'icon' => 'pencil'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Alojamento', 'type' => 'expense', 'color' => 'bg-indigo-500', 'icon' => 'home'],
                    ['name' => 'Entretenimento', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'smile'],
                    ['name' => 'Saúde', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'heart']
                ],
                'accounts' => [
                    ['name' => 'Carteira Principal', 'account_type_code' => 'cash', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Bancária', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true],
                    ['name' => 'Poupança', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-emerald-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo', 'rendimentos']
            ],

            // PROFISSIONAL - SIMPLES
            [
                'name' => 'Profissional Simples',
                'persona_type' => 'professional',
                'detail_level' => 'simple',
                'description' => 'Template simples para profissionais',
                'categories' => [
                    ['name' => 'Salário', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Contas Fixas', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'home'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Outros Gastos', 'type' => 'expense', 'color' => 'bg-gray-500', 'icon' => 'shopping-cart']
                ],
                'accounts' => [
                    ['name' => 'Conta Corrente', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Carteira', 'account_type_code' => 'cash', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo']
            ],

            // PROFISSIONAL - DETALHADO
            [
                'name' => 'Profissional Organizado',
                'persona_type' => 'professional',
                'detail_level' => 'detailed',
                'description' => 'Template detalhado para profissionais organizados',
                'categories' => [
                    ['name' => 'Salário', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Prémios/Bónus', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'gift'],
                    ['name' => 'Outros Rendimentos', 'type' => 'income', 'color' => 'bg-green-700', 'icon' => 'trending-up'],
                    ['name' => 'Habitação', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'home'],
                    ['name' => 'Utilidades', 'type' => 'expense', 'color' => 'bg-blue-600', 'icon' => 'zap'],
                    ['name' => 'Telecomunicações', 'type' => 'expense', 'color' => 'bg-blue-700', 'icon' => 'phone'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Saúde', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'heart'],
                    ['name' => 'Seguros', 'type' => 'expense', 'color' => 'bg-red-600', 'icon' => 'shield'],
                    ['name' => 'Poupanças', 'type' => 'expense', 'color' => 'bg-emerald-500', 'icon' => 'pig-money'],
                    ['name' => 'Entretenimento', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'smile'],
                    ['name' => 'Vestuário', 'type' => 'expense', 'color' => 'bg-pink-500', 'icon' => 'shirt']
                ],
                'accounts' => [
                    ['name' => 'Conta Corrente', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Poupança', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-emerald-500', 'is_balance_effective' => true],
                    ['name' => 'Carteira', 'account_type_code' => 'cash', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo', 'rendimentos', 'contas']
            ],

            // PESSOA ENDIVIDADA - SIMPLES
            [
                'name' => 'Foco em Dívidas Simples',
                'persona_type' => 'debt_focused',
                'detail_level' => 'simple',
                'description' => 'Template simples para quem quer pagar dívidas',
                'categories' => [
                    ['name' => 'Salário', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Pagamento de Dívidas', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'credit-card'],
                    ['name' => 'Gastos Essenciais', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'home'],
                    ['name' => 'Outros', 'type' => 'expense', 'color' => 'bg-gray-500', 'icon' => 'shopping-cart']
                ],
                'accounts' => [
                    ['name' => 'Conta Principal', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Emergência', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-red-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo']
            ],

            // PESSOA ENDIVIDADA - DETALHADO
            [
                'name' => 'Foco em Dívidas Organizado',
                'persona_type' => 'debt_focused',
                'detail_level' => 'detailed',
                'description' => 'Template detalhado para gestão de dívidas',
                'categories' => [
                    ['name' => 'Salário', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Rendimentos Extras', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'trending-up'],
                    ['name' => 'Cartão de Crédito', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'credit-card'],
                    ['name' => 'Empréstimo Pessoal', 'type' => 'expense', 'color' => 'bg-red-600', 'icon' => 'file-text'],
                    ['name' => 'Empréstimo Habitação', 'type' => 'expense', 'color' => 'bg-red-700', 'icon' => 'home'],
                    ['name' => 'Habitação', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'home'],
                    ['name' => 'Utilidades', 'type' => 'expense', 'color' => 'bg-blue-600', 'icon' => 'zap'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Saúde', 'type' => 'expense', 'color' => 'bg-pink-500', 'icon' => 'heart'],
                    ['name' => 'Emergências', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'alert-triangle']
                ],
                'accounts' => [
                    ['name' => 'Conta Principal', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Emergência', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-red-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo', 'rendimentos', 'contas']
            ],

            // FAMÍLIA - SIMPLES
            [
                'name' => 'Família Simples',
                'persona_type' => 'family',
                'detail_level' => 'simple',
                'description' => 'Template simples para famílias',
                'categories' => [
                    ['name' => 'Salário Cônjuge 1', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Salário Cônjuge 2', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'money'],
                    ['name' => 'Contas da Casa', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'home'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Crianças', 'type' => 'expense', 'color' => 'bg-pink-500', 'icon' => 'baby'],
                    ['name' => 'Outros', 'type' => 'expense', 'color' => 'bg-gray-500', 'icon' => 'shopping-cart']
                ],
                'accounts' => [
                    ['name' => 'Conta Conjunta', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Poupança Familiar', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-emerald-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo']
            ],

            // FAMÍLIA - DETALHADO
            [
                'name' => 'Família Organizada',
                'persona_type' => 'family',
                'detail_level' => 'detailed',
                'description' => 'Template detalhado para famílias organizadas',
                'categories' => [
                    ['name' => 'Salário Cônjuge 1', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Salário Cônjuge 2', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'money'],
                    ['name' => 'Outros Rendimentos', 'type' => 'income', 'color' => 'bg-green-700', 'icon' => 'trending-up'],
                    ['name' => 'Habitação', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'home'],
                    ['name' => 'Utilidades', 'type' => 'expense', 'color' => 'bg-blue-600', 'icon' => 'zap'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Educação (crianças)', 'type' => 'expense', 'color' => 'bg-indigo-500', 'icon' => 'book'],
                    ['name' => 'Saúde', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'heart'],
                    ['name' => 'Seguros', 'type' => 'expense', 'color' => 'bg-red-600', 'icon' => 'shield'],
                    ['name' => 'Poupanças', 'type' => 'expense', 'color' => 'bg-emerald-500', 'icon' => 'pig-money'],
                    ['name' => 'Entretenimento Familiar', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'smile'],
                    ['name' => 'Cuidados Infantis', 'type' => 'expense', 'color' => 'bg-pink-500', 'icon' => 'baby']
                ],
                'accounts' => [
                    ['name' => 'Conta Conjunta', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Poupança Familiar', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-emerald-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Emergência', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-red-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo', 'rendimentos', 'contas']
            ],

            // NEGÓCIO - SIMPLES
            [
                'name' => 'Negócio Simples',
                'persona_type' => 'business',
                'detail_level' => 'simple',
                'description' => 'Template simples para profissionais com negócio',
                'categories' => [
                    ['name' => 'Salário Pessoal', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Receitas do Negócio', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'trending-up'],
                    ['name' => 'Gastos Pessoais', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'user'],
                    ['name' => 'Gastos do Negócio', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'briefcase'],
                    ['name' => 'Impostos', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'file-text']
                ],
                'accounts' => [
                    ['name' => 'Conta Pessoal', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Empresarial', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo']
            ],

            // NEGÓCIO - DETALHADO
            [
                'name' => 'Negócio Organizado',
                'persona_type' => 'business',
                'detail_level' => 'detailed',
                'description' => 'Template detalhado para gestão de negócio',
                'categories' => [
                    ['name' => 'Salário Pessoal', 'type' => 'income', 'color' => 'bg-green-500', 'icon' => 'money'],
                    ['name' => 'Receitas do Negócio', 'type' => 'income', 'color' => 'bg-green-600', 'icon' => 'trending-up'],
                    ['name' => 'Investimentos', 'type' => 'income', 'color' => 'bg-green-700', 'icon' => 'chart-line'],
                    ['name' => 'Outros Rendimentos', 'type' => 'income', 'color' => 'bg-green-800', 'icon' => 'gift'],
                    ['name' => 'Habitação', 'type' => 'expense', 'color' => 'bg-blue-500', 'icon' => 'home'],
                    ['name' => 'Utilidades', 'type' => 'expense', 'color' => 'bg-blue-600', 'icon' => 'zap'],
                    ['name' => 'Alimentação', 'type' => 'expense', 'color' => 'bg-orange-500', 'icon' => 'utensils'],
                    ['name' => 'Transporte Pessoal', 'type' => 'expense', 'color' => 'bg-yellow-500', 'icon' => 'car'],
                    ['name' => 'Materiais/Fornecimentos', 'type' => 'expense', 'color' => 'bg-purple-500', 'icon' => 'package'],
                    ['name' => 'Marketing', 'type' => 'expense', 'color' => 'bg-purple-600', 'icon' => 'megaphone'],
                    ['name' => 'Transporte Empresarial', 'type' => 'expense', 'color' => 'bg-yellow-600', 'icon' => 'truck'],
                    ['name' => 'Serviços Profissionais', 'type' => 'expense', 'color' => 'bg-indigo-500', 'icon' => 'users'],
                    ['name' => 'Impostos Empresariais', 'type' => 'expense', 'color' => 'bg-red-500', 'icon' => 'file-text']
                ],
                'accounts' => [
                    ['name' => 'Conta Pessoal', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-blue-500', 'is_balance_effective' => true],
                    ['name' => 'Conta Empresarial', 'account_type_code' => 'checking_account', 'balance' => 0, 'color' => 'bg-green-500', 'is_balance_effective' => true],
                    ['name' => 'Poupança', 'account_type_code' => 'savings', 'balance' => 0, 'color' => 'bg-emerald-500', 'is_balance_effective' => true],
                    ['name' => 'Investimentos', 'account_type_code' => 'investments', 'balance' => 0, 'color' => 'bg-purple-500', 'is_balance_effective' => true]
                ],
                'questions' => ['organizacao', 'situacao', 'objetivo', 'rendimentos', 'contas']
            ]
        ];

        foreach ($templates as $templateData) {
            OnboardingTemplate::create($templateData);
        }
    }
}
