<?php

namespace App\Http\Controllers;

use App\Models\OnboardingTemplate;
use App\Models\UserOnboardingResponse;
use App\Models\Category;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnboardingController extends Controller
{
    /**
     * Mostrar página de boas-vindas do onboarding
     */
    public function show()
    {
        // Verificar se utilizador está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Verificar se utilizador já completou onboarding
        if (auth()->user()->hasCompletedOnboarding()) {
            return redirect()->route('dashboard');
        }
        
        return view('onboarding.welcome');
    }

    /**
     * Mostrar questionário de onboarding
     */
    public function questionnaire()
    {
        // Verificar se utilizador está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->hasCompletedOnboarding()) {
            return redirect()->route('dashboard');
        }
        
        return view('onboarding.questionnaire');
    }

    /**
     * Processar respostas do questionário
     */
    public function processAnswers(Request $request)
    {
        try {
            $answers = $request->validate([
                'organizacao' => 'required|in:A,B,C',
                'situacao' => 'required|in:A,B,C,D,E',
                'objetivo' => 'required|in:A,B,C,D,E',
                'rendimentos' => 'required|in:A,B,C',
                'contas' => 'required|in:A,B,C'
            ]);

            // Debug: Log das respostas
            \Log::info('Onboarding Answers:', $answers);

            // Determinar template recomendado
            $template = OnboardingTemplate::getRecommendedTemplate($answers);
            
            if (!$template) {
                // Fallback para template básico se não encontrar específico
                $template = OnboardingTemplate::active()
                    ->byPersona('professional')
                    ->byDetailLevel('mixed')
                    ->first();
            }

            if (!$template) {
                \Log::error('No template found for onboarding');
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum template encontrado'
                ], 500);
            }

            // Salvar respostas
            $response = auth()->user()->onboardingResponses()->create([
                'answers' => $answers,
                'selected_template' => $template->persona_type ?? 'professional'
            ]);

            return response()->json([
                'success' => true,
                'template' => $template,
                'preview' => $this->generatePreview($template),
                'response_id' => $response->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Onboarding process error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Erro interno: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar preview do template
     */
    public function preview(Request $request)
    {
        $templateId = $request->input('template_id');
        $template = OnboardingTemplate::findOrFail($templateId);
        
        return view('onboarding.preview', compact('template'));
    }

    /**
     * Aplicar template e criar categorias/contas
     */
    public function applyTemplate(Request $request)
    {
        $templateId = $request->input('template_id');
        $template = OnboardingTemplate::findOrFail($templateId);
        
        DB::transaction(function () use ($template) {
            // Criar categorias
            foreach ($template->categories as $categoryData) {
                Category::create([
                    'name' => $categoryData['name'],
                    'type' => $categoryData['type'],
                    'color' => $categoryData['color'],
                    'icon' => $categoryData['icon'],
                    'user_id' => auth()->id()
                ]);
            }

            // Criar contas
            foreach ($template->accounts as $accountData) {
                $accountType = AccountType::where('code', $accountData['account_type_code'])->first();
                
                Account::create([
                    'name' => $accountData['name'],
                    'account_type_id' => $accountType->id,
                    'balance' => $accountData['balance'],
                    'color' => $accountData['color'],
                    'is_active' => true,
                    'is_balance_effective' => $accountData['is_balance_effective'],
                    'user_id' => auth()->id()
                ]);
            }

            // Marcar onboarding como completo
            auth()->user()->update(['onboarding_completed' => true]);
            
            // Marcar resposta como completa
            auth()->user()->onboardingResponses()
                ->latest()
                ->first()
                ->update(['completed' => true]);
        });

        return redirect()->route('dashboard')
            ->with('success', 'Conta configurada com sucesso! Bem-vindo ao Plume Wallet! 🎉');
    }

    /**
     * Configuração mínima rápida
     */
    public function quickSetup()
    {
        DB::transaction(function () {
            // Criar categorias básicas
            Category::create([
                'name' => 'Salário/Rendimentos',
                'type' => 'income',
                'color' => 'bg-green-500',
                'icon' => 'money',
                'user_id' => auth()->id()
            ]);

            Category::create([
                'name' => 'Gastos Gerais',
                'type' => 'expense',
                'color' => 'bg-red-500',
                'icon' => 'shopping-cart',
                'user_id' => auth()->id()
            ]);

            // Criar conta básica
            $cashType = AccountType::where('code', 'cash')->first();
            
            Account::create([
                'name' => 'Carteira Principal',
                'account_type_id' => $cashType->id,
                'balance' => 0.00,
                'color' => 'bg-blue-500',
                'is_active' => true,
                'is_balance_effective' => true,
                'user_id' => auth()->id()
            ]);

            // Marcar onboarding como completo
            auth()->user()->update(['onboarding_completed' => true]);
        });

        return redirect()->route('dashboard')
            ->with('success', 'Configuração básica criada! Pode adicionar mais categorias e contas quando quiser.');
    }

    /**
     * Gerar preview do template
     */
    private function generatePreview($template)
    {
        return [
            'name' => $template->name,
            'description' => $template->description,
            'categories_count' => count($template->categories),
            'accounts_count' => count($template->accounts),
            'categories' => $template->categories,
            'accounts' => $template->accounts
        ];
    }
}
