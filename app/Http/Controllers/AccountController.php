<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Exibir lista de carteiras do utilizador
     */
    public function index(): View
    {
        $accounts = Auth::user()->accounts()->active()->orderBy('created_at', 'desc')->get();
        $totalBalance = Auth::user()->total_balance;

        return view('accounts.index', compact('accounts', 'totalBalance'));
    }

    /**
     * Mostrar formulário para criar nova carteira
     */
    public function create(): View
    {
        $types = Account::getTypes();
        $defaultColors = Account::getDefaultColors();
        $defaultIcons = Account::getDefaultIcons();

        return view('accounts.create', compact('types', 'defaultColors', 'defaultIcons'));
    }

    /**
     * Armazenar nova carteira
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(array_keys(Account::getTypes()))],
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:50'
        ]);

        // Se não foi fornecido ícone, usar o padrão do tipo
        if (empty($validated['icon'])) {
            $defaultIcons = Account::getDefaultIcons();
            $validated['icon'] = $defaultIcons[$validated['type']] ?? 'wallet';
        }

        $validated['user_id'] = Auth::id();

        Account::create($validated);

        return redirect()->route('accounts.index')
            ->with('success', 'Carteira criada com sucesso!');
    }

    /**
     * Exibir detalhes de uma carteira específica
     */
    public function show(Account $account): View
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('view', $account);

        return view('accounts.show', compact('account'));
    }

    /**
     * Mostrar formulário para editar carteira
     */
    public function edit(Account $account): View
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $account);

        $types = Account::getTypes();
        $defaultColors = Account::getDefaultColors();
        $defaultIcons = Account::getDefaultIcons();

        return view('accounts.edit', compact('account', 'types', 'defaultColors', 'defaultIcons'));
    }

    /**
     * Atualizar carteira
     */
    public function update(Request $request, Account $account): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $account);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(array_keys(Account::getTypes()))],
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:50'
        ]);

        // Se não foi fornecido ícone, usar o padrão do tipo
        if (empty($validated['icon'])) {
            $defaultIcons = Account::getDefaultIcons();
            $validated['icon'] = $defaultIcons[$validated['type']] ?? 'wallet';
        }

        $account->update($validated);

        return redirect()->route('accounts.index')
            ->with('success', 'Carteira atualizada com sucesso!');
    }

    /**
     * Remover carteira (soft delete - marcar como inativa)
     */
    public function destroy(Account $account): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('delete', $account);

        $account->update(['is_active' => false]);

        return redirect()->route('accounts.index')
            ->with('success', 'Carteira removida com sucesso!');
    }

    /**
     * API: Obter dados das carteiras para gráficos
     */
    public function apiData(): \Illuminate\Http\JsonResponse
    {
        $accounts = Auth::user()->accounts()->active()->get();

        $data = [
            'labels' => $accounts->pluck('name'),
            'data' => $accounts->pluck('balance'),
            'backgroundColor' => $accounts->pluck('color'),
            'total' => $account->sum('balance')
        ];

        return response()->json($data);
    }

    /**
     * Ativar/Desativar carteira
     */
    public function toggleStatus(Account $account): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $account);

        $account->update(['is_active' => !$account->is_active]);

        $status = $account->is_active ? 'ativada' : 'desativada';

        return redirect()->route('accounts.index')
            ->with('success', "Carteira {$status} com sucesso!");
    }
}
