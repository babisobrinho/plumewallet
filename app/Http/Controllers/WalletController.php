<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{
    /**
     * Exibir lista de carteiras do utilizador
     */
    public function index(): View
    {
        $wallets = Auth::user()->wallets()->active()->orderBy('created_at', 'desc')->get();
        $totalBalance = Auth::user()->total_balance;

        return view('wallets.index', compact('wallets', 'totalBalance'));
    }

    /**
     * Mostrar formulário para criar nova carteira
     */
    public function create(): View
    {
        $types = Wallet::getTypes();
        $defaultColors = Wallet::getDefaultColors();
        $defaultIcons = Wallet::getDefaultIcons();

        return view('wallets.create', compact('types', 'defaultColors', 'defaultIcons'));
    }

    /**
     * Armazenar nova carteira
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(array_keys(Wallet::getTypes()))],
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:50'
        ]);

        // Se não foi fornecido ícone, usar o padrão do tipo
        if (empty($validated['icon'])) {
            $defaultIcons = Wallet::getDefaultIcons();
            $validated['icon'] = $defaultIcons[$validated['type']] ?? 'wallet';
        }

        $validated['user_id'] = Auth::id();

        Wallet::create($validated);

        return redirect()->route('wallets.index')
            ->with('success', 'Carteira criada com sucesso!');
    }

    /**
     * Exibir detalhes de uma carteira específica
     */
    public function show(Wallet $wallet): View
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('view', $wallet);

        return view('wallets.show', compact('wallet'));
    }

    /**
     * Mostrar formulário para editar carteira
     */
    public function edit(Wallet $wallet): View
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $wallet);

        $types = Wallet::getTypes();
        $defaultColors = Wallet::getDefaultColors();
        $defaultIcons = Wallet::getDefaultIcons();

        return view('wallets.edit', compact('wallet', 'types', 'defaultColors', 'defaultIcons'));
    }

    /**
     * Atualizar carteira
     */
    public function update(Request $request, Wallet $wallet): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $wallet);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(array_keys(Wallet::getTypes()))],
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:50'
        ]);

        // Se não foi fornecido ícone, usar o padrão do tipo
        if (empty($validated['icon'])) {
            $defaultIcons = Wallet::getDefaultIcons();
            $validated['icon'] = $defaultIcons[$validated['type']] ?? 'wallet';
        }

        $wallet->update($validated);

        return redirect()->route('wallets.index')
            ->with('success', 'Carteira atualizada com sucesso!');
    }

    /**
     * Remover carteira (soft delete - marcar como inativa)
     */
    public function destroy(Wallet $wallet): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('delete', $wallet);

        $wallet->update(['is_active' => false]);

        return redirect()->route('wallets.index')
            ->with('success', 'Carteira removida com sucesso!');
    }

    /**
     * API: Obter dados das carteiras para gráficos
     */
    public function apiData(): \Illuminate\Http\JsonResponse
    {
        $wallets = Auth::user()->wallets()->active()->get();

        $data = [
            'labels' => $wallets->pluck('name'),
            'data' => $wallets->pluck('balance'),
            'backgroundColor' => $wallets->pluck('color'),
            'total' => $wallets->sum('balance')
        ];

        return response()->json($data);
    }

    /**
     * Ativar/Desativar carteira
     */
    public function toggleStatus(Wallet $wallet): RedirectResponse
    {
        // Verificar se a carteira pertence ao utilizador autenticado
        $this->authorize('update', $wallet);

        $wallet->update(['is_active' => !$wallet->is_active]);

        $status = $wallet->is_active ? 'ativada' : 'desativada';

        return redirect()->route('wallets.index')
            ->with('success', "Carteira {$status} com sucesso!");
    }
}
