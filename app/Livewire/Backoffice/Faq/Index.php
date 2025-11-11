<?php

namespace App\Livewire\Backoffice\Faq;

use App\Models\Faq;
use App\Enums\FaqCategory;
use App\Enums\Status;
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
    public $editingFaq = null;
    
    // Modal form fields
    public $modalQuestion = '';
    public $modalAnswer = '';
    public $modalCategory = 'general';
    public $modalOrder = 0;
    public $modalIsActive = true;

    // Search and filters
    public $search = '';
    public $filters = [
        'category' => '',
        'status' => '',
            // view_count column removed from FAQs
        'toggleStatus' => 'toggleStatus',
    ];
    
    public function mount()
    {
        $this->authorize('faq_read');
    }

    // Cached filter options to prevent performance issues
    private $cachedFilterOptions = null;

    public function getFilterOptionsProperty()
    {
        if ($this->cachedFilterOptions === null) {
            $this->cachedFilterOptions = [
                [
                    'key' => 'category',
                    'label' => __('faq.filters.category'),
                    'type' => 'select',
                    'placeholder' => __('faq.filters.all_categories'),
                    'options' => FaqCategory::options()
                ],
                [
                    'key' => 'status',
                    'label' => __('faq.filters.status'),
                    'type' => 'select',
                    'placeholder' => __('faq.filters.all_status'),
                    'options' => Status::options()
                ]
            ];
        }
        return $this->cachedFilterOptions;
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'question',
                'label' => __('faq.table.question'),
                'sortable' => true,
                'class' => 'w-1/3',
            ],
            [
                'key' => 'category',
                'label' => __('faq.table.category'),
                'component' => 'components.badge',
                'componentParams' => [
                    'enumClass' => \App\Enums\FaqCategory::class,
                    'noValueKey' => 'faq.no_category',
                    'field' => 'category',
                ],
                'sortable' => true,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'order',
                'label' => __('faq.table.order'),
                'sortable' => true,
                'class' => 'w-1/12',
            ],
            [
                'key' => 'is_active',
                'label' => __('faq.table.status'),
                'sortable' => true,
                'class' => 'w-1/6',
                'format' => 'boolean',
            ],
            [
                'key' => 'view_count',
                'label' => __('faq.table.views'),
                'sortable' => true,
                'class' => 'w-1/12',
            ],
            [
                'key' => 'created_at',
                'label' => __('faq.table.created_at'),
                'sortable' => true,
                'class' => 'w-1/6',
                'format' => 'date',
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
                        'label' => __('common.buttons.edit'),
                        'method' => 'editFaq',
                        'icon' => 'pencil',
                    ],
                    [
                        'label' => __('faq.actions.toggle_status'),
                        'method' => 'toggleStatus',
                        'icon' => 'toggle-right',
                    ],
                    [
                        'label' => __('common.buttons.delete'),
                        'method' => 'deleteFaq',
                        'icon' => 'trash',
                    ],
                ]
            ]
        ];
    }

    public function getDataProperty()
    {
        $query = Faq::query()
            ->when($this->search, function($query) {
                $query->where('question', 'like', '%' . $this->search . '%')
                      ->orWhere('answer', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['category'], function($query) {
                $query->where('category', $this->filters['category']);
            })
            ->when($this->filters['status'], function($query) {
                if ($this->filters['status'] === 'active') {
                    $query->where('is_active', true);
                } elseif ($this->filters['status'] === 'inactive') {
                    $query->where('is_active', false);
                }
            });

        return $query->ordered()->paginate(15);
    }

    // Cached metrics to avoid multiple database queries
    private $cachedMetrics = null;

    public function getMetricsProperty()
    {
        if ($this->cachedMetrics === null) {
            $this->cachedMetrics = [
                'total' => Faq::count(),
                'active' => Faq::where('is_active', true)->count(),
                'inactive' => Faq::where('is_active', false)->count(),
            ];
        }
        return $this->cachedMetrics;
    }

    // Metric properties (now using cached data)
    public function getTotalFaqsProperty()
    {
        return $this->metrics['total'];
    }

    public function getActiveFaqsProperty()
    {
        return $this->metrics['active'];
    }

    public function getInactiveFaqsProperty()
    {
        return $this->metrics['inactive'];
    }

    public function getTotalViewsProperty()
    {
        // view_count was removed; return 0 for compatibility
        return 0;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [
            'category' => '',
            'status' => '',
        ];
        $this->resetPage();
        
        // Force UI update by dispatching a custom event
        $this->dispatch('filters-cleared');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    // Clear cached data when filters change
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFiltersCategory()
    {
        $this->resetPage();
    }

    public function updatedFiltersStatus()
    {
        $this->resetPage();
    }

    // Cache category labels to avoid repeated translation calls
    private $categoryLabels = null;

    public function getCategoryLabelsProperty()
    {
        if ($this->categoryLabels === null) {
            $this->categoryLabels = [];
            foreach (FaqCategory::cases() as $category) {
                $this->categoryLabels[$category->value] = FaqCategory::label($category);
            }
        }
        return $this->categoryLabels;
    }

    public function sortColumn($column)
    {
        // Implement sorting logic if needed
    }

    public function createFaq()
    {
        $this->authorize('faq_create');
        
        $this->isEditing = false;
        $this->editingFaq = null;
        $this->resetModalForm();
        $this->showModal = true;
    }

    public function editFaq($faqId)
    {
        $this->authorize('faq_update');
        
        $this->isEditing = true;
        $this->editingFaq = Faq::findOrFail($faqId);
        $this->loadFaqData();
        $this->showModal = true;
    }

    public function deleteFaq($faqId)
    {
        $this->authorize('faq_delete');
        
        $faq = Faq::findOrFail($faqId);
        $faq->delete();
        
        // Clear cached metrics
        $this->cachedMetrics = null;
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('faq.messages.deleted_successfully'));
    }

    public function toggleStatus($faqId)
    {
        $this->authorize('faq_update');
        
        $faq = Faq::findOrFail($faqId);
        $faq->update(['is_active' => !$faq->is_active]);
        
        // Clear cached metrics
        $this->cachedMetrics = null;
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('faq.messages.status_toggled'));
    }

    public function saveFaq()
    {
        $this->validate([
            'modalQuestion' => ['required', 'string', 'max:500'],
            'modalAnswer' => ['required', 'string'],
            'modalCategory' => ['required', 'in:' . implode(',', FaqCategory::values())],
            'modalOrder' => ['required', 'integer', 'min:0'],
            'modalIsActive' => ['boolean'],
        ]);

        if ($this->isEditing) {
            $this->updateFaq();
        } else {
            $this->createFaqData();
        }

        $this->closeModal();
        $this->dispatch('refreshTable');
    }

    public function createFaqData()
    {
        Faq::create([
            'question' => $this->modalQuestion,
            'answer' => $this->modalAnswer,
            'category' => FaqCategory::from($this->modalCategory),
            'order' => $this->modalOrder,
            'is_active' => $this->modalIsActive,
        ]);

        // Clear cached metrics
        $this->cachedMetrics = null;

        session()->flash('message', __('faq.messages.created_successfully'));
    }

    public function updateFaq()
    {
        $this->editingFaq->update([
            'question' => $this->modalQuestion,
            'answer' => $this->modalAnswer,
            'category' => FaqCategory::from($this->modalCategory),
            'order' => $this->modalOrder,
            'is_active' => $this->modalIsActive,
        ]);

        // Clear cached metrics
        $this->cachedMetrics = null;

        session()->flash('message', __('faq.messages.updated_successfully'));
    }

    public function loadFaqData()
    {
        $this->modalQuestion = $this->editingFaq->question;
        $this->modalAnswer = $this->editingFaq->answer;
        $this->modalCategory = $this->editingFaq->category->value;
        $this->modalOrder = $this->editingFaq->order;
        $this->modalIsActive = $this->editingFaq->is_active;
    }

    public function resetModalForm()
    {
        $this->modalQuestion = '';
        $this->modalAnswer = '';
        $this->modalCategory = 'general';
        $this->modalOrder = 0;
        $this->modalIsActive = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetModalForm();
    }

    public function render()
    {
        return view('livewire.backoffice.faq.index', [
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'data' => $this->data,
            'totalFaqs' => $this->totalFaqs,
            'activeFaqs' => $this->activeFaqs,
            'inactiveFaqs' => $this->inactiveFaqs,
            'totalViews' => $this->totalViews,
            'categoryLabels' => $this->categoryLabels,
        ]);
    }
}
