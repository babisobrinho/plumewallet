<x-slot name="header">
    <x-app-header
        :title="__('common.beneficiaries.title')"
        :subtitle="__('common.beneficiaries.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('common.beneficiaries.title') }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('common.beneficiaries.header_description') }}
                </p>
            </div>
            <button wire:click="openModal()" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('common.beneficiaries.add_beneficiary') }}
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search"
                           placeholder="{{ __('common.beneficiaries.search_placeholder') }}"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2">
                <button wire:click="$set('filter', 'all')"
                        class="px-4 py-2 rounded-lg font-medium transition-colors {{ $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' }}">
                    {{ __('common.beneficiaries.all') }}
                </button>
                <button wire:click="$set('filter', 'listed')"
                        class="px-4 py-2 rounded-lg font-medium transition-colors {{ $filter === 'listed' ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' }}">
                    {{ __('common.beneficiaries.listed') }}
                </button>
                <button wire:click="$set('filter', 'unlisted')"
                        class="px-4 py-2 rounded-lg font-medium transition-colors {{ $filter === 'unlisted' ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' }}">
                    {{ __('common.beneficiaries.unlisted') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('common.labels.name') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('common.labels.status') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('common.beneficiaries.default_category') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('common.table.actions') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($payees as $payee)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $payee->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-badge 
                                :item="$payee"
                                :enumClass="\App\Enums\PayeeStatus::class"
                                noValueKey="common.terms.unknown"
                                field="status"
                            />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payee->category)
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $payee->category->name }}
                                </div>
                            @else
                                <span class="text-sm text-gray-400">{{ __('common.beneficiaries.no_default_category') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <x-action-button 
                                    method="toggleListed"
                                    :id="$payee->id"
                                    :icon="$payee->is_listed ? 'eye' : 'eye-off'"
                                    :color="$payee->is_listed ? 'green' : 'gray'"
                                    size="sm"
                                    :title="$payee->is_listed ? __('common.beneficiaries.unlist_action') : __('common.beneficiaries.list_action')"
                                />
                                <x-action-button 
                                    method="openModal"
                                    :id="$payee->id"
                                    icon="pencil"
                                    color="green"
                                    size="sm"
                                    :title="__('common.beneficiaries.edit_action')"
                                />
                                <x-action-button 
                                    method="confirmPayeeDeletion"
                                    :id="$payee->id"
                                    icon="trash"
                                    color="red"
                                    size="sm"
                                    :title="__('common.beneficiaries.delete_action')"
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('common.beneficiaries.no_beneficiaries_title') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('common.beneficiaries.no_beneficiaries_description') }}
                            </p>
                            <div class="mt-6">
                                <button wire:click="openModal()" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('common.beneficiaries.add_beneficiary') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($payees->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $payees->links() }}
        </div>
    @endif

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white dark:bg-gray-800" wire:click.stop>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ $isEditing ? __('common.beneficiaries.edit_beneficiary') : __('common.beneficiaries.add_beneficiary') }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form wire:submit.prevent="savePayee">
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="modalName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('common.labels.name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               wire:model="modalName" 
                               id="modalName"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               placeholder="{{ __('common.labels.name') }}"
                               required>
                        @error('modalName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Listed Checkbox -->
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   wire:model="modalIsListed"
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('common.beneficiaries.list_as_default') }}
                            </span>
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ml-6">
                            {{ __('common.beneficiaries.list_description') }}
                        </p>
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="modalCategoryId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('common.beneficiaries.default_category') }}
                        </label>
                        <select wire:model="modalCategoryId" 
                                id="modalCategoryId"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="">{{ __('common.buttons.select_category') }} ({{ __('common.terms.optional') }})</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('common.beneficiaries.category_description') }}
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('common.buttons.cancel') }}
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ $isEditing ? __('common.buttons.update') : __('common.buttons.save') }} {{ strtolower(__('common.beneficiaries.title')) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="cancelDelete">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white dark:bg-gray-800" wire:click.stop>
                <div class="flex items-center justify-center mb-4">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('common.beneficiaries.delete_beneficiary') }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        {{ __('common.beneficiaries.delete_confirmation') }}
                    </p>
                </div>

                <!-- Replacement Payee Selection -->
                <div class="mb-6">
                    <label for="replacementPayeeId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('common.beneficiaries.replace_transactions') }} ({{ __('common.terms.optional') }})
                    </label>
                    <select wire:model="replacementPayeeId" 
                            id="replacementPayeeId"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('common.beneficiaries.select_replacement') }}</option>
                        @foreach($payees as $payee)
                            @if($payee->id != $deletingPayeeId)
                                <option value="{{ $payee->id }}">{{ $payee->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ __('common.beneficiaries.replace_description') }}
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            wire:click="cancelDelete"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        {{ __('common.buttons.cancel') }}
                    </button>
                    <button type="button" 
                            wire:click="deletePayee"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        {{ __('common.beneficiaries.delete_beneficiary') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
        </div>
    </div>
</div> 