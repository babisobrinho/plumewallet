<?php

namespace App\Livewire\Backoffice\ContactForms;

use App\Enums\ContactFormStatus;
use App\Enums\ContactFormSubject;
use App\Models\ContactForm;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    // Search and filters
    public $search = '';
    public $filters = [
        'status' => '',
        'subject' => '',
    ];

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function mount()
    {
        $this->authorize('contact_forms_read');
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'status',
                'label' => __('common.labels.status'),
                'type' => 'select',
                'placeholder' => __('contact.filters.all_status'),
                'options' => ContactFormStatus::options()
            ],
            [
                'key' => 'subject',
                'label' => __('contact.labels.subject'),
                'type' => 'select',
                'placeholder' => __('contact.filters.all_subjects'),
                'options' => ContactFormSubject::options()
            ],
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'process_number',
                'label' => __('contact.labels.process_number'),
                'sortable' => true,
            ],
            [
                'key' => 'name',
                'label' => __('contact.labels.name'),
                'sortable' => true,
            ],
            [
                'key' => 'email',
                'label' => __('contact.labels.email'),
                'sortable' => true,
            ],
            [
                'key' => 'subject',
                'label' => __('contact.labels.subject'),
                'sortable' => false,
            ],
            [
                'key' => 'status',
                'label' => __('common.labels.status'),
                'sortable' => true,
            ],
            [
                'key' => 'created_at',
                'label' => __('common.labels.created_at'),
                'format' => 'datetime',
                'sortable' => true,
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
                        'url' => 'backoffice.contact-forms.show',
                        'icon' => 'eye',
                        'params' => ['contactForm' => 'id'],
                    ],
                ]
            ]
        ];
    }

    // Metric properties
    public function getTotalContactFormsProperty()
    {
        return ContactForm::count();
    }

    public function getNewContactFormsProperty()
    {
        return ContactForm::where('status', ContactFormStatus::NEW)->count();
    }

    public function getInProgressContactFormsProperty()
    {
        return ContactForm::where('status', ContactFormStatus::IN_PROGRESS)->count();
    }

    public function getResolvedContactFormsProperty()
    {
        return ContactForm::where('status', ContactFormStatus::RESOLVED)->count();
    }

    public function getDataProperty()
    {
        $query = ContactForm::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('process_number', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['status'], function($query) {
                $query->where('status', $this->filters['status']);
            })
            ->when($this->filters['subject'], function($query) {
                $query->where('subject', $this->filters['subject']);
            });

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    public function clearFilters()
    {
        $this->reset(['search']);
        $this->reset(['filters']);
        $this->resetPage();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.backoffice.contact-forms.index', [
            'data' => $this->data,
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'totalContactForms' => $this->totalContactForms,
            'newContactForms' => $this->newContactForms,
            'inProgressContactForms' => $this->inProgressContactForms,
            'resolvedContactForms' => $this->resolvedContactForms,
        ]);
    }
}
