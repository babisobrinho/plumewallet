<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <!-- Month Navigation -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <span class="text-lg font-semibold text-gray-800">Sep 2025</span>
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <button class="ml-2 px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700">
                        Today
                    </button>
                </div>
            </div>
            
            <!-- Ready to Assign -->
            <div class="flex items-center space-x-2">
                <div class="bg-green-500 text-white px-4 py-2 rounded-md font-semibold">
                    ${{ number_format($this->getTotalBalance(), 2) }}
                </div>
                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                    Assign
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex items-center space-x-2 mb-3">
            <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded-full">All</button>
            <button class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full">Underfunded</button>
            <button class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full">Overfunded</button>
            <button class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full">Money Available</button>
            <button class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full">Snoozed</button>
            <button class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full">férias</button>
        </div>

        <!-- Actions -->
        <div class="flex items-center space-x-4 text-sm">
            <button class="text-blue-600 hover:text-blue-800 font-medium">+ Category Group</button>
            <button class="text-gray-600 hover:text-gray-800">Undo</button>
            <button class="text-gray-600 hover:text-gray-800">Redo</button>
            <button class="text-gray-600 hover:text-gray-800">Recent Moves</button>
        </div>
    </div>

    <!-- Budget Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATEGORY</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ASSIGNED</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIVITY</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">AVAILABLE</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">PAYMENT</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categoryGroups as $group)
                    <!-- Group Header -->
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td class="px-6 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center space-x-2">
                                <button wire:click="toggleGroup({{ $group->id }})" class="p-1 hover:bg-gray-300 rounded">
                                    <svg class="w-4 h-4 text-gray-600 transition-transform duration-200 {{ $this->isGroupExpanded($group->id) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <span class="text-sm font-semibold text-gray-900">{{ $group->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900">
                            ${{ number_format($group->categories->sum('assigned_amount'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900">
                            ${{ number_format($group->categories->sum('activity'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900">
                            ${{ number_format($group->categories->sum('balance'), 2) }}
                        </td>
                        <td class="px-6 py-3 text-right text-sm font-semibold text-gray-900">
                            ${{ number_format($group->categories->sum('payment'), 2) }}
                        </td>
                    </tr>

                    <!-- Categories (only show if group is expanded) -->
                    @if($this->isGroupExpanded($group->id))
                        @foreach($group->categories as $category)
                        <tr class="hover:bg-gray-50">
                            <!-- Checkbox -->
                            <td class="px-6 py-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            
                            <!-- Category Name -->
                            <td class="px-6 py-3">
                                <div class="flex items-center space-x-2 pl-6">
                                    <!-- Category Icon -->
                                    <div class="w-4 h-4 bg-gray-400 rounded-sm flex items-center justify-center">
                                        <span class="text-xs text-white font-bold">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-900">{{ $category->name }}</span>
                                    
                                    <!-- Progress Bar for some categories -->
                                    @if($category->assigned_amount > 0 && $category->balance > 0)
                                        <div class="ml-2 w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
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
                                    <span class="text-sm text-gray-500 italic cursor-not-allowed"
                                          title="Credit Card Payment categories are automatically calculated and cannot be manually edited.">
                                        ${{ number_format($category->assigned_amount, 2) }}
                                    </span>
                                    <span class="text-xs text-gray-400 ml-1" title="Auto-calculated">🔒</span>
                                @elseif($editingCategoryId === $category->id && $editingField === 'assigned_amount')
                                    <!-- Editing mode -->
                                    <input type="number" 
                                           step="0.01" 
                                           wire:model="editValue"
                                           wire:blur="saveEdit"
                                           wire:keydown.enter="saveEdit"
                                           wire:keydown.escape="cancelEdit"
                                           class="w-20 text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                           autofocus>
                                @else
                                    <!-- Normal display - clickable -->
                                    <span wire:click="startEditing({{ $category->id }}, 'assigned_amount', {{ $category->assigned_amount }})"
                                          class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm text-gray-900">
                                        ${{ number_format($category->assigned_amount, 2) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Activity -->
                            <td class="px-6 py-3 text-right text-sm
                                      {{ $category->activity < 0 ? 'text-red-600' : ($category->activity > 0 ? 'text-green-600' : 'text-gray-900') }}">
                                ${{ number_format($category->activity, 2) }}
                            </td>

                            <!-- Available (Balance) -->
                            <td class="px-6 py-3 text-right">
                                @if($category->balance > 0)
                                    <span class="text-sm font-medium text-green-600 bg-green-100 px-2 py-1 rounded">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @elseif($category->balance < 0)
                                    <span class="text-sm font-medium text-red-600 bg-red-100 px-2 py-1 rounded">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @else
                                    <span class="text-sm font-medium text-gray-900">
                                        ${{ number_format($category->balance, 2) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Payment (for credit card categories) -->
                            <td class="px-6 py-3 text-right">
                                @if($this->isCreditCardPaymentCategory($category))
                                    @if($category->payment > 0)
                                        <span class="text-sm font-medium text-green-600 bg-green-100 px-2 py-1 rounded">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @elseif($category->payment < 0)
                                        <span class="text-sm font-medium text-red-600 bg-red-100 px-2 py-1 rounded">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-gray-900">
                                            ${{ number_format($category->payment, 2) }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-sm font-medium text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>