<?php

namespace App\Livewire\App\Transactions;

use App\Models\Account;
use App\Models\Payee;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use App\Services\LoggingService;
use App\Enums\AccountType;
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
    public $editValue = '';
    
    // Sidebar properties
    public $selectedAccountId = null;
    public $showAccountModal = false;
    public $newAccount = [];
    public $accountTypes = [];

    protected $rules = [
        'newTransaction.account_id' => 'required|exists:accounts,id',
        'newTransaction.date' => 'required|date',
        'newTransaction.category_id' => 'nullable|exists:transaction_categories,id',
        'newTransaction.description' => 'required|string|max:255',
        'newTransaction.outflow' => 'nullable|numeric|min:0',
        'newTransaction.inflow' => 'nullable|numeric|min:0',
    ];

    protected $accountRules = [
        'newAccount.name' => 'required|string|max:255',
        'newAccount.type' => 'required|in:cash,checking,savings,credit_card,line_of_credit',
        'newAccount.balance' => 'required|numeric',
    ];

    public function mount()
    {
        // Verificar se há um team atual
        if (!auth()->user()->currentTeam) {
            $this->dispatch('notify', ['message' => 'No team selected. Please select a team first.', 'type' => 'error']);
            return;
        }
        
        $this->loadData();
        $this->resetNewTransaction();
        $this->resetNewAccount();
        $this->loadAccountTypes();
    }

    public function loadData()
    {
        $teamId = auth()->user()->currentTeam->id;
        
        $query = Transaction::with(['account', 'category', 'transactionable'])
            ->whereHas('account', function($query) use ($teamId) {
                $query->where('team_id', $teamId);
            });

        // Filter by selected account if any
        if ($this->selectedAccountId) {
            $query->where('account_id', $this->selectedAccountId);
        }

        $this->transactions = $query
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->accounts = Account::where('team_id', $teamId)
            ->open()
            ->get();

        $this->categories = TransactionCategory::whereHas('group', function($query) use ($teamId) {
            $query->where('team_id', $teamId);
        })->get();

        $this->payees = Payee::where('team_id', $teamId)
            ->listed()
            ->get();
    }

    public function loadAccountTypes()
    {
        $this->accountTypes = [
            'cash' => 'Cash',
            'checking' => 'Checking',
            'savings' => 'Savings',
            'credit_card' => 'Credit Card',
            'line_of_credit' => 'Line of Credit',
        ];
    }

    public function selectAccount($accountId)
    {
        $this->selectedAccountId = $accountId;
        $this->loadData();
    }

    public function showAllAccounts()
    {
        $this->selectedAccountId = null;
        $this->loadData();
    }

    public function openAccountModal()
    {
        $this->showAccountModal = true;
        $this->resetNewAccount();
    }

    public function closeAccountModal()
    {
        $this->showAccountModal = false;
        $this->resetNewAccount();
    }

    public function resetNewAccount()
    {
        $this->newAccount = [
            'name' => '',
            'type' => 'checking',
            'balance' => 0.00,
        ];
    }

    public function createAccount()
    {
        $this->validate($this->accountRules);

        $teamId = auth()->user()->currentTeam->id;

        DB::transaction(function () use ($teamId) {
            $account = Account::create([
                'team_id' => $teamId,
                'name' => $this->newAccount['name'],
                'type' => $this->newAccount['type'],
                'balance' => $this->newAccount['balance'],
                'is_closed' => false,
            ]);

            // Log account creation
            LoggingService::created('Account', [
                'account_id' => $account->id,
                'name' => $this->newAccount['name'],
                'type' => $this->newAccount['type'],
                'balance' => $this->newAccount['balance'],
            ]);
        });

        $this->loadData();
        $this->closeAccountModal();
        $this->dispatch('notify', ['message' => 'Account created successfully!', 'type' => 'success']);
    }

    public function resetNewTransaction()
    {
        $this->newTransaction = [
            'account_id' => $this->accounts->first()?->id,
            'date' => now()->format('Y-m-d'),
            'category_id' => '',
            'description' => '',
            'amount' => '',
            'outflow' => '',
            'inflow' => '',
            'is_cleared' => false,
        ];
    }

    public function addRow()
    {
        $this->showNewRow = true;
    }

    public function saveNewTransaction()
    {
        // Validação customizada para outflow e inflow
        $this->validate([
            'newTransaction.account_id' => 'required|exists:accounts,id',
            'newTransaction.date' => 'required|date',
            'newTransaction.category_id' => 'nullable|exists:transaction_categories,id',
            'newTransaction.description' => 'required|string|max:255',
            'newTransaction.outflow' => 'nullable|numeric|min:0',
            'newTransaction.inflow' => 'nullable|numeric|min:0',
        ]);
        
        // Verificar se há um valor de entrada ou saída
        if (empty($this->newTransaction['outflow']) && empty($this->newTransaction['inflow'])) {
            $this->addError('newTransaction.outflow', 'Please enter either an outflow or inflow amount.');
            return;
        }
        
        // Determinar o valor baseado no que foi preenchido
        $amount = 0;
        if (!empty($this->newTransaction['outflow'])) {
            $amount = -abs($this->newTransaction['outflow']);
        } elseif (!empty($this->newTransaction['inflow'])) {
            $amount = abs($this->newTransaction['inflow']);
        }
        
        // Preparar dados para criação da transação
        $transactionData = [
            'account_id' => $this->newTransaction['account_id'],
            'transactionable_id' => $this->newTransaction['account_id'], // Usar account_id como transactionable_id
            'transactionable_type' => 'App\Models\Account', // Tipo do relacionamento polimórfico
            'date' => $this->newTransaction['date'],
            'description' => $this->newTransaction['description'],
            'amount' => $amount,
            'category_id' => $this->newTransaction['category_id'],
            'is_cleared' => false,
            'is_reconciled' => false,
        ];

        DB::transaction(function () use ($transactionData) {
            $transaction = Transaction::create($transactionData);

            // Update account balance
            $account = Account::find($transactionData['account_id']);
            $account->balance += $transactionData['amount'];
            $account->save();
            
            // Log transaction creation
            LoggingService::created('Transaction', [
                'transaction_id' => $transaction->id,
                'account_id' => $transactionData['account_id'],
                'amount' => $transactionData['amount'],
                'description' => $transactionData['description'],
                'date' => $transactionData['date'],
                'category_id' => $transactionData['category_id']
            ]);
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
        $transaction = Transaction::find($id);
        if (!$transaction) return;
        
        $this->editingId = $id;
        $this->editingField = $field;
        
        // Set the current value for editing
        switch ($field) {
            case 'date':
                $this->editValue = $transaction->date->format('Y-m-d');
                break;
            case 'description':
                $this->editValue = $transaction->description;
                break;
            case 'category_id':
                $this->editValue = $transaction->category_id;
                break;
            case 'amount':
                $this->editValue = $transaction->amount;
                break;
        }
    }

    public function saveEdit($value = null)
    {
        if ($this->editingId && $this->editingField) {
            $transaction = Transaction::find($this->editingId);

            if ($transaction) {
                $valueToSave = $value ?? $this->editValue;
                
                // Handle amount changes - update account balance
                if ($this->editingField === 'amount') {
                    $oldAmount = $transaction->amount;
                    $newAmount = (float) $valueToSave;

                    DB::transaction(function () use ($transaction, $newAmount, $oldAmount) {
                        $transaction->update(['amount' => $newAmount]);

                        // Update account balance
                        $account = $transaction->account;
                        $account->balance += ($newAmount - $oldAmount);
                        $account->save();
                    });
                } else {
                    $transaction->update([$this->editingField => $valueToSave]);
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
        $this->editValue = '';
    }

    public function getClearedBalance()
    {
        return $this->transactions
            ->where('is_cleared', true)
            ->sum('amount');
    }

    public function getUnclearedBalance()
    {
        return $this->transactions
            ->where('is_cleared', false)
            ->sum('amount');
    }

    public function getWorkingBalance()
    {
        return $this->getClearedBalance() + $this->getUnclearedBalance();
    }

    public function getTotalIncome()
    {
        return $this->transactions
            ->where('amount', '>', 0)
            ->sum('amount');
    }

    public function getTotalExpenses()
    {
        return abs($this->transactions
            ->where('amount', '<', 0)
            ->sum('amount'));
    }

    public function getAccountBalance()
    {
        // Usar exatamente a mesma lógica do dashboard: dinheiro disponível para atribuir
        $totalCash = Account::where('team_id', auth()->user()->currentTeam->id)
            ->whereIn('type', ['checking', 'savings', 'cash'])
            ->sum('balance');
        
        $totalAssigned = $this->getTotalAssigned();
        
        return max(0, $totalCash - $totalAssigned);
    }

    public function getTotalAssigned()
    {
        // Calcular total atribuído às categorias (mesma lógica do dashboard)
        return \App\Models\TransactionCategory::whereHas('group', function($query) {
            $query->where('team_id', auth()->user()->currentTeam->id);
        })->sum('assigned_amount');
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
            // Log transaction deletion
            LoggingService::deleted('Transaction', [
                'transaction_id' => $transaction->id,
                'account_id' => $transaction->account_id,
                'amount' => $transaction->amount,
                'description' => $transaction->description,
                'date' => $transaction->date
            ]);
        }
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
