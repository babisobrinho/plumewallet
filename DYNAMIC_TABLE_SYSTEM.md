# Dynamic Table System Documentation

## Overview
This system provides completely dynamic, reusable table functionality that can be used across all pages without any hardcoded values. The system uses a single Livewire component with dynamic properties and a flexible view template.

## Key Features

### 1. Dynamic Table System
- **No Hardcoding**: All columns, filters, and actions are defined through arrays
- **Fully Configurable**: Everything is configurable through component properties
- **Reusable**: Same pattern works for any table page
- **Performance**: No complex object serialization issues

### 2. Dynamic Components Available
- `app/Livewire/Shared/Partials/DataTable.php` - For standalone table components
- `app/Livewire/Shared/Partials/FilterBar.php` - For standalone filter components
- `app/Livewire/Shared/Partials/GenericTable.php` - For quick generic implementations

## Usage Examples

### For a Custom Table Page (like Users Index)
```php
<?php

namespace App\Livewire\Backoffice\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filters = [];
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'filters' => ['except' => []],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    protected $listeners = [
        'filterUpdated' => 'handleFilterUpdate',
        'sortUpdated' => 'handleSortUpdate',
        'filtersCleared' => 'clearFilters',
        'tableSorted' => 'handleTableSort'
    ];

    public function mount()
    {
        $this->authorize('users_read');
        $this->sortBy = 'created_at';
    }

    // Add these methods for dynamic table functionality:
    public function handleFilterUpdate($filterKey, $value) { /* ... */ }
    public function handleSortUpdate($sortBy, $sortDirection) { /* ... */ }
    public function handleTableSort($field, $direction) { /* ... */ }
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilters() { $this->resetPage(); }
    public function sortBy($field) { /* ... */ }
    public function clearFilters() { /* ... */ }

    public function getDataProperty()
    {
        // Your custom query logic here
        return User::query()
            ->when($this->search, function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
    }

    public function getTableColumnsProperty()
    {
        return [
            ['key' => 'name', 'label' => 'Name', 'sortable' => true],
            ['key' => 'email', 'label' => 'Email', 'sortable' => true],
            // ... more columns
        ];
    }

    public function getTableActionsProperty()
    {
        return [
            [
                'type' => 'dropdown',
                'items' => [
                    ['label' => 'View', 'icon' => 'eye', 'method' => 'viewUser'],
                    ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'editUser'],
                ]
            ]
        ];
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'status',
                'label' => 'Status',
                'type' => 'select',
                'options' => ['active' => 'Active', 'inactive' => 'Inactive']
            ]
        ];
    }

    public function getSortOptionsProperty()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'email', 'label' => 'Email'],
            ['field' => 'created_at', 'label' => 'Created At'],
        ];
    }
}
```

### For a Quick Generic Table
```php
@livewire('shared.partials.generic-table', [
    'model' => \App\Models\User::class,
    'columns' => [
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
    ],
    'actions' => [
        [
            'type' => 'button',
            'label' => 'Edit',
            'method' => 'editUser',
            'class' => 'bg-blue-500 text-white'
        ]
    ],
    'filterOptions' => [
        [
            'key' => 'status',
            'label' => 'Status',
            'type' => 'select',
            'options' => ['active' => 'Active', 'inactive' => 'Inactive']
        ]
    ],
    'searchFields' => ['name', 'email'],
    'perPage' => 15
])
```

## Column Configuration

### Basic Column
```php
['key' => 'name', 'label' => 'Name', 'sortable' => true]
```

### Column with Custom Format
```php
[
    'key' => 'created_at',
    'label' => 'Created At',
    'format' => 'datetime',
    'sortable' => true
]
```

### Column with Custom Component
```php
[
    'key' => 'status',
    'label' => 'Status',
    'component' => 'livewire.shared.partials.status-badge'
]
```

### Column with Custom Styling
```php
[
    'key' => 'amount',
    'label' => 'Amount',
    'format' => 'currency',
    'class' => 'text-right',
    'cellClass' => 'font-mono'
]
```

## Supported Column Formats
- `date` - Date formatting (d/m/Y)
- `datetime` - DateTime formatting (d/m/Y H:i)
- `currency` - Currency formatting (€ 0,00)
- `boolean` - Boolean with badges
- `status` - Status with custom styling

## Action Configuration

### Button Action
```php
[
    'type' => 'button',
    'label' => 'Edit',
    'icon' => 'pencil',
    'method' => 'editUser',
    'class' => 'bg-blue-500 text-white',
    'condition' => fn($item) => $item->can_edit
]
```

### Dropdown Action
```php
[
    'type' => 'dropdown',
    'items' => [
        ['label' => 'View', 'icon' => 'eye', 'method' => 'viewUser'],
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'editUser'],
        ['label' => 'Delete', 'icon' => 'trash', 'method' => 'deleteUser', 'condition' => fn($item) => $item->can_delete],
    ]
]
```

## Filter Configuration

### Select Filter
```php
[
    'key' => 'status',
    'label' => 'Status',
    'type' => 'select',
    'placeholder' => 'All Statuses',
    'options' => [
        'active' => 'Active',
        'inactive' => 'Inactive'
    ]
]
```

### Date Filter
```php
[
    'key' => 'created_at',
    'label' => 'Created Date',
    'type' => 'date'
]
```

## Benefits

1. **No Hardcoding**: Everything is configurable through properties
2. **Reusable**: Same components work across all pages
3. **Consistent**: Same look and behavior everywhere
4. **Maintainable**: Changes in one place affect all tables
5. **Flexible**: Supports custom components, formats, and actions
6. **Performance**: Optimized queries and pagination
7. **Accessible**: Proper ARIA labels and keyboard navigation

## Migration from Hardcoded Tables

1. Replace hardcoded table views with `@livewire('shared.partials.base-table')`
2. Move table logic to component properties
3. Remove hardcoded column definitions
4. Use dynamic filter and action configurations
5. Test across all pages to ensure consistency

This system ensures that all tables in your application are dynamic, maintainable, and consistent without any hardcoded values.
