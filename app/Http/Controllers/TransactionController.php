<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    use LogsActivity;

    public function create()
    {
        // Obtém todas as categorias do usuário logado para exibir no formulário de transação
        $userCategories = Auth::user()->categories()->get();

        return view('transactions.create', [ // Esta é a view para criar TRANSAÇÕES
            'userCategories' => $userCategories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:expense,income',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Ajusta o valor da transação se for uma despesa
        if ($validated['type'] === 'expense') {
            $validated['amount'] = -$validated['amount'];
        }

        $transaction = $user->transactions()->create($validated);

        // Log de auditoria
        $this->logAudit('created', $transaction, null, $transaction);
        $this->logSystem('info', 'Nova transação criada', [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'type' => $transaction->type,
            'category_id' => $transaction->category_id
        ]);

        return redirect()
            ->route('categories.index') // Redireciona para o índice de categorias após salvar
            ->with('success', 'Transação registrada com sucesso!');
    }

    public function edit(Transaction $transaction) // <-- $transaction é recebido aqui
{
    $this->authorize('update', $transaction); // Garante que o usuário pode editar esta transação

    $userCategories = Auth::user()->categories()->get();

    return view('transactions.edit', [
        'transaction' => $transaction, // <-- $transaction é passado para a view aqui
        'userCategories' => $userCategories
    ]);
}

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction); // Garante que o usuário pode atualizar esta transação

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:expense,income',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        // Ajusta o valor da transação se for uma despesa
        if ($validated['type'] === 'expense') {
            $validated['amount'] = -$validated['amount'];
        }

        $oldValues = $transaction->toArray();
        $transaction->update($validated);

        // Log de auditoria
        $this->logAudit('updated', $transaction, $oldValues, $transaction);
        $this->logSystem('info', 'Transação atualizada', [
            'transaction_id' => $transaction->id,
            'old_amount' => $oldValues['amount'],
            'new_amount' => $transaction->amount
        ]);

        return redirect()
            ->route('categories.index') // Redireciona para o índice de categorias após atualizar
            ->with('success', 'Transação atualizada com sucesso!');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction); // Garante que o usuário pode deletar esta transação

        $oldValues = $transaction->toArray();
        $transaction->delete();

        // Log de auditoria
        $this->logAudit('deleted', $transaction, $oldValues, null);
        $this->logSystem('warning', 'Transação removida', [
            'transaction_id' => $oldValues['id'],
            'amount' => $oldValues['amount'],
            'type' => $oldValues['type']
        ]);

        return redirect()
            ->route('categories.index') // Redireciona para o índice de categorias após deletar
            ->with('success', 'Transação removida com sucesso!');
    }

      public function transactionsByCategory(Category $category)
    {
        $this->authorize('view', $category); // Garante que o usuário pode ver esta categoria

        $user = Auth::user();
        // Busca as transações do usuário filtradas pela categoria, ordenadas por data
        $transactions = $user->transactions()
                             ->where('category_id', $category->id)
                             ->with('category') // Carrega a categoria relacionada
                             ->orderBy('date', 'desc')
                             ->get();

        return view('transactions.by_category', [ // Nova view para transações por categoria
            'category' => $category, // Passa a categoria para a view
            'transactions' => $transactions,
            'balance' => $user->transactions()->sum('amount') // Saldo total do usuário
        ]);
    }
}