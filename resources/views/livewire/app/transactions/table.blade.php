<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="w-full py-4 sm:py-8">
        <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
            <!-- Sidebar -->
            <div class="lg:w-64 flex-shrink-0 px-4 sm:px-4 lg:px-6">
                <!-- Account Summary Card -->
                <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-xs border border-gray-100 dark:border-gray-700 mb-3">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-3">
                            <div class="h-20 w-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center border-2 border-white dark:border-gray-800">
                                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('common.transactions.accounts') }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ trans_choice('common.transactions.accounts_count', $accounts->count(), ['count' => $accounts->count()]) }} • ${{ number_format($this->getWorkingBalance(), 2) }} total</p>
                    </div>
        </div>

                <!-- Create Account Button -->
                <div class="mb-3">
                    <button wire:click="openAccountModal" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl flex items-center justify-center space-x-2 transition-colors font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>{{ __('common.buttons.new') }} {{ __('common.transactions.account') }}</span>
        </button>
    </div>

                <!-- Navigation Menu -->
                <div class="sticky top-8 space-y-1 p-1 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <!-- All Accounts Option -->
                    <button wire:click="showAllAccounts" 
                            class="w-full flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium transition-colors {{ $selectedAccountId === null ? 'bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">{{ __('common.transactions.all_accounts') }}</span>
                    </button>

                    <!-- Individual Accounts -->
                    @foreach($accounts as $account)
                        <button wire:click="selectAccount({{ $account->id }})" 
                                class="w-full flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium transition-colors {{ $selectedAccountId === $account->id ? 'bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                            <div class="h-5 w-5 mr-3 flex items-center justify-center">
                                @if($account->type->value === 'checking')
                                    <svg class="h-5 w-5 {{ $account->isCreditAccount() ? 'text-red-500' : 'text-green-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                                    </svg>
                                @elseif($account->type->value === 'savings')
                                    <svg class="h-5 w-5 {{ $account->isCreditAccount() ? 'text-red-500' : 'text-green-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                @elseif($account->type->value === 'credit_card')
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 {{ $account->isCreditAccount() ? 'text-red-500' : 'text-green-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            <span class="font-medium">{{ $account->name }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 space-y-4 sm:space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 px-4 sm:px-4 lg:px-6">
                    <!-- Header -->
                    <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h1 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">
                                    @if($selectedAccountId)
                                        {{ $accounts->where('id', $selectedAccountId)->first()->name ?? __('common.transactions.account') }} {{ __('common.transactions.title') }}
                                    @else
                                        {{ __('common.transactions.all_accounts') }}
                                    @endif
                                </h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ trans_choice('common.transactions.accounts_count', $transactions->count(), ['count' => $transactions->count()]) }} • 
                                    {{ __('common.transactions.working_balance') }}: ${{ number_format($this->getWorkingBalance(), 2) }}
                                </p>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3 flex-shrink-0">
                                <button wire:click="addRow" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>{{ __('common.transactions.add_transaction') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Bar -->
                    @if($transactions->where('category_id', null)->count() > 0)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>{{ $transactions->where('category_id', null)->count() }}</strong> transactions need to be categorized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

    <!-- Data Validation Messages -->
    @if($accounts->isEmpty())
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        No accounts found. Please create an account first.
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if($categories->isEmpty())
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        No categories found. Please create categories first.
                    </p>
                </div>
            </div>
        </div>
    @endif

                    <!-- Account Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                        <!-- Saldo Total da Conta -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800">
                            <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">
                                ${{ number_format($this->getAccountBalance(), 2) }}
                </div>
                            <div class="text-sm text-blue-600 dark:text-blue-300 mt-1">Saldo Total da Conta</div>
        </div>

                        <!-- Valores Recebidos -->
                        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                            <div class="text-2xl font-bold text-green-900 dark:text-green-100">
                                +${{ number_format($this->getTotalIncome(), 2) }}
                            </div>
                            <div class="text-sm text-green-600 dark:text-green-300 mt-1">Valores Recebidos</div>
            </div>
            
                        <!-- Valores Descontados -->
                        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4 border border-red-200 dark:border-red-800">
                            <div class="text-2xl font-bold text-red-900 dark:text-red-100">
                                -${{ number_format($this->getTotalExpenses(), 2) }}
                </div>
                            <div class="text-sm text-red-600 dark:text-red-300 mt-1">Valores Descontados</div>
        </div>
    </div>

    <!-- Transactions Table -->
                    <div class="pb-4 sm:pb-6">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.account') }}</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.date') }}</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.payee') }}</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.category') }}</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.memo') }}</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.outflow') }}</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('common.transactions.inflow') }}</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">{{ __('common.terms.actions') }}</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- New Transaction Form -->
                @if($showNewRow)
                    <tr class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500">
                        <td class="px-2 sm:px-4 py-4" colspan="10">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center mb-3 sm:mb-4">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-full flex items-center justify-center mr-2 sm:mr-3">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">{{ __('common.transactions.add_transaction') }}</h3>
                                </div>
                                
                                <form wire:submit.prevent="saveNewTransaction" class="space-y-4">
                                    <!-- Mobile Layout: Single Column -->
                                    <div class="block md:hidden space-y-4">
                                        <!-- Account -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.account') }}</label>
                            <select wire:model="newTransaction.account_id"
                                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                                            @error('newTransaction.account_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Date -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.date') }}</label>
                            <input type="date" wire:model="newTransaction.date"
                                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            @error('newTransaction.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Payee -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.payee') }}</label>
                                            <input type="text" wire:model="newTransaction.description" placeholder="Enter payee name"
                                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            @error('newTransaction.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Category -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.category') }}</label>
                            <select wire:model="newTransaction.category_id"
                                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">{{ __('common.buttons.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                                            @error('newTransaction.category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Memo -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.memo') }}</label>
                                            <input type="text" placeholder="Enter memo (optional)"
                                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                        </div>

                                        <!-- Amount Fields -->
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.outflow') }}</label>
                                                <div class="relative">
                                                    <span class="absolute left-3 top-2 text-gray-500 text-sm">$</span>
                            <input type="number" step="0.01" wire:model="newTransaction.outflow" placeholder="0.00"
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                </div>
                                                @error('newTransaction.outflow') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.transactions.inflow') }}</label>
                                                <div class="relative">
                                                    <span class="absolute left-3 top-2 text-gray-500 text-sm">$</span>
                            <input type="number" step="0.01" wire:model="newTransaction.inflow" placeholder="0.00"
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                </div>
                                                @error('newTransaction.inflow') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Desktop Layout: Multi Column -->
                                    <div class="hidden md:block space-y-4">
                                        <!-- First Row: Account, Date, Payee, Category -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                                            <!-- Account -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account</label>
                                <select wire:model="newTransaction.account_id"
                                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                                                @error('newTransaction.account_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Date -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
                                <input type="date" wire:model="newTransaction.date"
                                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                @error('newTransaction.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Payee -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payee</label>
                                                <input type="text" wire:model="newTransaction.description" placeholder="Enter payee name"
                                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                @error('newTransaction.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Category -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                                <select wire:model="newTransaction.category_id"
                                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">{{ __('common.buttons.select_category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                                @error('newTransaction.category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Second Row: Memo and Amount Fields -->
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                            <!-- Memo -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Memo</label>
                                                <input type="text" placeholder="Enter memo (optional)"
                                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                            </div>

                                            <!-- Amount Fields -->
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Outflow</label>
                                                    <div class="relative">
                                                        <span class="absolute left-3 top-2 text-gray-500 text-sm">$</span>
                                <input type="number" step="0.01" wire:model="newTransaction.outflow" placeholder="0.00"
                                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                    </div>
                                                    @error('newTransaction.outflow') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Inflow</label>
                                                    <div class="relative">
                                                        <span class="absolute left-3 top-2 text-gray-500 text-sm">$</span>
                                <input type="number" step="0.01" wire:model="newTransaction.inflow" placeholder="0.00"
                                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                                    </div>
                                                    @error('newTransaction.inflow') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2 sm:gap-3 pt-3 sm:pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button type="button" wire:click="cancelNewTransaction"
                                        class="px-3 sm:px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 text-sm font-medium transition-colors">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="px-3 sm:px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Save Transaction</span>
                                </button>
                            </div>
                                </form>
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
                        <td class="px-4 py-3 text-sm text-gray-900 break-words whitespace-normal max-w-[150px]">
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
                        <td class="px-4 py-3 text-sm text-gray-900 break-words whitespace-normal max-w-[150px]">
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
                        <td class="px-4 py-3 text-sm break-words whitespace-normal max-w-[200px]">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <span>{{ $transaction->category->name }}</span>
                                    </div>
                                </div>
                            @endif
                        </td>

                        <!-- Memo -->
                        <td class="px-4 py-3 text-sm text-gray-500 break-words whitespace-normal max-w-[150px]">
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

                        <!-- Actions -->
                        <td class="px-4 py-3 text-center">
                            <button wire:click="deleteTransaction({{ $transaction->id }})" 
                                    wire:confirm="Tem certeza que deseja excluir esta transação?"
                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 transition-colors"
                                    title="Delete transaction">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Account Creation Modal -->
    @if($showAccountModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('common.buttons.new') }} {{ __('common.transactions.account') }}</h3>
                        <button wire:click="closeAccountModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="createAccount">
                        <div class="mb-4">
                            <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                            <input type="text" 
                                   wire:model="newAccount.name" 
                                   id="account_name"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter account name">
                            @error('newAccount.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="account_type" class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                            <select wire:model="newAccount.type" 
                                    id="account_type"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach($accountTypes as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('newAccount.type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="account_balance" class="block text-sm font-medium text-gray-700 mb-2">Initial Balance</label>
                            <input type="number" 
                                   step="0.01" 
                                   wire:model="newAccount.balance" 
                                   id="account_balance"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                            @error('newAccount.balance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button type="button" 
                                    wire:click="closeAccountModal"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>