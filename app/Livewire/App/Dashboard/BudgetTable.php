<?php

namespace App\Livewire\App\Dashboard;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\CategoryGroup;
use App\Models\TransactionCategory;
use Livewire\Component;

class BudgetTable extends Component
{
    public $categoryGroups = [];
    public $editingCategoryId = null;
    public $editingField = null;
    public $editValue = 0;
    public $expandedGroups = [];
    public $originalValues = []; // NOVO: Armazenar valores originais

    public function mount()
    {
        $this->loadCategoryGroups();
        // Initialize all groups as expanded
        $this->expandedGroups = $this->categoryGroups->pluck('id')->toArray();
        
        // NOVO: Armazenar valores originais
        $this->storeOriginalValues();
    }

    public function loadCategoryGroups()
    {
        $this->categoryGroups = CategoryGroup::with(['categories' => function($query) {
            $query->orderBy('name');
        }])
            ->where('team_id', auth()->user()->currentTeam->id)
            ->visible()
            ->orderBy('name')
            ->get();
            
        // Calculate values for each category only once during initial load
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $category) {
                $this->calculateCategoryValues($category);
            }
        }
    }

    // NOVO: Armazenar valores originais
    private function storeOriginalValues()
    {
        $this->originalValues = [];
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $category) {
                $this->originalValues[$category->id] = [
                    'assigned_amount' => $category->assigned_amount,
                    'activity' => $category->activity,
                    'balance' => $category->balance,
                    'payment' => $category->payment,
                ];
            }
        }
    }

    // NOVO: Restaurar valores originais durante edição
    private function restoreOriginalValues()
    {
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $category) {
                if (isset($this->originalValues[$category->id])) {
                    $category->assigned_amount = $this->originalValues[$category->id]['assigned_amount'];
                    $category->activity = $this->originalValues[$category->id]['activity'];
                    $category->balance = $this->originalValues[$category->id]['balance'];
                    $category->payment = $this->originalValues[$category->id]['payment'];
                }
            }
        }
    }

    private function calculateCategoryValues($category)
    {
        // Get account types for each group using the AccountType enum
        $cashAccountTypes = $this->getAccountTypesForGroup('cash');
        $creditAccountTypes = $this->getAccountTypesForGroup('credit');
        
        // Calculate activity for cash accounts (checking, savings, cash)
        $category->activity = $category->transactions()
            ->whereHas('account', function($query) use ($cashAccountTypes) {
                $query->where('team_id', auth()->user()->currentTeam->id)
                      ->whereIn('type', $cashAccountTypes);
            })
            ->sum('amount');
        
        // Calculate payment for credit accounts (credit cards, line of credit)
        $category->payment = $category->transactions()
            ->whereHas('account', function($query) use ($creditAccountTypes) {
                $query->where('team_id', auth()->user()->currentTeam->id)
                      ->whereIn('type', $creditAccountTypes);
            })
            ->sum('amount');
        
        // Balance calculation:
        // - For credit card payment categories: balance = assigned + payment
        // - For regular categories: balance = assigned + activity
        if ($this->isCreditCardPaymentCategory($category)) {
            $category->balance = $category->assigned_amount + $category->payment;
        } else {
            $category->balance = $category->assigned_amount + $category->activity;
        }
    }

    public function isCreditCardPaymentCategory($category)
    {
        // Primary check: if category belongs to "Credit Card Payments" group
        if ($category->group->name === 'Credit Card Payments') {
            return true;
        }
        
        // Secondary check: if category name matches any credit card account names
        return Account::where('team_id', auth()->user()->currentTeam->id)
            ->credit()
            ->where('name', $category->name)
            ->exists();
    }

    private function getAccountTypesForGroup(string $groupName): array
    {
        return array_map(fn($type) => $type->value, AccountType::getGroup($groupName));
    }

    public function toggleGroup($groupId)
    {
        if (in_array($groupId, $this->expandedGroups)) {
            $this->expandedGroups = array_diff($this->expandedGroups, [$groupId]);
        } else {
            $this->expandedGroups[] = $groupId;
        }
    }

    public function isGroupExpanded($groupId)
    {
        return in_array($groupId, $this->expandedGroups);
    }

    public function startEditing($categoryId, $field, $value)
    {
        // Find the category in the loaded data instead of querying database
        $category = null;
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $cat) {
                if ($cat->id === $categoryId) {
                    $category = $cat;
                    break 2;
                }
            }
        }
        
        if (!$category) {
            return;
        }

        // Prevent editing if category belongs to protected group
        if ($this->isProtectedCategory($category)) {
            $this->dispatch('notify', [
                'message' => 'Credit Card Payment categories cannot be edited manually.',
                'type' => 'warning'
            ]);
            return;
        }
        
        // Cancel any existing edit first
        if ($this->editingCategoryId && $this->editingCategoryId !== $categoryId) {
            $this->cancelEdit();
        }
        
        $this->editingCategoryId = $categoryId;
        $this->editingField = $field;
        $this->editValue = (float) $value;
        
        // NOVO: Restaurar valores originais para evitar zeros
        $this->restoreOriginalValues();
    }

    // NOVO: Método para capturar input sem re-renderizar
    public function updateEditValue($value)
    {
        $this->editValue = (float) $value;
    }

    public function saveEdit()
    {
        if (!$this->editingCategoryId || !$this->editingField) {
            $this->cancelEdit();
            return;
        }

        $category = TransactionCategory::find($this->editingCategoryId);

        if (!$category) {
            $this->cancelEdit();
            return;
        }

        if ($this->editingField === 'assigned_amount') {
            // Update database
            $category->update(['assigned_amount' => (float) $this->editValue]);
            
            // Update the specific category in loaded data
            $this->updateCategoryInLoadedData($category);
            
            // Recalculate values ONLY for the updated category
            $this->recalculateCategoryValues($category);
            
            // NOVO: Atualizar valores originais
            $this->originalValues[$category->id]['assigned_amount'] = (float) $this->editValue;
            $this->originalValues[$category->id]['balance'] = $category->balance;
            
            $this->dispatch('notify', [
                'message' => 'Budget updated successfully!', 
                'type' => 'success'
            ]);
        }

        $this->cancelEdit();
    }

    private function updateCategoryInLoadedData($updatedCategory)
    {
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $category) {
                if ($category->id === $updatedCategory->id) {
                    $category->assigned_amount = $updatedCategory->assigned_amount;
                    break;
                }
            }
        }
    }

    private function recalculateCategoryValues($category)
    {
        // Find the category in loaded data and recalculate only its values
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $cat) {
                if ($cat->id === $category->id) {
                    $this->calculateCategoryValues($cat);
                    break 2;
                }
            }
        }
    }

    public function cancelEdit()
    {
        $this->editingCategoryId = null;
        $this->editingField = null;
        $this->editValue = 0;
        
        // NOVO: Restaurar valores originais ao cancelar
        $this->restoreOriginalValues();
    }

    public function getTotalAssigned()
    {
        return $this->categoryGroups->sum(function($group) {
            return $group->categories->sum('assigned_amount');
        });
    }

    public function getTotalActivity()
    {
        return $this->categoryGroups->sum(function($group) {
            return $group->categories->sum('activity');
        });
    }

    public function getTotalBalance()
    {
        return $this->categoryGroups->sum(function($group) {
            return $group->categories->sum('balance');
        });
    }

    public function isProtectedGroup($group)
    {
        return $group->name === 'Credit Card Payments';
    }

    public function isProtectedCategory($category)
    {
        return $this->isProtectedGroup($category->group);
    }

    public function render()
    {
        return view('livewire.app.dashboard.budget-table');
    }
}