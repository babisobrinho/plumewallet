<?php

namespace App\Livewire\App\Beneficiaries;

use App\Models\Payee;
use App\Models\TransactionCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    // Search and filters
    public $search = '';
    public $filter = 'all'; // all, listed, unlisted

    // Modal properties
    public $showModal = false;
    public $isEditing = false;
    public $editingPayee = null;
    
    // Modal form fields
    public $modalName = '';
    public $modalIsListed = false;
    public $modalCategoryId = '';

    // Delete confirmation modal
    public $showDeleteModal = false;
    public $deletingPayeeId = null;
    public $replacementPayeeId = null;

    public function mount()
    {
        // Ensure user has a current team
        if (!auth()->user()->currentTeam) {
            $this->dispatch('notify', ['message' => 'No team selected. Please select a team first.', 'type' => 'error']);
            return;
        }
    }

    public function getPayeesProperty()
    {
        $teamId = auth()->user()->currentTeam->id;
        
        $query = Payee::where('team_id', $teamId)
            ->with('category');

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply status filter
        if ($this->filter === 'listed') {
            $query->where('is_listed', true);
        } elseif ($this->filter === 'unlisted') {
            $query->where('is_listed', false);
        }

        return $query->orderBy('name')->paginate(15);
    }

    public function getCategoriesProperty()
    {
        $teamId = auth()->user()->currentTeam->id;
        
        return TransactionCategory::whereHas('group', function($query) use ($teamId) {
            $query->where('team_id', $teamId);
        })->get();
    }

    public function openModal($payeeId = null)
    {
        // Ensure delete modal is closed
        $this->showDeleteModal = false;
        
        $this->isEditing = $payeeId !== null;
        $this->editingPayee = $payeeId;

        if ($this->isEditing) {
            $payee = Payee::findOrFail($payeeId);
            $this->modalName = $payee->name;
            $this->modalIsListed = $payee->is_listed;
            $this->modalCategoryId = $payee->category_id ?? '';
        } else {
            $this->resetModal();
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetModal();
    }

    public function resetModal()
    {
        $this->modalName = '';
        $this->modalIsListed = false;
        $this->modalCategoryId = '';
        $this->isEditing = false;
        $this->editingPayee = null;
    }

    public function confirmPayeeDeletion($payeeId)
    {
        // Ensure add/edit modal is closed
        $this->showModal = false;
        
        $this->deletingPayeeId = $payeeId;
        $this->replacementPayeeId = null;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deletingPayeeId = null;
        $this->replacementPayeeId = null;
    }

    public function savePayee()
    {
        $this->validate([
            'modalName' => 'required|string|max:255',
            'modalCategoryId' => 'nullable|exists:transaction_categories,id',
        ]);

        $teamId = auth()->user()->currentTeam->id;

        if ($this->isEditing && $this->editingPayee) {
            $payee = Payee::findOrFail($this->editingPayee);
            $payee->update([
                'name' => $this->modalName,
                'is_listed' => $this->modalIsListed,
                'category_id' => $this->modalCategoryId ?: null,
            ]);

            $this->dispatch('notify', ['message' => __('common.beneficiaries.messages.updated'), 'type' => 'success']);
        } else {
            Payee::create([
                'team_id' => $teamId,
                'name' => $this->modalName,
                'is_listed' => $this->modalIsListed,
                'category_id' => $this->modalCategoryId ?: null,
            ]);

            $this->dispatch('notify', ['message' => __('common.beneficiaries.messages.created'), 'type' => 'success']);
        }

        $this->closeModal();
    }

    public function deletePayee()
    {
        if (!$this->deletingPayeeId) {
            return;
        }

        $payee = Payee::findOrFail($this->deletingPayeeId);
        
        // If a replacement payee is selected, update all transactions
        if ($this->replacementPayeeId) {
            \App\Models\Transaction::where('transactionable_type', Payee::class)
                ->where('transactionable_id', $this->deletingPayeeId)
                ->update([
                    'transactionable_id' => $this->replacementPayeeId
                ]);
        } else {
            // If no replacement, just delete the transactions
            \App\Models\Transaction::where('transactionable_type', Payee::class)
                ->where('transactionable_id', $this->deletingPayeeId)
                ->delete();
        }

        $payee->delete();

        $this->dispatch('notify', ['message' => __('common.beneficiaries.messages.deleted'), 'type' => 'success']);
        
        $this->showDeleteModal = false;
        $this->deletingPayeeId = null;
        $this->replacementPayeeId = null;
    }

    public function toggleListed($payeeId)
    {
        $payee = Payee::findOrFail($payeeId);
        $payee->update([
            'is_listed' => !$payee->is_listed,
        ]);

        $this->dispatch('notify', ['message' => __('common.beneficiaries.messages.status_updated'), 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.app.beneficiaries.index', [
            'payees' => $this->payees,
            'categories' => $this->categories,
        ]);
    }
} 