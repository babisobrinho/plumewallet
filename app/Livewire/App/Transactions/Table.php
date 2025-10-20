<?php

namespace App\Livewire\App\Transactions;

use App\Models\Account;
use App\Models\Payee;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Table extends Component
{
    public $transactions = [];
    public $accounts = [];
    public $categories = [];
    public $payees = [];
    public $newTransaction = [];
    public $showNewRow = false;
    public $editingId = null;
    public $editingField = null;

    protected $rules = [
        'newTransaction.account_id' => 'required|exists:accounts,id',
        'newTransaction.date' => 'required|date',
        'newTransaction.category_id' => 'required|exists:transaction_categories,id',
        'newTransaction.description' => 'required|string|max:255',
        'newTransaction.amount' => 'required|numeric',
    ];

    public function mount()
    {
        $this->loadData();
        $this->resetNewTransaction();
    }

    public function loadData()
    {
        $this->transactions = Transaction::with(['account', 'category', 'transactionable'])
            ->whereHas('account', function($query) {
                $query->where('team_id', auth()->user()->currentTeam->id);
            })
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->accounts = Account::where('team_id', auth()->user()->currentTeam->id)
            ->open()
            ->get();

        $this->categories = TransactionCategory::whereHas('group', function($query) {
            $query->where('team_id', auth()->user()->currentTeam->id);
        })->get();

        $this->payees = Payee::where('team_id', auth()->user()->currentTeam->id)
            ->listed()
            ->get();
    }

    public function resetNewTransaction()
    {
        $this->newTransaction = [
            'account_id' => $this->accounts->first()?->id,
            'date' => now()->format('Y-m-d'),
            'category_id' => '',
            'description' => '',
            'amount' => '',
            'is_cleared' => false,
        ];
    }

    public function addRow()
    {
        $this->showNewRow = true;
    }

    public function saveNewTransaction()
    {
        $this->validate();

        DB::transaction(function () {
            $transaction = Transaction::create($this->newTransaction);

            // Update account balance
            $account = Account::find($this->newTransaction['account_id']);
            $account->balance += $this->newTransaction['amount'];
            $account->save();
        });

        $this->loadData();
        $this->showNewRow = false;
        $this->resetNewTransaction();
        $this->dispatch('notify', ['message' => 'Transaction added successfully!', 'type' => 'success']);
    }

    public function cancelNewTransaction()
    {
        $this->showNewRow = false;
        $this->resetNewTransaction();
    }

    public function startEdit($id, $field)
    {
        $this->editingId = $id;
        $this->editingField = $field;
    }

    public function saveEdit($value)
    {
        if ($this->editingId && $this->editingField) {
            $transaction = Transaction::find($this->editingId);

            if ($transaction) {
                // Handle amount changes - update account balance
                if ($this->editingField === 'amount') {
                    $oldAmount = $transaction->amount;
                    $newAmount = (float) $value;

                    DB::transaction(function () use ($transaction, $newAmount, $oldAmount) {
                        $transaction->update(['amount' => $newAmount]);

                        // Update account balance
                        $account = $transaction->account;
                        $account->balance += ($newAmount - $oldAmount);
                        $account->save();
                    });
                } else {
                    $transaction->update([$this->editingField => $value]);
                }
            }
        }

        $this->cancelEdit();
        $this->loadData();
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->editingField = null;
    }

    public function toggleCleared($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->update(['is_cleared' => !$transaction->is_cleared]);
            $this->loadData();
        }
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            DB::transaction(function () use ($transaction) {
                // Update account balance before deleting
                $account = $transaction->account;
                $account->balance -= $transaction->amount;
                $account->save();

                $transaction->delete();
            });

            $this->loadData();
            $this->dispatch('notify', ['message' => 'Transaction deleted!', 'type' => 'success']);
        }
    }

    public function render()
    {
        return view('livewire.app.transactions.table');
    }
}
