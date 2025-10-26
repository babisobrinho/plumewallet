<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
        <!-- Month Navigation -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <button wire:click="previousMonth" 
                            class="p-1 hover:bg-gray-200 rounded transition-colors">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $this->getCurrentMonthName() }}</span>
                    <button wire:click="nextMonth" 
                            class="p-1 hover:bg-gray-200 rounded transition-colors">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <button wire:click="goToToday" 
                            class="ml-2 px-3 py-1 text-sm rounded-md text-gray-700 transition-colors {{ $this->isCurrentMonth() ? 'bg-blue-200 text-blue-800' : 'bg-gray-200 hover:bg-gray-300' }}">
                        {{ __('common.transactions.today') }}
                    </button>
                </div>
            </div>
            
            <!-- Ready to Assign -->
            <div class="flex items-center space-x-2">
                <div class="bg-green-500 text-white px-4 py-2 rounded-md font-semibold">
                    ${{ number_format($this->getReadyToAssign(), 2) }}
                </div>
                <button wire:click="openAssignModal" 
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    {{ __('common.transactions.assign') }}
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex items-center space-x-2 mb-3">
            <button wire:click="setFilter('all')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.terms.all') }}
            </button>
            <button wire:click="setFilter('underfunded')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'underfunded' ? 'bg-red-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.budget.underfunded') }}
            </button>
            <button wire:click="setFilter('overfunded')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'overfunded' ? 'bg-green-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.budget.overfunded') }}
            </button>
            <button wire:click="setFilter('money_available')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'money_available' ? 'bg-emerald-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.budget.money_available') }}
            </button>
            <button wire:click="setFilter('snoozed')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'snoozed' ? 'bg-yellow-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.budget.snoozed') }}
            </button>
            <button wire:click="setFilter('vacation')" 
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $activeFilter === 'vacation' ? 'bg-purple-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                {{ __('common.budget.vacation') }}
            </button>
        </div>

        @if($activeFilter !== 'all')
            <div class="bg-blue-50 border-l-4 border-blue-400 p-3 mb-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-blue-700">
                        <strong>Filter Active:</strong> {{ ucfirst(str_replace('_', ' ', $activeFilter)) }} 
                        ({{ $this->getDisplayedCategoryGroups()->sum(function($group) { return $group->categories->count(); }) }} categories)
                    </p>
                    <button wire:click="setFilter('all')" 
                            class="ml-auto text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                        Clear Filter
                    </button>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex items-center space-x-4 text-sm">
            <button wire:click="openCategoryModal" 
                    class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span>+ {{ __('common.transactions.category') }}</span>
            </button>
            
        </div>
        
        <!-- Undo/Redo/Recent Moves -->
        <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
            <button wire:click="undo" 
                    class="hover:text-gray-800 dark:hover:text-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    @if($historyIndex < 0) disabled @endif>
                {{ __('common.transactions.undo') }}
            </button>
            <button wire:click="redo" 
                    class="hover:text-gray-800 dark:hover:text-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    @if($historyIndex >= count($history) - 1) disabled @endif>
                {{ __('common.transactions.redo') }}
            </button>
            <button wire:click="$toggle('showRecentMoves')" 
                    class="hover:text-gray-800 dark:hover:text-gray-200">
                {{ __('common.transactions.recent_moves') }}
            </button>
        </div>
    </div>

    <!-- Budget Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-8"></th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('common.transactions.category') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('common.transactions.assigned') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('common.transactions.activity') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('common.transactions.available') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('common.transactions.payment') }}</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-10">{{ __('common.terms.actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @if($this->getDisplayedCategoryGroups()->isEmpty())
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center space-y-4">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div class="text-gray-500 dark:text-gray-400">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No categories found for {{ $this->getCurrentMonthName() }}</h3>
                                    <p class="text-sm">Categories are created when you add transactions or create them manually.</p>
                                    <p class="text-sm mt-1">Try navigating to a different month or create new categories.</p>
                                </div>
                                <div class="flex space-x-3">
                                    <button wire:click="goToToday" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                        Go to Current Month
                                    </button>
                                    <button wire:click="openCategoryModal" 
                                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                                        {{ __('common.buttons.new') }} {{ __('common.transactions.category') }}
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach($this->getDisplayedCategoryGroups() as $group)
                    <!-- Group Header -->
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600"
                        data-group-id="{{ $group->id }}"
                        ondragover="handleDragOver(event)"
                        ondrop="handleDrop(event)">
                        <td class="px-6 py-3">
                            <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center space-x-2">
                                <button wire:click="toggleGroup({{ $group->id }})" class="p-1 hover:bg-gray-300 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400 transition-transform duration-200 {{ $this->isGroupExpanded($group->id) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $group->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                            ${{ number_format($group->categories->sum('assigned_amount'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                            ${{ number_format($group->categories->sum('activity'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                            ${{ number_format($group->categories->sum('balance'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                            ${{ number_format($group->categories->sum('payment'), 2) }}
                        </td>
                        <td class="px-6 py-3"></td>
                    </tr>

                    <!-- Categories (only show if group is expanded) -->
                    @if($this->isGroupExpanded($group->id))
                        @foreach($group->categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700" 
                            draggable="true" 
                            data-category-id="{{ $category->id }}"
                            data-group-id="{{ $group->id }}"
                            ondragstart="handleDragStart(event)"
                            ondragend="handleDragEnd(event)">
                            <!-- Checkbox -->
                            <td class="px-6 py-3">
                                <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500">
                            </td>
                            
                            <!-- Category Name -->
                            <td class="px-6 py-3">
                                <div class="flex items-center space-x-2 pl-6">
                                    <!-- Drag Handle -->
                                    <div class="cursor-move text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                        </svg>
                                    </div>
                                    <!-- Category Icon -->
                                    <div class="w-4 h-4 bg-gray-400 dark:bg-gray-500 rounded-sm flex items-center justify-center">
                                        <span class="text-xs text-white font-bold">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-900 dark:text-gray-100">{{ $category->name }}</span>
                                    
                                    <!-- Progress Bar for some categories -->
                                    @if($category->assigned_amount > 0 && $category->balance > 0)
                                        <div class="ml-2 w-16 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-green-500 rounded-full" 
                                                 style="width: {{ min(100, ($category->balance / $category->assigned_amount) * 100) }}%"></div>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Assigned Amount -->
                            <td class="px-6 py-3 text-right">
                                @if($this->isProtectedCategory($category))
                                    <!-- Protected category - not editable -->
                                    <span class="text-sm text-gray-500 dark:text-gray-400 italic cursor-not-allowed"
                                          title="Credit Card Payment categories are automatically calculated and cannot be manually edited.">
                                        ${{ number_format($category->assigned_amount, 2) }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500 ml-1" title="Auto-calculated">🔒</span>
                                @elseif($editingCategoryId === $category->id && $editingField === 'assigned_amount')
                                    <!-- Editing mode -->
                                    <input type="number" 
                                           step="0.01" 
                                           wire:model="editValue"
                                           wire:blur="saveEdit"
                                           wire:keydown.enter="saveEdit"
                                           wire:keydown.escape="cancelEdit"
                                           class="w-20 text-right border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                           autofocus>
                                @else
                                    <!-- Normal display - clickable -->
                                    <span wire:click="startEditing({{ $category->id }}, 'assigned_amount', {{ $category->assigned_amount }})"
                                          class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 px-2 py-1 rounded text-sm text-gray-900 dark:text-gray-100">
                                        ${{ number_format($category->assigned_amount, 2) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Activity -->
                            <td class="px-6 py-3 text-right text-sm
                                      {{ $category->activity < 0 ? 'text-red-600 dark:text-red-400' : ($category->activity > 0 ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-gray-100') }}">
                                ${{ number_format($category->activity, 2) }}
                            </td>

                            <!-- Available (Balance) -->
                            <td class="px-6 py-3 text-right">
                                @if($category->balance > 0)
                                    <span class="text-sm font-medium text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-1 rounded">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @elseif($category->balance < 0)
                                    <span class="text-sm font-medium text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900/20 px-2 py-1 rounded">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @else
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Payment (for credit card categories) -->
                            <td class="px-6 py-3 text-right">
                                @if($this->isCreditCardPaymentCategory($category))
                                    @if($category->payment > 0)
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-1 rounded">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @elseif($category->payment < 0)
                                        <span class="text-sm font-medium text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900/20 px-2 py-1 rounded">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-sm font-medium text-gray-400 dark:text-gray-500">—</span>
                                @endif
                            </td>

                            <!-- Actions Column -->
                            <td class="px-6 py-3 text-center">
                                @if(!$this->isProtectedCategory($category))
                                    <button wire:click="deleteCategory({{ $category->id }})" 
                                            wire:confirm="Are you sure you want to delete this category?"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 transition-colors"
                                            title="Delete category">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Category Group Modal -->
    @if($showCategoryGroupModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Category Group</h3>
                    
                    <form wire:submit.prevent="saveCategoryGroup">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Group Name</label>
                            <input type="text" wire:model="newCategoryGroup.name" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g., Emergency Fund, Vacation, etc.">
                            @error('newCategoryGroup.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="newCategoryGroup.is_hidden" 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Hide this group</span>
                            </label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="closeCategoryGroupModal" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Create Group
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Category Modal -->
    @if($showCategoryModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Category</h3>
                    
                    <form wire:submit.prevent="saveCategory">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input type="text" wire:model="newCategory.name" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g., Groceries, Gas, Entertainment, etc.">
                            @error('newCategory.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Initial Assigned Amount</label>
                            <input type="number" step="0.01" wire:model="newCategory.assigned_amount" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                            @error('newCategory.assigned_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="closeCategoryModal" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                {{ __('common.buttons.new') }} {{ __('common.transactions.category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Assign Modal -->
    @if($showAssignModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Assign Money to Category</h3>
                    
                    <form wire:submit.prevent="assignMoney">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount to Assign</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" 
                                       step="0.01" 
                                       min="0.01" 
                                       max="{{ $this->getMaxAssignAmount() }}"
                                       wire:model="assignAmount" 
                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="0.00">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                Available: ${{ number_format($this->getReadyToAssign(), 2) }}
                            </p>
                            @error('assignAmount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assign to Category</label>
                            <select wire:model="assignToCategory" 
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a category</option>
                                @foreach($availableCategories as $category)
                                    <option value="{{ $category['id'] }}">
                                        {{ $category['name'] }} ({{ $category['group_name'] }}) - Current: ${{ number_format($category['current_assigned'], 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assignToCategory') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="closeAssignModal" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Assign Money
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Recent Moves Modal -->
    @if($showRecentMoves)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Moves</h3>
                        <button wire:click="$set('showRecentMoves', false)" 
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="max-h-64 overflow-y-auto">
                        @if(count($this->getRecentMoves()) > 0)
                            @foreach($this->getRecentMoves() as $index => $move)
                                <div class="flex items-center justify-between py-2 px-3 mb-2 bg-gray-50 dark:bg-gray-700 rounded">
                                    <div class="flex-1">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            @switch($move['action'])
                                                @case('move_category')
                                                    Moved "{{ $move['data']['category_name'] }}" to "{{ $move['data']['group_name'] }}"
                                                    @break
                                                @case('edit_assigned')
                                                    Changed "{{ $move['data']['category_name'] }}" assigned amount
                                                    @break
                                                @case('assign_money')
                                                    Assigned ${{ number_format($move['data']['amount'], 2) }} to "{{ $move['data']['category_name'] }}"
                                                    @break
                                            @endswitch
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($move['timestamp'])->diffForHumans() }}
                                        </div>
                                    </div>
                                    @if($index <= $historyIndex)
                                        <button wire:click="undo" 
                                                class="ml-2 px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Undo
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                No recent moves
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
let draggedElement = null;
let draggedCategoryId = null;
let draggedGroupId = null;

function handleDragStart(event) {
    draggedElement = event.target;
    draggedCategoryId = event.target.getAttribute('data-category-id');
    draggedGroupId = event.target.getAttribute('data-group-id');
    
    // Adicionar classe de drag
    event.target.classList.add('opacity-50', 'bg-blue-100', 'dark:bg-blue-900');
    
    // Definir dados do drag
    event.dataTransfer.effectAllowed = 'move';
    event.dataTransfer.setData('text/html', event.target.outerHTML);
}

function handleDragEnd(event) {
    // Remover classes de drag
    event.target.classList.remove('opacity-50', 'bg-blue-100', 'dark:bg-blue-900');
    
    // Limpar variáveis
    draggedElement = null;
    draggedCategoryId = null;
    draggedGroupId = null;
}

function handleDragOver(event) {
    event.preventDefault();
    event.dataTransfer.dropEffect = 'move';
    
    // Adicionar feedback visual
    event.currentTarget.classList.add('bg-blue-50', 'dark:bg-blue-900/20');
}

function handleDragLeave(event) {
    // Remover feedback visual
    event.currentTarget.classList.remove('bg-blue-50', 'dark:bg-blue-900/20');
}

function handleDrop(event) {
    event.preventDefault();
    
    // Remover feedback visual
    event.currentTarget.classList.remove('bg-blue-50', 'dark:bg-blue-900/20');
    
    const targetGroupId = event.currentTarget.getAttribute('data-group-id');
    
    // Verificar se está movendo para um grupo diferente
    if (targetGroupId && draggedCategoryId && targetGroupId !== draggedGroupId) {
        // Chamar método Livewire para mover categoria
        @this.call('moveCategoryToGroup', draggedCategoryId, targetGroupId);
    }
}

// Adicionar event listeners para drag leave
document.addEventListener('DOMContentLoaded', function() {
    const groupRows = document.querySelectorAll('[data-group-id]');
    groupRows.forEach(row => {
        row.addEventListener('dragleave', handleDragLeave);
    });
});
</script>