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

    // Ícones disponíveis para as categorias personalizadas
    protected $availableIcons = [
        'ti ti-shopping-cart', 'ti ti-bus', 'ti ti-home', 'ti ti-movie',
        'ti ti-school', 'ti ti-heart', 'ti ti-wallet', 'ti ti-chart-line',
        'ti ti-car', 'ti ti-device-mobile', 'ti ti-run', 'ti ti-gift',
        'ti ti-hamburger', 'ti ti-shirt', 'ti ti-glass', 'ti ti-smoking',
        'ti ti-device-laptop', 'ti ti-plane', 'ti ti-paw', 'ti ti-tools',
        'ti ti-coin', 'ti ti-confetti', 'ti ti-cookie', 'ti ti-baby-carriage',
        'ti ti-carrot', 'ti ti-apple', 'ti ti-mood-happy', 'ti ti-friends',
        // Novos ícones do Tabler
        'ti ti-cash', 'ti ti-building-bank', 'ti ti-download', 'ti ti-pig-money',
        'ti ti-trending-up', 'ti ti-credit-card', 'ti ti-tools-kitchen-2',
        'ti ti-device-gamepad-2', 'ti ti-user-heart', 'ti ti-ball-football',
        'ti ti-users-group', 'ti ti-glass-full', 'ti ti-cpu', 'ti ti-plane-tilt',
        'ti ti-heartbeat', 'ti ti-buildings', 'ti ti-home-heart', 'ti ti-location-heart',
        'ti ti-clover', 'ti ti-arrow-left', 'ti ti-chevron-down', 'ti ti-eye',
        'ti ti-x', 'ti ti-check'
    ];

   

        public function index()
{
    $user = Auth::user();

    // Carrega as categorias e suas dependências
    $userCategories = $user->categories()
        ->withSum('transactions', 'amount') // <-- Isso já soma as transações
        ->withCount('transactions')
        ->with(['transactions' => function($query) {
            $query->latest('date')->limit(1);
        }])
        ->latest('created_at') // Ordena as categorias pela mais recente primeiro
        ->get();

    // Agrupa as categorias pela data de criação (formato 'd M, Y')
    $groupedCategories = $userCategories->groupBy(function($category) {
        return $category->created_at->format('d M, Y');
    });

    // Calcula o saldo total do usuário
    $balance = $user->transactions()->sum('amount');

    return view('categories.index', [
        'groupedCategories' => $groupedCategories, // Passa os grupos para a view
        'balance' => $balance
    ]);
}

    public function create()
{
    return view('categories.create', [
        'availableColors' => $this->availableColors,
        'availableIcons' => $this->availableIcons
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,user_id,' . Auth::id(),
            'type' => 'required|in:expense,income',
            'color' => 'required|string|in:' . implode(',', $this->availableColors),
            'icon' => 'required|string|in:' . implode(',', $this->availableIcons)
        ]);

        $category = Auth::user()->categories()->create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category); // Garante que o usuário pode editar esta categoria
        
        return view('categories.edit', [
            'category' => $category,
            'availableColors' => $this->availableColors,
            'availableIcons' => $this->availableIcons
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category); // Garante que o usuário pode atualizar esta categoria

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id,user_id,' . Auth::id(),
            'type' => 'required|in:expense,income',
            'color' => 'required|string|in:' . implode(',', $this->availableColors),
            'icon' => 'required|string|in:' . implode(',', $this->availableIcons)
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category); // Garante que o usuário pode deletar esta categoria

        // Verifica se existem transações associadas a esta categoria
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

