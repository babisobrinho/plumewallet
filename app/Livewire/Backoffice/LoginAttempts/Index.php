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

    // Form properties
    public $modalEmail = '';
    public $modalIpAddress = '';
    public $modalUserAgent = '';
    public $modalStatus = '';
    public $modalFailureReason = '';
    public $modalAttemptedAt = '';
    public $modalUserId = '';
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

    protected $listeners = [
        'refreshTable' => '$refresh',
        'editItem' => 'editAttempt',
        'deleteItem' => 'deleteAttempt',
        'blockItem' => 'blockIp',
        'unblockItem' => 'unblockIp',
    ];
    
    public function mount()
    {
        $this->authorize('login_attempts_read');
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'status',
                'label' => __('login_attempts.filters.status'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => LoginAttemptStatus::options(),
            ],
            [
                'key' => 'country',
                'label' => __('login_attempts.filters.country'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => LoginAttempt::distinct('country')->pluck('country', 'country')->filter()->toArray(),
            ],
            [
                'key' => 'suspicious',
                'label' => __('login_attempts.filters.suspicious'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => [
                    '1' => __('common.terms.yes'),
                    '0' => __('common.terms.no'),
                ],
            ],
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'email',
                'label' => __('login_attempts.table.email'),
                'sortable' => true,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'ip_address',
                'label' => __('login_attempts.table.ip_address'),
                'sortable' => true,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'status',
                'label' => __('login_attempts.table.status'),
                'component' => 'livewire.backoffice.login-attempts.partials.status-badge',
                'sortable' => true,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'country',
                'label' => __('login_attempts.table.country'),
                'sortable' => false,
                'class' => 'w-1/12',
            ],
            [
                'key' => 'city',
                'label' => __('login_attempts.table.city'),
                'sortable' => false,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'is_suspicious',
                'label' => __('login_attempts.table.suspicious'),
                'component' => 'livewire.backoffice.login-attempts.partials.suspicious-badge',
                'sortable' => true,
                'class' => 'w-1/12',
            ],
            [
                'key' => 'attempted_at',
                'label' => __('login_attempts.table.attempted_at'),
                'sortable' => true,
                'format' => 'datetime',
                'class' => 'w-1/6',
            ],
        ];
    }

    public function getTableActionsProperty()
    {
        return [
            [
                'type' => 'dropdown',
                'items' => [
                    [
                        'label' => __('common.buttons.view'),
                        'method' => 'viewAttempt',
                        'icon' => 'eye',
                    ],
                    [
                        'label' => __('login_attempts.actions.block_ip'),
                        'method' => 'blockIp',
                        'icon' => 'shield-x',
                    ],
                    [
                        'label' => __('login_attempts.actions.unblock_ip'),
                        'method' => 'unblockIp',
                        'icon' => 'shield-check',
                    ],
                    [
                        'label' => __('common.buttons.delete'),
                        'method' => 'deleteAttempt',
                        'icon' => 'trash',
                    ],
                ]
            ]
        ];
    }

    public function getDataProperty()
    {
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
    public function getTotalAttemptsProperty()
    {
        return LoginAttempt::count();
    }

    public function getSuccessfulAttemptsProperty()
    {
        return LoginAttempt::successful()->count();
    }

    public function getFailedAttemptsProperty()
    {
        return LoginAttempt::failed()->count();
    }

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

    public function getUniqueIpsProperty()
    {
        return LoginAttempt::distinct('ip_address')->count('ip_address');
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
    }

    public function unblockIp($attemptId)
    {
        $this->authorize('login_attempts_update');
        
        $attempt = LoginAttempt::findOrFail($attemptId);
        
        // Unblock all attempts from this IP
        LoginAttempt::where('ip_address', $attempt->ip_address)
            ->update([
                'is_suspicious' => false,
                'blocked_until' => null,
            ]);
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('login_attempts.messages.ip_unblocked'));
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
        $this->modalUserId = $this->editingAttempt->user_id;
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
        $this->modalUserId = '';
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
    }

    public function render()
    {
        return view('livewire.backoffice.login-attempts.index', [
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'totalAttempts' => $this->totalAttempts,
            'successfulAttempts' => $this->successfulAttempts,
            'failedAttempts' => $this->failedAttempts,
            'suspiciousAttempts' => $this->suspiciousAttempts,
            'blockedAttempts' => $this->blockedAttempts,
            'recentAttempts' => $this->recentAttempts,
            'uniqueIps' => $this->uniqueIps,
        ]);
    }
}
