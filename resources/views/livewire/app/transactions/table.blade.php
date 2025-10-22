<div class="bg-white min-h-screen">
    <!-- Notification Bar -->
    <div class="bg-purple-600 text-white px-4 py-2 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm font-medium">{{ $transactions->where('category_id', null)->count() }} new transaction to approve or categorize.</span>
        </div>
        <button class="bg-purple-700 hover:bg-purple-800 px-3 py-1 rounded text-sm font-medium transition-colors">
            View
        </button>
    </div>

    <!-- Main Header -->
    <div class="px-6 py-6 border-b border-gray-200">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ __('common.transactions.all_accounts') }}</h1>
        
        <!-- Balance Summary -->
        <div class="grid grid-cols-3 gap-8 mb-6">
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">
                    {{ $this->getClearedBalance() < 0 ? '-' : '' }}${{ number_format(abs($this->getClearedBalance()), 2) }}
                </div>
                <div class="text-sm text-gray-500 mt-1">{{ __('common.transactions.cleared_balance') }}</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">
                    {{ $this->getUnclearedBalance() < 0 ? '-' : '+' }}${{ number_format(abs($this->getUnclearedBalance()), 2) }}
                </div>
                <div class="text-sm text-gray-500 mt-1">{{ __('common.transactions.uncleared_balance') }}</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">
                    {{ $this->getWorkingBalance() < 0 ? '-' : '' }}${{ number_format(abs($this->getWorkingBalance()), 2) }}
                </div>
                <div class="text-sm text-gray-500 mt-1">{{ __('common.transactions.working_balance') }}</div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <button wire:click="addRow" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>{{ __('common.transactions.add_transaction') }}</span>
                </button>
                
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>{{ __('common.transactions.file_import') }}</span>
                </button>
                
                <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                    <span>{{ __('common.transactions.undo') }}</span>
                </button>
                
                <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10h7a8 8 0 018 8v2M13 10l-6 6m6-6l-6-6"></path>
                    </svg>
                    <span>{{ __('common.transactions.redo') }}</span>
                </button>
            </div>
            
            <div class="flex items-center space-x-4">
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>{{ __('common.transactions.view') }}</option>
                </select>
                
                <div class="relative">
                    <input type="text" placeholder="{{ __('common.search.placeholder') }}" 
                           class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACCOUNT</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATE</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PAYEE</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATEGORY</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">MEMO</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">OUTFLOW</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">INFLOW</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- New Transaction Row -->
                @if($showNewRow)
                    <tr class="bg-blue-50 border-l-4 border-blue-500">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-4 py-3">
                            <div class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <select wire:model="newTransaction.account_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <input type="date" wire:model="newTransaction.date"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" wire:model="newTransaction.description" placeholder="Payee"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <select wire:model="newTransaction.category_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">{{ __('common.buttons.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->group->name }}: {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" placeholder="Memo"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </td>
                        <td class="px-4 py-3 text-right">
                            <input type="number" step="0.01" placeholder="0.00"
                                   class="w-full text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </td>
                        <td class="px-4 py-3 text-right">
                            <input type="number" step="0.01" placeholder="0.00"
                                   class="w-full text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button wire:click="saveNewTransaction"
                                        class="text-green-600 hover:text-green-800 text-sm font-medium">{{ __('common.buttons.save') }}</button>
                                <button wire:click="cancelNewTransaction"
                                        class="text-gray-600 hover:text-gray-800 text-sm font-medium">{{ __('common.buttons.cancel') }}</button>
                            </div>
                        </td>
                    </tr>
                @endif

                <!-- Existing Transactions -->
                @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-50 {{ $transaction->category_id === null ? 'bg-yellow-50' : '' }}">
                        <!-- Checkbox -->
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        
                        <!-- Info Icon -->
                        <td class="px-4 py-3">
                            @if($transaction->category_id === null)
                                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <!-- Account -->
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="flex items-center space-x-2">
                                <span>{{ $transaction->account->name }}</span>
                                @if($transaction->transactionable_type === 'App\Models\Account')
                                    <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                @endif
                            </div>
                        </td>

                        <!-- Date -->
                        <td class="px-4 py-3 text-sm text-gray-900">
                            @if($editingId === $transaction->id && $editingField === 'date')
                                <input type="date" wire:model="editValue"
                                       wire:blur="saveEdit($event.target.value)"
                                       wire:keydown.enter="saveEdit($event.target.value)"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       autofocus>
                            @else
                                <span wire:click="startEdit({{ $transaction->id }}, 'date')"
                                      class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm">
                                    {{ $transaction->date->format('m/d/Y') }}
                                </span>
                            @endif
                        </td>

                        <!-- Payee -->
                        <td class="px-4 py-3 text-sm text-gray-900">
                            @if($editingId === $transaction->id && $editingField === 'description')
                                <input type="text" wire:model="editValue"
                                       wire:blur="saveEdit($event.target.value)"
                                       wire:keydown.enter="saveEdit($event.target.value)"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       autofocus>
                            @else
                                <span wire:click="startEdit({{ $transaction->id }}, 'description')"
                                      class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm">
                                    {{ $transaction->description }}
                                </span>
                            @endif
                        </td>

                        <!-- Category -->
                        <td class="px-4 py-3 text-sm">
                            @if($transaction->category_id === null)
                                <div class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs font-medium">
                                    This needs a category
                                </div>
                            @elseif($editingId === $transaction->id && $editingField === 'category_id')
                                <select wire:model="editValue"
                                        wire:change="saveEdit($event.target.value)"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        autofocus>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->group->name }}: {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <div wire:click="startEdit({{ $transaction->id }}, 'category_id')"
                                     class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm">
                                    <div class="flex items-center space-x-2">
                                        @if($transaction->category->group->name === 'Essential Expenses')
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM8 15v-6h4v6H8z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($transaction->category->group->name === 'Non-Essential Expenses')
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                            </svg>
                                        @elseif($transaction->category->group->name === 'Income')
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        <span>{{ $transaction->category->group->name }}: {{ $transaction->category->name }}</span>
                                    </div>
                                </div>
                            @endif
                        </td>

                        <!-- Memo -->
                        <td class="px-4 py-3 text-sm text-gray-500">
                            @if($transaction->description === 'Starting Balance' || $transaction->description === 'Reconciliation Balance Adjustment')
                                Entered automatically by YNAB
                            @else
                                {{ $transaction->description }}
                            @endif
                        </td>

                        <!-- Outflow -->
                        <td class="px-4 py-3 text-right text-sm font-medium">
                            @if($transaction->amount < 0)
                                @if($editingId === $transaction->id && $editingField === 'amount')
                                    <input type="number" step="0.01" wire:model="editValue"
                                           wire:blur="saveEdit($event.target.value)"
                                           wire:keydown.enter="saveEdit($event.target.value)"
                                           class="w-full text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                           autofocus>
                                @else
                                    <span wire:click="startEdit({{ $transaction->id }}, 'amount')"
                                          class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm">
                                        ${{ number_format(abs($transaction->amount), 2) }}
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        <!-- Inflow -->
                        <td class="px-4 py-3 text-right text-sm font-medium">
                            @if($transaction->amount > 0)
                                @if($editingId === $transaction->id && $editingField === 'amount')
                                    <input type="number" step="0.01" wire:model="editValue"
                                           wire:blur="saveEdit($event.target.value)"
                                           wire:keydown.enter="saveEdit($event.target.value)"
                                           class="w-full text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                           autofocus>
                                @else
                                    <span wire:click="startEdit({{ $transaction->id }}, 'amount')"
                                          class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded text-sm">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        <!-- Status Icon -->
                        <td class="px-4 py-3 text-center">
                            @if($transaction->is_reconciled)
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            @elseif($transaction->is_cleared)
                                <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                            @else
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full"></div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>