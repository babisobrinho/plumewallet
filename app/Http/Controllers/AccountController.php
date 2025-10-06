<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountType;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    use LogsActivity;
    /**
     * Exibir lista de carteiras do utilizador
     */
    public function index(): View
    {
        $accounts = Auth::user()->accounts()
            ->with('accountType') // Carrega o relacionamento
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        $totalBalance = Auth::user()->total_balance;

        return view('accounts.index', compact('accounts', 'totalBalance'));
    }

    /**
     * Mostrar formulário para criar nova carteira
     */
    public function create(): View
    {
        $types = AccountType::active()->pluck('name', 'id'); // Alterado para usar ID como chave
        return view('accounts.create', compact('types'));

    }


    /**
     * Armazenar nova carteira
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'account_type_id' => ['required', 'exists:account_types,id'],
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string',
            'is_balance_effective' => 'required|boolean'
        ]);
// Força a conversão para booleano (extra segurança)
        $isBalanceEffective = (bool)$request->input('is_balance_effective', true);
        try {
            $account = Account::create([
                'user_id' => Auth::id(),
                'account_type_id' => $validated['account_type_id'],
                'name' => $validated['name'],
                'balance' => $validated['balance'],
                'color' => $validated['color'],
                'is_balance_effective' => $validated['is_balance_effective'],
                'is_active' => true
            ]);

            // Log de auditoria
            $this->logAudit('created', $account, null, $account);
            $this->logSystem('info', 'Nova conta criada', [
                'account_id' => $account->id,
                'name' => $account->name,
                'balance' => $account->balance,
                'account_type_id' => $account->account_type_id
            ]);

            return redirect()->route('accounts.index')
                ->with('success', 'Carteira criada com sucesso!');

        } catch (\Exception $e) {
            // Log de erro do sistema
            $this->logSystem('error', 'Erro ao criar conta', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'data' => $validated
            ]);
            
            return back()->withInput()
                ->with('error', 'Erro ao criar carteira: ' . $e->getMessage());
        }
    }
    /**
     * Exibir detalhes de uma carteira específica
     */
    public function show(Account $account): View
    {
        $this->authorize('view', $account);
        $account->load('accountType'); // Carrega o relacionamento
        return view('accounts.show', compact('account'));
    }

    /**
     * Alternar status do saldo efetivo
     */
    public function toggleBalanceEffective(Account $account): RedirectResponse
    {
        $this->authorize('update', $account);

        $oldValue = $account->is_balance_effective;
        $account->update([
            'is_balance_effective' => !$account->is_balance_effective
        ]);

        // Log de auditoria
        $this->logAudit('updated', $account, ['is_balance_effective' => $oldValue], $account);
        $this->logSystem('info', 'Status do saldo efetivo alterado', [
            'account_id' => $account->id,
            'old_value' => $oldValue,
            'new_value' => $account->is_balance_effective
        ]);

        return back()->with('success',
            $account->is_balance_effective
                ? 'Saldo marcado como efetivo!'
                : 'Saldo marcado como apenas para marcação!'
        );
    }

    /**
     * Mostrar formulário para editar carteira
     */
    public function edit(Account $account): View
    {
        $this->authorize('update', $account);
        $types = AccountType::active()->pluck('name', 'id'); // Alterado para usar ID como chave
        return view('accounts.edit', compact('account', 'types'));
    }

    /**
     * Atualizar carteira
     */
    public function update(Request $request, Account $account): RedirectResponse
    {
        \Log::debug('Dados recebidos no UPDATE:', $request->all());
        $this->authorize('update', $account);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'account_type_id' => ['required', 'exists:account_types,id'], // Alterado para usar ID
            'balance' => 'required|numeric|min:0|max:999999.99',
            'color' => 'required|string', // Removida a regex
            'is_balance_effective' => 'sometimes|boolean'
        ]);

        try {
            $oldValues = $account->toArray();
            $account->update([
                'name' => $validated['name'],
                'account_type_id' => $validated['account_type_id'],
                'balance' => $validated['balance'],
                'color' => $validated['color'],
                'is_balance_effective' => $validated['is_balance_effective'] ?? $account->is_balance_effective
            ]);

            // Log de auditoria
            $this->logAudit('updated', $account, $oldValues, $account);
            $this->logSystem('info', 'Conta atualizada', [
                'account_id' => $account->id,
                'old_balance' => $oldValues['balance'],
                'new_balance' => $account->balance
            ]);

            return redirect()->route('accounts.index')
                ->with('success', 'Carteira atualizada com sucesso!');
        } catch (\Exception $e) {
            // Log de erro do sistema
            $this->logSystem('error', 'Erro ao atualizar conta', [
                'error' => $e->getMessage(),
                'account_id' => $account->id,
                'data' => $validated
            ]);
            
            return back()->withInput()
                ->with('error', 'Erro ao atualizar carteira: ' . $e->getMessage());
        }
    }
    /**
     * Remover carteira (soft delete - marcar como inativa)
     */
    public function destroy(Account $account): RedirectResponse
    {
        $this->authorize('delete', $account);

        $oldValues = $account->toArray();
        $account->update(['is_active' => false]);

        // Log de auditoria
        $this->logAudit('deleted', $account, $oldValues, $account);
        $this->logSystem('warning', 'Conta desativada', [
            'account_id' => $account->id,
            'name' => $account->name,
            'balance' => $account->balance
        ]);

        return redirect()->route('accounts.index')
            ->with('success', 'Carteira removida com sucesso!');
    }

    /**
     * API: Obter dados das carteiras para gráficos
     */
    public function apiData(): \Illuminate\Http\JsonResponse
    {
        $accounts = Auth::user()->accounts()
            ->with('accountType')
            ->active()
            ->get();

        $data = [
            'labels' => $accounts->pluck('name'),
            'data' => $accounts->pluck('balance'),
            'backgroundColor' => $accounts->pluck('color'),
            'total' => $accounts->sum('balance')
        ];

        return response()->json($data);
    }

    /**
     * Exibir lista de carteiras desativadas do utilizador
     */
    public function archive(): View
    {
        $accounts = Auth::user()->accounts()
            ->with('accountType') // Carrega o relacionamento
            ->where('is_active', false) // Busca apenas carteiras inativas
            ->orderBy('updated_at', 'desc') // Ordena pela data de desativação
            ->get();

        return view('accounts.archive', compact('accounts'));
    }

    /**
     * Ativar/Desativar carteira
     */
    public function toggleStatus(Account $account): RedirectResponse
    {
        $this->authorize('update', $account);

        $wasActive = $account->is_active;
        $oldValues = $account->toArray();
        $account->update(['is_active' => !$account->is_active]);

        // Log de auditoria
        $this->logAudit('updated', $account, $oldValues, $account);
        $this->logSystem('info', 'Status da conta alterado', [
            'account_id' => $account->id,
            'old_status' => $wasActive,
            'new_status' => $account->is_active
        ]);

        $status = $account->is_active ? 'ativada' : 'desativada';

        // Redireciona para a página apropriada baseado no estado anterior
        if ($wasActive) {
            // Se estava ativa e foi desativada, redireciona para a página principal
            return redirect()->route('accounts.index')
                ->with('success', "Carteira {$status} com sucesso!");
        } else {
            // Se estava inativa e foi reativada, pode vir da página de arquivo
            $redirectTo = request()->get('from') === 'archive' ? 'accounts.archive' : 'accounts.index';
            return redirect()->route($redirectTo)
                ->with('success', "Carteira {$status} com sucesso!");
        }
    }
}

