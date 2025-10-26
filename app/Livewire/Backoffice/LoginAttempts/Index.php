<?php

namespace App\Livewire\Backoffice\LoginAttempts;

use App\Models\LoginAttempt;
use App\Models\User;
use App\Enums\LoginAttemptStatus;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    // Modal properties
    public $showModal = false;
    public $isEditing = false;
    public $editingAttempt = null;
    
    // Unblock confirmation modal
    public $confirmingUnblock = false;
    public $attemptToUnblock = null;

    // Form properties
    public $modalEmail = '';
    public $modalIpAddress = '';
    public $modalUserAgent = '';
    public $modalStatus = '';
    public $modalFailureReason = '';
    public $modalAttemptedAt = '';
    public $modalCountry = '';
    public $modalCity = '';
    public $modalIsSuspicious = false;
    public $modalBlockedUntil = '';

    // Filter properties
    public $search = '';
    public $filters = [
        'status' => '',
        'country' => '',
        'suspicious' => '',
    ];
    
    // Cache busting for data refresh
    public $dataRefreshKey = 0;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];
    
    public function mount()
    {
        $this->authorize('login_attempts_read');
    }




    public function getDataProperty()
    {
        // Use refresh key to force fresh queries
        $refreshKey = $this->dataRefreshKey;
        
        $query = LoginAttempt::with(['user'])
            ->when($this->search, function($query) {
                $query->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('ip_address', 'like', '%' . $this->search . '%')
                      ->orWhere('city', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['status'], function($query) {
                $query->where('status', $this->filters['status']);
            })
            ->when($this->filters['country'], function($query) {
                $query->where('country', $this->filters['country']);
            })
            ->when($this->filters['suspicious'] !== '', function($query) {
                $query->where('is_suspicious', $this->filters['suspicious']);
            });

        return $query->orderBy('attempted_at', 'desc')->paginate(15);
    }

    // Metric properties
    public function getSuspiciousAttemptsProperty()
    {
        return LoginAttempt::suspicious()->count();
    }

    public function getBlockedAttemptsProperty()
    {
        return LoginAttempt::blocked()->count();
    }

    public function getRecentAttemptsProperty()
    {
        return LoginAttempt::recent(24)->count();
    }

    public function viewAttempt($attemptId)
    {
        $this->authorize('login_attempts_read');
        
        $this->editingAttempt = LoginAttempt::findOrFail($attemptId);
        $this->loadAttemptData();
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function blockIp($attemptId)
    {
        $this->authorize('login_attempts_update');
        
        $attempt = LoginAttempt::findOrFail($attemptId);
        
        // Block all attempts from this IP
        LoginAttempt::where('ip_address', $attempt->ip_address)
            ->update([
                'is_suspicious' => true,
                'blocked_until' => now()->addDays(1),
                'status' => LoginAttemptStatus::BLOCKED,
            ]);
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('login_attempts.messages.ip_blocked'));
        
        // Force data refresh
        $this->dataRefreshKey++;
        $this->dispatch('$refresh');
    }

    public function unblockIp($attemptId)
    {
        $this->authorize('login_attempts_update');
        
        $this->attemptToUnblock = LoginAttempt::findOrFail($attemptId);
        $this->confirmingUnblock = true;
    }
    
    public function confirmUnblockIp()
    {
        $this->authorize('login_attempts_update');
        
        if ($this->attemptToUnblock) {
            // Unblock all attempts from this IP
            LoginAttempt::where('ip_address', $this->attemptToUnblock->ip_address)
                ->update([
                    'is_suspicious' => false,
                    'blocked_until' => null,
                ]);
            
            $this->dispatch('refreshTable');
            session()->flash('message', __('login_attempts.messages.ip_unblocked'));
        }
        
        $this->confirmingUnblock = false;
        $this->attemptToUnblock = null;
        
        // Force data refresh
        $this->dataRefreshKey++;
        $this->dispatch('$refresh');
    }
    
    public function cancelUnblock()
    {
        $this->confirmingUnblock = false;
        $this->attemptToUnblock = null;
    }
    
    public function isIpBlocked($ipAddress)
    {
        return LoginAttempt::where('ip_address', $ipAddress)
            ->where('blocked_until', '>', now())
            ->exists();
    }

    public function deleteAttempt($attemptId)
    {
        $this->authorize('login_attempts_destroy');
        
        $attempt = LoginAttempt::findOrFail($attemptId);
        $attempt->delete();
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('login_attempts.messages.deleted_successfully'));
    }

    public function loadAttemptData()
    {
        $this->modalEmail = $this->editingAttempt->email;
        $this->modalIpAddress = $this->editingAttempt->ip_address;
        $this->modalUserAgent = $this->editingAttempt->user_agent;
        $this->modalStatus = $this->editingAttempt->status->value;
        $this->modalFailureReason = $this->editingAttempt->failure_reason;
        $this->modalAttemptedAt = $this->editingAttempt->attempted_at ? $this->editingAttempt->attempted_at->format('Y-m-d\TH:i') : '';
        $this->modalCountry = $this->editingAttempt->country;
        $this->modalCity = $this->editingAttempt->city;
        $this->modalIsSuspicious = $this->editingAttempt->is_suspicious;
        $this->modalBlockedUntil = $this->editingAttempt->blocked_until ? $this->editingAttempt->blocked_until->format('Y-m-d\TH:i') : '';
    }

    public function resetModalForm()
    {
        $this->modalEmail = '';
        $this->modalIpAddress = '';
        $this->modalUserAgent = '';
        $this->modalStatus = '';
        $this->modalFailureReason = '';
        $this->modalAttemptedAt = '';
        $this->modalCountry = '';
        $this->modalCity = '';
        $this->modalIsSuspicious = false;
        $this->modalBlockedUntil = '';
        $this->editingAttempt = null;
        $this->isEditing = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetModalForm();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [
            'status' => '',
            'country' => '',
            'suspicious' => '',
        ];
        $this->resetPage();
        
        // Force UI update
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.login-attempts.index', [
            'data' => $this->data,
            'suspiciousAttempts' => $this->suspiciousAttempts,
            'blockedAttempts' => $this->blockedAttempts,
            'recentAttempts' => $this->recentAttempts,
        ]);
    }
}
