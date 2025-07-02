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
        ['name' => 'Alimentação', 'icon' => 'ti ti-shopping-cart', 'color' => 'blue-500', 'type' => 'expense'],
        ['name' => 'Transporte', 'icon' => 'ti ti-bus', 'color' => 'teal-500', 'type' => 'expense'],
        ['name' => 'Moradia', 'icon' => 'ti ti-home', 'color' => 'blue-600', 'type' => 'expense'],
        ['name' => 'Lazer', 'icon' => 'ti ti-movie', 'color' => 'purple', 'type' => 'expense'],
        ['name' => 'Educação', 'icon' => 'ti ti-school', 'color' => 'blue-700', 'type' => 'expense'],
        ['name' => 'Saúde', 'icon' => 'ti ti-heart', 'color' => 'red-500', 'type' => 'expense'],
        ['name' => 'Salário', 'icon' => 'ti ti-wallet', 'color' => 'teal-600', 'type' => 'income'],
        ['name' => 'Investimentos', 'icon' => 'ti ti-chart-line', 'color' => 'green-500', 'type' => 'income'],
    ];

    // Cores disponíveis para as categorias personalizadas
    protected $availableColors = [
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
        'ti ti-carrot', 'ti ti-apple', 'ti ti-mood-happy', 'ti ti-friends'
    ];

   

    public function index()
{
    $user = Auth::user();

    // Carrega as categorias e suas dependências
    $userCategories = $user->categories()
        ->withSum('transactions', 'amount')
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
        // Passa as categorias padrão, cores e ícones para a view de criação de categoria
        return view('categories.create', [ // Esta é a view para criar CATEGORIAS
            'defaultCategories' => $this->defaultCategories,
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
