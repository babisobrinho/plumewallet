<?php

namespace App\Livewire\Backoffice\Logs;

use App\Models\SystemLog;
use App\Models\User;
use App\Enums\LogType;
use App\Enums\LogLevel;
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
    public $editingLog = null;

    // Form properties
    public $modalType = '';
    public $modalLevel = '';
    public $modalMessage = '';
    public $modalContext = '';
    public $modalUserId = '';
    public $modalIpAddress = '';
    public $modalUserAgent = '';
    public $modalUrl = '';
    public $modalMethod = '';

    // Filter properties
    public $search = '';
    public $filters = [
        'type' => '',
        'level' => '',
        'user' => '',
    ];

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];
    
    public function mount()
    {
        $this->authorize('logs_read');
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'type',
                'label' => __('logs.filters.type'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => LogType::options(),
            ],
            [
                'key' => 'level',
                'label' => __('logs.filters.level'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => LogLevel::options(),
            ],
            [
                'key' => 'user',
                'label' => __('logs.filters.user'),
                'type' => 'select',
                'placeholder' => __('common.terms.all'),
                'options' => User::pluck('name', 'id')->toArray(),
            ],
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'type',
                'label' => __('logs.table.type'),
                'component' => 'livewire.backoffice.logs.partials.type-badge',
                'sortable' => true,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'level',
                'label' => __('logs.table.level'),
                'component' => 'livewire.backoffice.logs.partials.level-badge',
                'sortable' => true,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'message',
                'label' => __('logs.table.message'),
                'sortable' => false,
                'class' => 'w-1/3',
                'format' => 'truncate',
                'maxLength' => 30,
            ],
            [
                'key' => 'user',
                'label' => __('logs.table.user'),
                'component' => 'livewire.backoffice.logs.partials.user-name',
                'sortable' => false,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'ip_address',
                'label' => __('logs.table.ip_address'),
                'sortable' => false,
                'class' => 'w-1/8',
            ],
            [
                'key' => 'created_at',
                'label' => __('logs.table.created_at'),
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
                'type' => 'button',
                'label' => __('common.buttons.view'),
                'method' => 'viewLog',
                'icon' => 'eye',
                'class' => 'bg-blue-600 hover:bg-blue-700 text-white',
            ]
        ];
    }

    public function getDataProperty()
    {
        $query = SystemLog::with(['user'])
            ->when($this->search, function($query) {
                $query->where('message', 'like', '%' . $this->search . '%')
                      ->orWhere('ip_address', 'like', '%' . $this->search . '%')
                      ->orWhere('url', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['type'], function($query) {
                $query->where('type', $this->filters['type']);
            })
            ->when($this->filters['level'], function($query) {
                $query->where('level', $this->filters['level']);
            })
            ->when($this->filters['user'], function($query) {
                $query->where('user_id', $this->filters['user']);
            });

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    // Metric properties
    public function getTotalLogsProperty()
    {
        return SystemLog::count();
    }

    public function getSystemLogsProperty()
    {
        return SystemLog::system()->count();
    }

    public function getAuditLogsProperty()
    {
        return SystemLog::audit()->count();
    }

    public function getApiLogsProperty()
    {
        return SystemLog::api()->count();
    }

    public function getErrorLogsProperty()
    {
        return SystemLog::errors()->count();
    }

    public function getWarningLogsProperty()
    {
        return SystemLog::warnings()->count();
    }

    public function getInfoLogsProperty()
    {
        return SystemLog::info()->count();
    }

    public function getRecentLogsProperty()
    {
        return SystemLog::where('created_at', '>=', now()->subHours(24))->count();
    }

    public function viewLog($logId)
    {
        $this->authorize('logs_read');
        
        $this->editingLog = SystemLog::findOrFail($logId);
        $this->loadLogData();
        $this->isEditing = false; // Changed to false since we're only viewing
        $this->showModal = true;
    }

    // Removed deleteLog method - logs are read-only

    public function loadLogData()
    {
        $this->modalType = $this->editingLog->type->value;
        $this->modalLevel = $this->editingLog->level->value;
        $this->modalMessage = $this->editingLog->message;
        $this->modalContext = json_encode($this->editingLog->context, JSON_PRETTY_PRINT);
        $this->modalUserId = $this->editingLog->user_id;
        $this->modalIpAddress = $this->editingLog->ip_address;
        $this->modalUserAgent = $this->editingLog->user_agent;
        $this->modalUrl = $this->editingLog->url;
        $this->modalMethod = $this->editingLog->method;
    }

    public function resetModalForm()
    {
        $this->modalType = '';
        $this->modalLevel = '';
        $this->modalMessage = '';
        $this->modalContext = '';
        $this->modalUserId = '';
        $this->modalIpAddress = '';
        $this->modalUserAgent = '';
        $this->modalUrl = '';
        $this->modalMethod = '';
        $this->editingLog = null;
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
            'type' => '',
            'level' => '',
            'user' => '',
        ];
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.backoffice.logs.index', [
            'data' => $this->data,
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'totalLogs' => $this->totalLogs,
            'systemLogs' => $this->systemLogs,
            'auditLogs' => $this->auditLogs,
            'apiLogs' => $this->apiLogs,
            'errorLogs' => $this->errorLogs,
            'warningLogs' => $this->warningLogs,
            'infoLogs' => $this->infoLogs,
            'recentLogs' => $this->recentLogs,
        ]);
    }
}
