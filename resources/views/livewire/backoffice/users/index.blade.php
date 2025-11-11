<x-slot name="header">
    <x-backoffice-header
        :title="__('users.title')"
        :subtitle="__('users.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- User Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('users.metrics.total_users')"
                :value="number_format($totalUsers)"
                icon="ti ti-users"
                color="blue"
            />

            <x-metric-card 
                :title="__('users.metrics.active_users')"
                :value="number_format($activeUsers)"
                icon="ti ti-circle-check"
                color="green"
            />

            <x-metric-card 
                :title="__('users.metrics.staff_users')"
                :value="number_format($staffUsers)"
                icon="ti ti-user-cog"
                color="purple"
            />

            <x-metric-card 
                :title="__('users.metrics.client_users')"
                :value="number_format($clientUsers)"
                icon="ti ti-user"
                color="indigo"
            />
        </div>

        <!-- Header com botão de criar -->
        <div class="mb-6 flex justify-end items-center">
            <button 
                wire:click="createUser"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="ti ti-user-plus w-4 h-4 mr-2"></i>
                {{ __('users.new_user') }}
            </button>
        </div>

        <!-- Users Table -->
        <div class="bg-white dark:bg-gray-900 shadow overflow-hidden rounded-lg">
            <!-- Search and Filters Bar -->
            <div class="px-6 py-4 border border-gray-200 dark:border-gray-700 rounded-t-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Search -->
                    <div class="flex-1 max-w-lg">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="{{ __('common.search.placeholder') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Status Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.status"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('users.filters.all_status') }}</option>
                                <option value="active">{{ __('enums.status.active') }}</option>
                                <option value="inactive">{{ __('enums.status.inactive') }}</option>
                            </select>
                        </div>
                        
                        <!-- Role Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.role"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('users.filters.all_types') }}</option>
                                <option value="staff">{{ __('enums.role_type.staff') }}</option>
                                <option value="client">{{ __('enums.role_type.client') }}</option>
                            </select>
                        </div>
                        
                        <!-- Clear Filters Button -->
                        <button 
                            wire:click="clearFilters"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('common.buttons.clear') }}
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.labels.name') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.labels.email') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.labels.type') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.labels.verified') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.labels.registered_at') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                <!-- Name -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->name }}
                                </td>
                                
                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->email }}
                                </td>
                                
                                <!-- Role -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <x-badge 
                                        :item="$user"
                                        :enumClass="\App\Enums\RoleType::class"
                                        field="type"
                                        :noValueKey="'no_role'"
                                    />
                                </td>
                                
                                <!-- Verified -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.yes') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.no') }}
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Created At -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <x-action-link 
                                            url="{{ route('backoffice.users.show', $user->id) }}"
                                            icon="eye"
                                            color="blue"
                                            size="sm"
                                            :title="__('common.buttons.view')"
                                        />
                                        <x-action-link 
                                            url="{{ route('backoffice.users.show', $user->id) }}"
                                            icon="pencil"
                                            color="green"
                                            size="sm"
                                            :title="__('common.buttons.edit')"
                                        />
                                        <x-action-link 
                                            method="confirmUserDeletion"
                                            :id="$user->id"
                                            icon="trash"
                                            color="red"
                                            size="sm"
                                            :title="__('common.buttons.delete')"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('common.table.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 border-r border-l border-b border-gray-200 dark:border-gray-700 rounded-b-lg">
                {{ $data->links() }}
            </div>
        </div>

        <!-- User Form Modal -->
        @if($showModal)
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto">
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="$wire.closeModal()"></div>

            <!-- Modal Panel -->
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    
                    <!-- Modal Header -->
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                @if($isEditing)
                                    <i class="ti ti-pencil w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @else
                                    <i class="ti ti-user-plus w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @endif
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    @if($isEditing)
                                        {{ __('common.buttons.edit') }} {{ __('common.navigation.users') }}
                                    @else
                                        {{ __('users.new_user') }}
                                    @endif
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($isEditing)
                                            {{ __('users.form.edit_description') }}
                                        @else
                                            {{ __('users.form.create_description') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit="saveUser" class="px-4 pb-4 sm:px-6 space-y-4">
                        <!-- Name -->
                        <div>
                            <x-label for="modal_name" :value="__('users.form.full_name')" />
                            <input 
                                id="modal_name" 
                                type="text" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalName" 
                                required 
                                autofocus 
                                autocomplete="name" 
                            />
                            <x-input-error for="modalName" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-label for="modal_email" :value="__('common.labels.email')" />
                            <x-input 
                                id="modal_email" 
                                type="email" 
                                class="mt-1 block w-full" 
                                wire:model="modalEmail" 
                                required 
                                autocomplete="email" 
                            />
                            <x-input-error for="modalEmail" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-label for="modal_phone_number" :value="__('common.labels.phone_number')" />
                            <x-input 
                                id="modal_phone_number" 
                                type="tel" 
                                class="mt-1 block w-full" 
                                wire:model="modalPhoneNumber" 
                                autocomplete="tel" 
                            />
                            <x-input-error for="modalPhoneNumber" class="mt-2" />
                        </div>

                        <!-- User Type -->
                        <div>
                            <x-label for="modal_role_type" :value="__('users.form.user_type')" />
                            <select 
                                id="modal_role_type" 
                                wire:model.live="modalRoleType" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                                <option value="">{{ __('users.form.select_type') }}</option>
                                <option value="staff">{{ __('enums.role_type.staff') }}</option>
                                <option value="client">{{ __('enums.role_type.client') }}</option>
                            </select>
                            <x-input-error for="modalRoleType" class="mt-2" />
                        </div>

                        <!-- Role Selection -->
                        @if($modalRoleType)
                        <div>
                            <x-label for="modal_role" :value="__('users.form.role')" />
                            <select 
                                id="modal_role" 
                                wire:model="modalRole" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                                <option value="">{{ __('users.form.select_role') }}</option>
                                @foreach($roleOptions as $value => $label)
                                    <option value="{{ $value }}">{{ ucfirst($label) }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="modalRole" class="mt-2" />
                        </div>
                        @endif

                        <!-- Password -->
                        <div>
                            <x-label for="modal_password" :value="__($isEditing ? 'profile.new_password' : 'users.form.password')" />
                            <input 
                                id="modal_password" 
                                type="password" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalPassword" 
                                {{ $isEditing ? '' : 'required' }}
                                autocomplete="new-password" 
                            />
                            <x-input-error for="modalPassword" class="mt-2" />
                            @if($isEditing)
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('users.form.password_optional') }}
                                </p>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        @if(!$isEditing || $modalPassword)
                            <div>
                                <x-label for="modal_password_confirmation" :value="__('profile.confirm_password')" />
                                <input 
                                    id="modal_password_confirmation" 
                                    type="password" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalPasswordConfirmation" 
                                    {{ !$isEditing ? 'required' : '' }}
                                    autocomplete="new-password" 
                                />
                                <x-input-error for="modalPasswordConfirmation" class="mt-2" />
                            </div>
                        @endif


                        <!-- Modal Footer -->
                        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 -mx-4 -mb-4 mt-6">
                            <button 
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                @if($isEditing)
                                    {{ __('common.buttons.update') }}
                                @else
                                {{ __('common.buttons.add') }}
                                @endif
                            </button>
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                {{ __('common.buttons.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <!-- Delete User Confirmation Modal -->
        @if($userToDelete)
            <x-confirmation-modal wire:model.live="confirmingUserDeletion">
                <x-slot name="title">
                    {{ __('users.danger_zone.delete_user') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('users.danger_zone.delete_confirmation', ['name' => $userToDelete->name]) }}

                    <div class="mt-4">
                        <x-input 
                            type="text" 
                            class="mt-1 block w-full"
                            placeholder="{{ __('users.danger_zone.confirm_name_placeholder') }}"
                            wire:model="confirmName"
                            wire:keydown.enter="deleteUser" 
                        />
                        <x-input-error for="confirmName" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                        {{ __('common.buttons.cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('common.buttons.delete') }}
                    </x-danger-button>
                </x-slot>
            </x-confirmation-modal>
        @endif
        
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('filters-cleared', () => {
        // Reset all select dropdowns to their first option (default)
        const selects = document.querySelectorAll('select[wire\\:model\\.live^="filters"]');
        selects.forEach(select => {
            select.selectedIndex = 0;
        });
        
        // Clear search input field
        const searchInput = document.querySelector('input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
        if (searchInput) {
            searchInput.value = '';
        }
    });
});
</script>

