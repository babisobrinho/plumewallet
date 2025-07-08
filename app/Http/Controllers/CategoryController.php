<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Categorias padrão que o usuário pode escolher ao criar uma nova categoria
    protected $defaultCategories = [
   
    ];

    // Cores disponíveis para as categorias personalizadas
    protected $availableColors = [
        // Cores 500
        'teal-500', 'violet-500', 'lime-500', 'orange-500', 'red-500', 'cyan-500', 'purple-500',
        // Cores 400
        'teal-400', 'violet-400', 'lime-400', 'orange-400', 'red-400', 'cyan-400', 'purple-400',
        // Cores 300
        'teal-300', 'violet-300', 'lime-300', 'orange-300', 'red-300', 'cyan-300', 'purple-300',
        // Cores Neutras
        'white', 'gray-200', 'gray-300', 'gray-400', 'gray-500', 'gray-600', 'gray-700',
        // Especiais
        'black', 'blue-500', 'green-500', 'teal-600',
        // Cores antigas para compatibilidade
        'blue-500', 'blue-600', 'teal-500', 'teal-600',
        'red-500', 'red-600', 'purple', 'cyan', 'yellow-500'
    ];

    // Ícones disponíveis para receitas
    protected $incomeIcons = [
        'ti ti-shopping-cart-dollar', // Vendas
        'ti ti-report-money', // Serviços
        'ti ti-brand-cashapp', // Salário
        'ti ti-basket-dollar', // Freelancer
        'ti ti-brand-tiktok', // Criação de conteúdo
        'ti ti-chalkboard-teacher', // Mentoria
        'ti ti-cash-banknote', // Part-time
        'ti ti-brand-vinted', // Vinted
        'ti ti-user-dollar', // Pensão
        'ti ti-moneybag', // Aposentadoria
        'ti ti-pencil-dollar', // Bolsa de mérito
        'ti ti-cake', // Aniversário
        'ti ti-coin-bitcoin', // Bitcoin
        'ti ti-chart-candle', // Trade
        'ti ti-database-dollar', // Extra
        'ti ti-baby-carriage', // Babá
        'ti ti-brand-youtube', // YouTube
        'ti ti-devices-dollar', // Comissões
        'ti ti-coins', // Moedas
        'ti ti-cash', // Dinheiro
        'ti ti-building-bank', // Banco
        'ti ti-trending-up', // Investimentos
        'ti ti-credit-card', // Cartão de crédito
    ];

    // Ícones disponíveis para despesas
    protected $expenseIcons = [
        'ti ti-burger', // Lanche
        'ti ti-apple', // Frutas
        'ti ti-carrot', // Vegetais
        'ti ti-cake', // Bolo
        'ti ti-coffee', // Café
        'ti ti-glass-full', // Álcool
        'ti ti-shopping-cart', // Supermercado
        'ti ti-shopping-bag', // Compras
        'ti ti-device-gamepad-2', // Jogos
        'ti ti-ball-football', // Esportes
        'ti ti-bowling', // Bowling
        'ti ti-movie', // Cinema
        'ti ti-plane-tilt', // Viagem
        'ti ti-beach', // Férias
        'ti ti-charging-pile', // Carro
        'ti ti-bus', // Transporte
        'ti ti-school', // Educação
        'ti ti-books', // Livros
        'ti ti-backpack', // Mochila
        'ti ti-users-group', // Social
        'ti ti-shoe', // Compras
        'ti ti-shirt', // Roupas
        'ti ti-gift', // Presentes
        'ti ti-brush', // Maquiagem
        'ti ti-headphone', // Eletrônicos
        'ti ti-device-mobile', // Telemóvel
        'ti ti-device-laptop', // Laptop
        'ti ti-camera', // Câmera
        'ti ti-heartbeat', // Saúde
        'ti ti-dental', // Dentista
        'ti ti-stethoscope', // Médico
        'ti ti-pill', // Remédio
        'ti ti-barbell', // Ginásio
        'ti ti-home', // Lar
        'ti ti-buildings', // Condomínio
        'ti ti-armchair', // Móveis
        'ti ti-baby-carriage', // Filhos
        'ti ti-paw', // Pets
        'ti ti-clover', // Loteria
        'ti ti-smoking', // Tabaco
        'ti ti-music', // Música
        'ti ti-empathize', // Doações
        'ti ti-hamburger', // Fast food
        'ti ti-tools-kitchen-2', // Utensílios de cozinha
        'ti ti-perfume', // Perfume
        'ti ti-microscope', // Material escolar
    ];

    public function index()
    {
        $user = Auth::user();

        // Carrega as categorias com suas transações e somatórios
        $userCategories = $user->categories()
            ->withSum('transactions', 'amount')
            ->withCount('transactions')
            ->with(['transactions' => function($query) {
                $query->orderBy('date', 'desc');
            }])
            ->get();

        // Prepara uma coleção para todas as ocorrências das categorias
        $allCategoryOccurrences = collect();

        foreach ($userCategories as $category) {
            // Adiciona a categoria com a data de criação (como Carbon)
            $allCategoryOccurrences->push([
                'category' => $category,
                'date' => $category->created_at,
                'is_creation' => true,
                'transaction_amount' => null
            ]);

            // Adiciona a categoria para cada transação (com a data e valor da transação)
            foreach ($category->transactions as $transaction) {
                $allCategoryOccurrences->push([
                    'category' => $category,
                    'date' => \Carbon\Carbon::parse($transaction->date),
                    'is_creation' => false,
                    'transaction_amount' => $transaction->amount,
                    'transaction' => $transaction
                ]);
            }
        }

        // Remove duplicatas exatas (mesma categoria na mesma data)
        $allCategoryOccurrences = $allCategoryOccurrences->unique(function ($item) {
            return $item['category']->id . '-' . $item['date']->format('Y-m-d');
        });

        // Agrupa as ocorrências pela data formatada
        $groupedCategories = $allCategoryOccurrences->sortByDesc('date')
            ->groupBy(function($item) {
                return $item['date']->format('d M, Y');
            })
            ->map(function($group) {
                return $group->map(function($item) {
                    return [
                        'category' => $item['category'],
                        'is_creation' => $item['is_creation'],
                        'transaction_amount' => $item['transaction_amount'] ?? null,
                        'transaction' => $item['transaction'] ?? null
                    ];
                })->unique('category.id');
            });

        // Calcula o saldo total do usuário
        $balance = $user->transactions()->sum('amount');

        return view('categories.index', [
            'groupedCategories' => $groupedCategories,
            'balance' => $balance
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'availableColors' => $this->availableColors,
            'expenseIcons' => $this->expenseIcons,
            'incomeIcons' => $this->incomeIcons
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,user_id,' . Auth::id(),
            'type' => 'required|in:expense,income',
            'color' => 'required|string|in:' . implode(',', $this->availableColors),
            'icon' => 'required|string|in:' . implode(',', array_merge($this->incomeIcons, $this->expenseIcons))
        ]);

        $category = Auth::user()->categories()->create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        
        return view('categories.edit', [
            'category' => $category,
            'availableColors' => $this->availableColors,
            'expenseIcons' => $this->expenseIcons,
            'incomeIcons' => $this->incomeIcons
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id,user_id,' . Auth::id(),
            'type' => 'required|in:expense,income',
            'color' => 'required|string|in:' . implode(',', $this->availableColors),
            'icon' => 'required|string|in:' . implode(',', array_merge($this->incomeIcons, $this->expenseIcons))
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        if ($category->transactions()->exists()) {
            return back()
                ->with('error', 'Não é possível excluir categoria com transações associadas. Remova as transações primeiro.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria removida com sucesso!');
    }
}