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
    
    // Modal properties
    public $showCategoryGroupModal = false;
    public $showCategoryModal = false;
    public $newCategoryGroup = [];
    public $newCategory = [];
    
    // Filter properties
    public $activeFilter = 'all';
    public $filteredCategoryGroups = [];
    
    // Date navigation properties
    public $currentMonth;
    public $currentYear;
    
    // Assign modal properties
    public $showAssignModal = false;
    public $assignAmount = 0;
    public $assignToCategory = '';
    public $availableCategories = [];
    
    // History management properties
    public $history = [];
    public $historyIndex = -1;
    public $maxHistorySize = 50;
    public $showRecentMoves = false;

    protected $rules = [
        'newCategoryGroup.name' => 'required|string|max:255',
        'newCategoryGroup.is_hidden' => 'boolean',
        'newCategory.name' => 'required|string|max:255',
        'newCategory.group_id' => 'required|exists:category_groups,id',
        'newCategory.assigned_amount' => 'required|numeric|min:0',
        'assignAmount' => 'required|numeric|min:0.01',
        'assignToCategory' => 'required|exists:transaction_categories,id',
    ];

    protected $listeners = [
        'filterChanged' => 'applyFilter',
    ];

    public function mount()
    {
        // Initialize current date
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        
        $this->loadCategoryGroups();
        // Initialize all groups as expanded
        $this->expandedGroups = $this->categoryGroups->pluck('id')->toArray();
        
        // NOVO: Armazenar valores originais
        $this->storeOriginalValues();
        
        // Initialize modal forms
        $this->resetCategoryGroupForm();
        $this->resetCategoryForm();
        
        // Initialize filters
        $this->applyFilter();
    }

    public function loadCategoryGroups()
    {
        $this->categoryGroups = CategoryGroup::with(['categories' => function($query) {
            $query->whereMonth('created_at', $this->currentMonth)
                  ->whereYear('created_at', $this->currentYear)
                  ->orderBy('name');
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
        
        // Reapply current filter after loading
        $this->applyFilter();
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
            $oldValue = $category->assigned_amount;
            
            // Salvar no histórico antes da mudança
            $this->saveToHistory('edit_assigned', [
                'category_id' => $this->editingCategoryId,
                'field' => $this->editingField,
                'old_value' => $oldValue,
                'new_value' => (float) $this->editValue,
                'category_name' => $category->name
            ]);
            
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

    // Category Group Modal Methods
    public function openCategoryGroupModal()
    {
        $this->showCategoryGroupModal = true;
        $this->resetCategoryGroupForm();
    }

    public function closeCategoryGroupModal()
    {
        $this->showCategoryGroupModal = false;
        $this->resetCategoryGroupForm();
    }

    public function resetCategoryGroupForm()
    {
        $this->newCategoryGroup = [
            'name' => '',
            'is_hidden' => false,
        ];
    }

    public function saveCategoryGroup()
    {
        $this->validate([
            'newCategoryGroup.name' => 'required|string|max:255',
            'newCategoryGroup.is_hidden' => 'boolean',
        ]);

        // Create category group with current month/year as creation date
        $createdAt = \Carbon\Carbon::create($this->currentYear, $this->currentMonth, 1);
        
        CategoryGroup::create([
            'team_id' => auth()->user()->currentTeam->id,
            'name' => $this->newCategoryGroup['name'],
            'is_hidden' => $this->newCategoryGroup['is_hidden'] ?? false,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        $this->loadCategoryGroups();
        $this->closeCategoryGroupModal();
        
        $this->dispatch('notify', [
            'message' => 'Category group created successfully for ' . $this->getCurrentMonthName() . '!', 
            'type' => 'success'
        ]);
    }

    // Category Modal Methods
    public function openCategoryModal()
    {
        $this->showCategoryModal = true;
        $this->resetCategoryForm();
    }

    public function closeCategoryModal()
    {
        $this->showCategoryModal = false;
        $this->resetCategoryForm();
    }

    public function resetCategoryForm()
    {
        $this->newCategory = [
            'name' => '',
            'group_id' => $this->categoryGroups->first()?->id ?? '',
            'assigned_amount' => 0,
        ];
    }

    public function saveCategory()
    {
        $this->validate([
            'newCategory.name' => 'required|string|max:255',
            'newCategory.group_id' => 'required|exists:category_groups,id',
            'newCategory.assigned_amount' => 'required|numeric|min:0',
        ]);

        // Create category with current month/year as creation date
        $createdAt = \Carbon\Carbon::create($this->currentYear, $this->currentMonth, 1);
        
        TransactionCategory::create([
            'group_id' => $this->newCategory['group_id'],
            'name' => $this->newCategory['name'],
            'assigned_amount' => $this->newCategory['assigned_amount'],
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        $this->loadCategoryGroups();
        $this->closeCategoryModal();
        
        $this->dispatch('notify', [
            'message' => 'Category created successfully for ' . $this->getCurrentMonthName() . '!', 
            'type' => 'success'
        ]);
    }

    // Filter Methods
    public function setFilter($filter)
    {
        $this->activeFilter = $filter;
        $this->applyFilter();
        
        $this->dispatch('notify', [
            'message' => "Filter changed to: " . ucfirst(str_replace('_', ' ', $filter)),
            'type' => 'info'
        ]);
    }

    public function applyFilter()
    {
        $this->filteredCategoryGroups = collect();
        
        foreach ($this->categoryGroups as $group) {
            $filteredCategories = collect();
            
            foreach ($group->categories as $category) {
                if ($this->shouldShowCategory($category)) {
                    $filteredCategories->push($category);
                }
            }
            
            // Only show groups that have categories matching the filter
            if ($filteredCategories->isNotEmpty() || $this->activeFilter === 'all') {
                $groupClone = clone $group;
                $groupClone->setRelation('categories', $filteredCategories);
                $this->filteredCategoryGroups->push($groupClone);
            }
        }
    }

    private function shouldShowCategory($category)
    {
        switch ($this->activeFilter) {
            case 'underfunded':
                return $category->balance < 0;
                
            case 'overfunded':
                return $category->balance > $category->assigned_amount && $category->assigned_amount > 0;
                
            case 'money_available':
                return $category->balance > 0;
                
            case 'snoozed':
                return $category->is_snoozed ?? false;
                
            case 'vacation':
                return $this->isVacationCategory($category);
                
            case 'all':
            default:
                return true;
        }
    }

    private function isVacationCategory($category)
    {
        $vacationKeywords = ['vacation', 'travel', 'holiday', 'trip', 'férias', 'viagem'];
        
        return collect($vacationKeywords)->contains(function ($keyword) use ($category) {
            return stripos($category->name, $keyword) !== false;
        });
    }

    public function getDisplayedCategoryGroups()
    {
        return $this->activeFilter === 'all' ? $this->categoryGroups : $this->filteredCategoryGroups;
    }

    public function getFilteredTotalAssigned()
    {
        return $this->getDisplayedCategoryGroups()->sum(function($group) {
            return $group->categories->sum('assigned_amount');
        });
    }

    public function getFilteredTotalActivity()
    {
        return $this->getDisplayedCategoryGroups()->sum(function($group) {
            return $group->categories->sum('activity');
        });
    }

    public function getFilteredTotalBalance()
    {
        return $this->getDisplayedCategoryGroups()->sum(function($group) {
            return $group->categories->sum('balance');
        });
    }

    // Date Navigation Methods
    public function previousMonth()
    {
        $currentDate = \Carbon\Carbon::create($this->currentYear, $this->currentMonth, 1);
        $previousMonth = $currentDate->subMonth();
        
        $this->currentMonth = $previousMonth->month;
        $this->currentYear = $previousMonth->year;
        
        $this->loadCategoryGroups();
        
        $this->dispatch('notify', [
            'message' => "Navigated to " . $previousMonth->format('M Y'),
            'type' => 'info'
        ]);
    }

    public function nextMonth()
    {
        $currentDate = \Carbon\Carbon::create($this->currentYear, $this->currentMonth, 1);
        $nextMonth = $currentDate->addMonth();
        
        $this->currentMonth = $nextMonth->month;
        $this->currentYear = $nextMonth->year;
        
        $this->loadCategoryGroups();
        
        $this->dispatch('notify', [
            'message' => "Navigated to " . $nextMonth->format('M Y'),
            'type' => 'info'
        ]);
    }

    public function goToToday()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        
        $this->loadCategoryGroups();
        
        $this->dispatch('notify', [
            'message' => "Returned to current month: " . now()->format('M Y'),
            'type' => 'success'
        ]);
    }

    public function getCurrentMonthName()
    {
        return \Carbon\Carbon::create($this->currentYear, $this->currentMonth, 1)->format('M Y');
    }

    public function isCurrentMonth()
    {
        return $this->currentMonth == now()->month && $this->currentYear == now()->year;
    }

    // Assign Modal Methods
    public function openAssignModal()
    {
        $this->showAssignModal = true;
        $this->assignAmount = 0;
        $this->assignToCategory = '';
        $this->loadAvailableCategories();
    }

    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->assignAmount = 0;
        $this->assignToCategory = '';
    }

    public function loadAvailableCategories()
    {
        $this->availableCategories = collect();
        
        foreach ($this->categoryGroups as $group) {
            foreach ($group->categories as $category) {
                if (!$this->isProtectedCategory($category)) {
                    $this->availableCategories->push([
                        'id' => $category->id,
                        'name' => $category->name,
                        'group_name' => $group->name,
                        'current_assigned' => $category->assigned_amount,
                    ]);
                }
            }
        }
    }

    public function assignMoney()
    {
        $this->validate([
            'assignAmount' => 'required|numeric|min:0.01|max:' . $this->getReadyToAssign(),
            'assignToCategory' => 'required|exists:transaction_categories,id',
        ]);

        $category = TransactionCategory::find($this->assignToCategory);
        
        if ($category) {
            // Salvar no histórico antes da mudança
            $this->saveToHistory('assign_money', [
                'category_id' => $this->assignToCategory,
                'amount' => $this->assignAmount,
                'category_name' => $category->name
            ]);
            
            $category->update([
                'assigned_amount' => $category->assigned_amount + $this->assignAmount,
            ]);

            $this->loadCategoryGroups();
            $this->closeAssignModal();
            
            $this->dispatch('notify', [
                'message' => "Successfully assigned $" . number_format($this->assignAmount, 2) . " to " . $category->name,
                'type' => 'success'
            ]);
        }
    }

    public function getMaxAssignAmount()
    {
        return $this->getReadyToAssign();
    }

    public function getReadyToAssign()
    {
        // Total de dinheiro nas contas (saldo positivo)
        $totalCash = Account::where('team_id', auth()->user()->currentTeam->id)
            ->whereIn('type', ['checking', 'savings', 'cash'])
            ->sum('balance');
        
        // Total já atribuído às categorias
        $totalAssigned = $this->getTotalAssigned();
        
        // Dinheiro disponível para atribuir
        return max(0, $totalCash - $totalAssigned);
    }

    public function getTotalCashInAccounts()
    {
        return Account::where('team_id', auth()->user()->currentTeam->id)
            ->whereIn('type', ['checking', 'savings', 'cash'])
            ->sum('balance');
    }

    public function moveCategoryToGroup($categoryId, $newGroupId)
    {
        $category = TransactionCategory::find($categoryId);
        $newGroup = CategoryGroup::find($newGroupId);
        
        if ($category && $newGroup) {
            // Verificar se o grupo pertence ao mesmo team
            if ($newGroup->team_id === auth()->user()->currentTeam->id) {
                // Salvar estado antes da mudança
                $this->saveToHistory('move_category', [
                    'category_id' => $categoryId,
                    'old_group_id' => $category->group_id,
                    'new_group_id' => $newGroupId,
                    'category_name' => $category->name,
                    'group_name' => $newGroup->name
                ]);
                
                $category->update(['group_id' => $newGroupId]);
                
                $this->loadCategoryGroups();
                
                $this->dispatch('notify', [
                    'message' => "Category '{$category->name}' moved to '{$newGroup->name}'",
                    'type' => 'success'
                ]);
            } else {
                $this->dispatch('notify', [
                    'message' => 'Cannot move category to different team',
                    'type' => 'error'
                ]);
            }
        }
    }

    public function saveToHistory($action, $data)
    {
        // Remover histórico futuro se estamos no meio da lista
        if ($this->historyIndex < count($this->history) - 1) {
            $this->history = array_slice($this->history, 0, $this->historyIndex + 1);
        }
        
        // Adicionar nova ação ao histórico
        $this->history[] = [
            'action' => $action,
            'data' => $data,
            'timestamp' => now()->toISOString()
        ];
        
        // Limitar tamanho do histórico
        if (count($this->history) > $this->maxHistorySize) {
            $this->history = array_slice($this->history, -$this->maxHistorySize);
        }
        
        $this->historyIndex = count($this->history) - 1;
    }

    public function undo()
    {
        if ($this->historyIndex >= 0 && isset($this->history[$this->historyIndex])) {
            $action = $this->history[$this->historyIndex];
            
            switch ($action['action']) {
                case 'move_category':
                    $this->undoMoveCategory($action['data']);
                    break;
                case 'edit_assigned':
                    $this->undoEditAssigned($action['data']);
                    break;
                case 'assign_money':
                    $this->undoAssignMoney($action['data']);
                    break;
            }
            
            $this->historyIndex--;
            $this->loadCategoryGroups();
            
            $this->dispatch('notify', [
                'message' => 'Action undone successfully',
                'type' => 'success'
            ]);
        } else {
            $this->dispatch('notify', [
                'message' => 'Nothing to undo',
                'type' => 'info'
            ]);
        }
    }

    public function redo()
    {
        if ($this->historyIndex < count($this->history) - 1) {
            $this->historyIndex++;
            $action = $this->history[$this->historyIndex];
            
            switch ($action['action']) {
                case 'move_category':
                    $this->redoMoveCategory($action['data']);
                    break;
                case 'edit_assigned':
                    $this->redoEditAssigned($action['data']);
                    break;
                case 'assign_money':
                    $this->redoAssignMoney($action['data']);
                    break;
            }
            
            $this->loadCategoryGroups();
            
            $this->dispatch('notify', [
                'message' => 'Action redone successfully',
                'type' => 'success'
            ]);
        } else {
            $this->dispatch('notify', [
                'message' => 'Nothing to redo',
                'type' => 'info'
            ]);
        }
    }

    private function undoMoveCategory($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['group_id' => $data['old_group_id']]);
        }
    }

    private function redoMoveCategory($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['group_id' => $data['new_group_id']]);
        }
    }

    private function undoEditAssigned($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['assigned_amount' => $data['old_value']]);
        }
    }

    private function redoEditAssigned($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['assigned_amount' => $data['new_value']]);
        }
    }

    private function undoAssignMoney($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['assigned_amount' => $category->assigned_amount - $data['amount']]);
        }
    }

    private function redoAssignMoney($data)
    {
        $category = TransactionCategory::find($data['category_id']);
        if ($category) {
            $category->update(['assigned_amount' => $category->assigned_amount + $data['amount']]);
        }
    }

    public function getRecentMoves()
    {
        return array_slice($this->history, -10); // Últimos 10 movimentos
    }

    public function render()
    {
        return view('livewire.app.dashboard.budget-table');
    }
}