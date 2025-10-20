<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Transactions</h2>
            <button
                wire:click="addRow"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors"
                {{ $showNewRow ? 'disabled opacity-50' : '' }}
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add Transaction</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payee/Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cleared</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <!-- New Transaction Row -->
            @if($showNewRow)
                <tr class="bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="date" wire:model="newTransaction.date"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select wire:model="newTransaction.account_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" wire:model="newTransaction.description" placeholder="Description"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select wire:model="newTransaction.category_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->group->name }}: {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" step="0.01" wire:model="newTransaction.amount" placeholder="0.00"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" wire:model="newTransaction.is_cleared"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button wire:click="saveNewTransaction"
                                class="text-green-600 hover:text-green-900">Save</button>
                        <button wire:click="cancelNewTransaction"
                                class="text-gray-600 hover:text-gray-900">Cancel</button>
                    </td>
                </tr>
            @endif

            <!-- Existing Transactions -->
            @foreach($transactions as $transaction)
                <tr class="hover:bg-gray-50">
                    <!-- Date -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($editingId === $transaction->id && $editingField === 'date')
                            <input type="date" wire:model="editValue"
                                   wire:blur="saveEdit($event.target.value)"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   autofocus>
                        @else
                            <span wire:click="startEdit({{ $transaction->id }}, 'date')"
                                  class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                {{ $transaction->date->format('M j, Y') }}
                            </span>
                        @endif
                    </td>

                    <!-- Account -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $transaction->account->name }}
                    </td>

                    <!-- Description -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($editingId === $transaction->id && $editingField === 'description')
                            <input type="text" wire:model="editValue"
                                   wire:blur="saveEdit($event.target.value)"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   autofocus>
                        @else
                            <span wire:click="startEdit({{ $transaction->id }}, 'description')"
                                  class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                {{ $transaction->description }}
                            </span>
                        @endif
                    </td>

                    <!-- Category -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($editingId === $transaction->id && $editingField === 'category_id')
                            <select wire:model="editValue"
                                    wire:change="saveEdit($event.target.value)"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    autofocus>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->group->name }}: {{ $category->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <span wire:click="startEdit({{ $transaction->id }}, 'category_id')"
                                  class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                {{ $transaction->category->group->name }}: {{ $transaction->category->name }}
                            </span>
                        @endif
                    </td>

                    <!-- Amount -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                              {{ $transaction->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
                        @if($editingId === $transaction->id && $editingField === 'amount')
                            <input type="number" step="0.01" wire:model="editValue"
                                   wire:blur="saveEdit($event.target.value)"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   autofocus>
                        @else
                            <span wire:click="startEdit({{ $transaction->id }}, 'amount')"
                                  class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                ${{ number_format(abs($transaction->amount), 2) }}
                            </span>
                        @endif
                    </td>

                    <!-- Cleared -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <input type="checkbox" {{ $transaction->is_cleared ? 'checked' : '' }}
                        wire:change="toggleCleared({{ $transaction->id }})"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="deleteTransaction({{ $transaction->id }})"
                                wire:confirm="Are you sure you want to delete this transaction?"
                                class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
