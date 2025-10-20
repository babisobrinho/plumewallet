<?php

namespace App\Livewire\App\Dashboard;

use App\Models\CategoryGroup;
use App\Models\TransactionCategory;
use Livewire\Component;

class BudgetTable extends Component
{
    public $categoryGroups = [];
    public $editingCategoryId = null;
    public $editingField = null;
    public $editValue = '';

    public function mount()
    {
        $this->loadCategoryGroups();
    }

    public function loadCategoryGroups()
    {
        $this->categoryGroups = CategoryGroup::with(['categories' => function($query) {
            $query->orderBy('name');
        }])
            ->where('team_id', auth()->user()->currentTeam->id)
            ->visible()
            ->orderBy('name')
            ->get()
            ->map(function($group) {
                $group->categories->each(function($category) {
                    $category->activity = $category->transactions()
                        ->whereHas('account', function($query) {
                            $query->where('team_id', auth()->user()->currentTeam->id);
                        })
                        ->sum('amount');
                    $category->balance = $category->assigned_amount + $category->activity;
                });
                return $group;
            });
    }

    public function startEditing($categoryId, $field, $value)
    {
        $this->editingCategoryId = $categoryId;
        $this->editingField = $field;
        $this->editValue = $value;
    }

    public function saveEdit()
    {
        if ($this->editingCategoryId && $this->editingField) {
            $category = TransactionCategory::find($this->editingCategoryId);

            if ($category && $this->editingField === 'assigned_amount') {
                $category->update(['assigned_amount' => (float) $this->editValue]);
                $this->loadCategoryGroups();
                $this->dispatch('notify', ['message' => 'Budget updated!', 'type' => 'success']);
            }
        }

        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingCategoryId = null;
        $this->editingField = null;
        $this->editValue = '';
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

    public function render()
    {
        return view('livewire.app.dashboard.budget-table');
    }
}
