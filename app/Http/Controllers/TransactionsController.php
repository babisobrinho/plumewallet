<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\Transaction; // Importar o modelo Transaction
use App\Models\Account;    // Importar o modelo Account
use App\Models\Category;   // Importar o modelo Category
use Illuminate\Support\Facades\Auth; // Importar para obter o utilizador autenticado

class TransactionsController extends Controller
{
    /**
     * Exibir lista de rendimentos.
     */
    public function incomes(): View
    {
        $userId = Auth::id();

        // Obter as transações de rendimento do utilizador autenticado
        $transactions = Transaction::forUser($userId)
            ->incomes()
            ->with(['account', 'category']) // Carrega os relacionamentos
            ->orderBy('transaction_date', 'desc')
            ->paginate(10); // Paginação

        // Calcular o total de rendimentos completados
        $totalIncomes = Transaction::forUser($userId)
            ->incomes()
            ->withStatus('completed')
            ->sum('amount');

        return view('incomes.index', compact('transactions', 'totalIncomes'));
    }

    /**
     * Exibir lista de despesas.
     */
    public function expenses(): View
    {
        $userId = Auth::id();

        // Obter as transações de despesa do utilizador autenticado
        $transactions = Transaction::forUser($userId)
            ->expenses()
            ->with(['account', 'category']) // Carrega os relacionamentos
            ->orderBy('transaction_date', 'desc')
            ->paginate(10); // Paginação

        // Calcular o total de despesas completadas
        $totalExpenses = Transaction::forUser($userId)
            ->expenses()
            ->withStatus('completed')
            ->sum('amount');

        return view('expenses.index', compact('transactions', 'totalExpenses'));
    }

    /**
     * Mostrar formulário para criar novo rendimento.
     */
    public function createIncome(): View
    {
        $userId = Auth::id();

        // Obter contas do utilizador autenticado
        $accounts = Account::where('user_id', $userId)->pluck('name', 'id');

        // Obter categorias de rendimento do utilizador autenticado
        $categories = Category::where('user_id', $userId)
            ->where('type', 'income')
            ->pluck('name', 'id');

        return view('incomes.create', compact('accounts', 'categories'));
    }

    /**
     * Mostrar formulário para criar nova despesa.
     */
    public function createExpense(): View
    {
        $userId = Auth::id();

        // Obter contas do utilizador autenticado
        $accounts = Account::where('user_id', $userId)->pluck('name', 'id');

        // Obter categorias de despesa do utilizador autenticado
        $categories = Category::where('user_id', $userId)
            ->where('type', 'expense')
            ->pluck('name', 'id');

        return view('expenses.create', compact('accounts', 'categories'));
    }

    /**
     * Armazenar novo rendimento.
     */
    public function storeIncome(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'account_id' => 'required|exists:accounts,id,user_id,' . Auth::id(),
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id() . ',type,income',
            'transaction_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'obs' => 'nullable|string|max:1000',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->transaction_type = 'income';
        $transaction->fill($validatedData);
        $transaction->save();

        // Atualizar o saldo da conta se a transação estiver completada
        if ($transaction->status === 'completed') {
            $account = Account::find($transaction->account_id);
            if ($account && $account->is_balance_effective) {
                $account->balance += $transaction->amount;
                $account->save();
            }
        }

        return redirect()->route('incomes.index')
            ->with('success', 'Rendimento criado com sucesso!');
    }

    /**
     * Armazenar nova despesa.
     */
    public function storeExpense(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'account_id' => 'required|exists:accounts,id,user_id,' . Auth::id(),
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id() . ',type,expense',
            'transaction_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'obs' => 'nullable|string|max:1000',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->transaction_type = 'expense';
        $transaction->fill($validatedData);
        $transaction->save();

        // Atualizar o saldo da conta se a transação estiver completada
        if ($transaction->status === 'completed') {
            $account = Account::find($transaction->account_id);
            if ($account && $account->is_balance_effective) {
                $account->balance -= $transaction->amount; // Subtrai para despesas
                $account->save();
            }
        }

        return redirect()->route('expenses.index')
            ->with('success', 'Despesa criada com sucesso!');
    }

    /**
     * Exibir detalhes de um rendimento específico.
     */
    public function showIncome($id): View
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->incomes()
            ->with(['account', 'category'])
            ->findOrFail($id);

        return view('incomes.show', compact('transaction'));
    }

    /**
     * Exibir detalhes de uma despesa específica.
     */
    public function showExpense($id): View
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->expenses()
            ->with(['account', 'category'])
            ->findOrFail($id);

        return view('expenses.show', compact('transaction'));
    }

    /**
     * Mostrar formulário para editar rendimento.
     */
    public function editIncome($id): View
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->incomes()
            ->findOrFail($id);

        $accounts = Account::where('user_id', $userId)->pluck('name', 'id');
        $categories = Category::where('user_id', $userId)
            ->where('type', 'income')
            ->pluck('name', 'id');

        return view('incomes.edit', compact('transaction', 'accounts', 'categories'));
    }

    /**
     * Mostrar formulário para editar despesa.
     */
    public function editExpense($id): View
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->expenses()
            ->findOrFail($id);

        $accounts = Account::where('user_id', $userId)->pluck('name', 'id');
        $categories = Category::where('user_id', $userId)
            ->where('type', 'expense')
            ->pluck('name', 'id');

        return view('expenses.edit', compact('transaction', 'accounts', 'categories'));
    }

    /**
     * Atualizar rendimento.
     */
    public function updateIncome(Request $request, $id): RedirectResponse
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->incomes()
            ->findOrFail($id);

        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'account_id' => 'required|exists:accounts,id,user_id,' . Auth::id(),
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id() . ',type,income',
            'transaction_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'obs' => 'nullable|string|max:1000',
        ]);

        $oldAmount = $transaction->amount;
        $oldStatus = $transaction->status;
        $oldAccountId = $transaction->account_id;

        $transaction->fill($validatedData);
        $transaction->save();

        $this->adjustAccountBalance($transaction, $oldAmount, $oldStatus, $oldAccountId);

        return redirect()->route('incomes.index')
            ->with('success', 'Rendimento atualizado com sucesso!');
    }

    /**
     * Atualizar despesa.
     */
    public function updateExpense(Request $request, $id): RedirectResponse
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)
            ->expenses()
            ->findOrFail($id);

        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'account_id' => 'required|exists:accounts,id,user_id,' . Auth::id(),
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id() . ',type,expense',
            'transaction_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'obs' => 'nullable|string|max:1000',
        ]);

        $oldAmount = $transaction->amount;
        $oldStatus = $transaction->status;
        $oldAccountId = $transaction->account_id;

        $transaction->fill($validatedData);
        $transaction->save();

        $this->adjustAccountBalance($transaction, $oldAmount, $oldStatus, $oldAccountId);

        return redirect()->route('expenses.index')
            ->with('success', 'Despesa atualizada com sucesso!');
    }

    /**
     * Remover transação.
     */
    public function destroy($id): RedirectResponse
    {
        $userId = Auth::id();
        $transaction = Transaction::forUser($userId)->findOrFail($id);

        $account = Account::find($transaction->account_id);
        if ($account && $account->is_balance_effective && $transaction->status === 'completed') {
            if ($transaction->transaction_type === 'income') {
                $account->balance -= $transaction->amount;
            } elseif ($transaction->transaction_type === 'expense') {
                $account->balance += $transaction->amount;
            }
            $account->save();
        }

        $transaction->delete();

        if ($transaction->transaction_type === 'income') {
            return redirect()->route('incomes.index')
                ->with('success', 'Rendimento removido com sucesso!');
        } else {
            return redirect()->route('expenses.index')
                ->with('success', 'Despesa removida com sucesso!');
        }
    }

    /**
     * Lógica para ajustar o saldo da conta após uma atualização.
     */
    protected function adjustAccountBalance(Transaction $transaction, float $oldAmount, string $oldStatus, int $oldAccountId): void
    {
        $newAmount = $transaction->amount;
        $newStatus = $transaction->status;
        $newAccountId = $transaction->account_id;
        $transactionType = $transaction->transaction_type;

        if ($oldStatus === 'completed') {
            $oldAccount = Account::find($oldAccountId);
            if ($oldAccount && $oldAccount->is_balance_effective) {
                if ($transactionType === 'income') {
                    $oldAccount->balance -= $oldAmount;
                } elseif ($transactionType === 'expense') {
                    $oldAccount->balance += $oldAmount;
                }
                $oldAccount->save();
            }
        }

        if ($newStatus === 'completed') {
            $newAccount = Account::find($newAccountId);
            if ($newAccount && $newAccount->is_balance_effective) {
                if ($transactionType === 'income') {
                    $newAccount->balance += $newAmount;
                } elseif ($transactionType === 'expense') {
                    $newAccount->balance -= $newAmount;
                }
                $newAccount->save();
            }
        }
    }

    /**
     * API: Obter dados das transações para gráficos.
     */
    public function apiData(): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::id();

        $totalIncomes = Transaction::forUser($userId)->incomes()->withStatus('completed')->sum('amount');
        $totalExpenses = Transaction::forUser($userId)->expenses()->withStatus('completed')->sum('amount');
        $balance = $totalIncomes - $totalExpenses;

        $monthlyIncomes = Transaction::forUser($userId)
            ->incomes()
            ->withStatus('completed')
            ->selectRaw('YEAR(transaction_date) as year, MONTH(transaction_date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::createFromDate($item->year, $item->month)->format('Y-m') => $item->total];
            })
            ->toArray();

        $monthlyExpenses = Transaction::forUser($userId)
            ->expenses()
            ->withStatus('completed')
            ->selectRaw('YEAR(transaction_date) as year, MONTH(transaction_date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::createFromDate($item->year, $item->month)->format('Y-m') => $item->total];
            })
            ->toArray();

        $data = [
            'incomes' => $totalIncomes,
            'expenses' => $totalExpenses,
            'balance' => $balance,
            'monthly_data' => [
                'incomes' => $monthlyIncomes,
                'expenses' => $monthlyExpenses
            ]
        ];

        return response()->json($data);
    }

    /**
     * Exibe o histórico de todas as transações com saldo progressivo
     */
    public function history()
    {
        $user = Auth::user();
        
        // Busca todas as transações do usuário ordenadas por data (mais recente primeiro)
        $transactions = $user->transactions()
            ->with(['category', 'account'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calcula o saldo total atual das contas
        $totalBalance = $user->total_balance;
        
        // Calcula o saldo progressivo baseado no saldo atual da carteira
        $currentWalletBalance = $user->total_balance;
        $transactionsWithBalance = collect();
        
        // Inverte a ordem para calcular o saldo progressivo do mais antigo para o mais recente
        $sortedTransactions = $transactions->sortBy([
            ['transaction_date', 'asc'],
            ['created_at', 'asc']
        ]);
        
        // Calcula o saldo total das transações para fazer o ajuste
        $totalTransactionsAmount = $transactions->sum('amount');
        
        // Inicia o saldo progressivo a partir do saldo atual da carteira
        $runningBalance = $currentWalletBalance;
        
        foreach ($sortedTransactions->reverse() as $transaction) {
            $transactionsWithBalance->push([
                'transaction' => $transaction,
                'running_balance' => $runningBalance
            ]);
            // Subtrai o valor da transação para mostrar o saldo anterior
            $runningBalance -= $transaction->amount;
        }
        
        // Reverte para mostrar do mais recente para o mais antigo
        $transactionsWithBalance = $transactionsWithBalance->reverse();
        
        // Agrupa por data para melhor visualização
        $groupedTransactions = $transactionsWithBalance->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item['transaction']->transaction_date)->format('d/m/Y');
        });

        return view('transactions.history', [
            'groupedTransactions' => $groupedTransactions,
            'totalBalance' => $totalBalance,
            'totalTransactions' => $transactions->count(),
            'totalIncomes' => $transactions->where('transaction_type', 'income')->sum('amount'),
            'totalExpenses' => $transactions->where('transaction_type', 'expense')->sum('amount')
        ]);
    }
}
