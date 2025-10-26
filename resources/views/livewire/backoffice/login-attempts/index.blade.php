<x-slot name="header">
    <x-backoffice-header
        :title="__('login_attempts.title')"
        :subtitle="__('login_attempts.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Login Attempt Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('login_attempts.metrics.recent_attempts')"
                :value="number_format($recentAttempts)"
                icon="ti ti-clock"
                color="blue"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.suspicious_attempts')"
                :value="number_format($suspiciousAttempts)"
                icon="ti ti-alert-triangle"
                color="orange"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.blocked_attempts')"
                :value="number_format($blockedAttempts)"
                icon="ti ti-shield-x"
                color="red"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.security_score')"
                value="85%"
                icon="ti ti-shield-check"
                color="green"
            />
        </div>

        <!-- Login Attempts Table -->
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
                                <option value="">{{ __('login_attempts.filters.status') }}</option>
                                @foreach(\App\Enums\LoginAttemptStatus::options() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Country Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.country"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('login_attempts.filters.country') }}</option>
                                @foreach(\App\Models\LoginAttempt::distinct('country')->pluck('country', 'country')->filter() as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Suspicious Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.suspicious"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('login_attempts.filters.suspicious') }}</option>
                                <option value="1">{{ __('common.terms.yes') }}</option>
                                <option value="0">{{ __('common.terms.no') }}</option>
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
                                {{ __('login_attempts.table.email') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.ip_address') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.country') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.city') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.suspicious') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('login_attempts.table.attempted_at') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $attempt)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $attempt->email }}
                                </td>
                                
                                <!-- IP Address -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $attempt->ip_address }}
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <x-badge 
                                        :item="$attempt" 
                                        :enumClass="\App\Enums\LoginAttemptStatus::class"
                                        field="status"
                                    />
                                </td>
                                
                                <!-- Country -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $attempt->country ?? '-' }}
                                </td>
                                
                                <!-- City -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $attempt->city ?? '-' }}
                                </td>
                                
                                <!-- Suspicious -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($attempt->is_suspicious)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.yes') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.no') }}
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Attempted At -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $attempt->attempted_at ? \Carbon\Carbon::parse($attempt->attempted_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <x-action-button 
                                            method="viewAttempt"
                                            :id="$attempt->id"
                                            icon="eye"
                                            color="blue"
                                            size="sm"
                                            :title="__('common.buttons.view')"
                                        />
                                        @if($this->isIpBlocked($attempt->ip_address))
                                            <x-action-button 
                                                method="unblockIp"
                                                :id="$attempt->id"
                                                icon="shield-x"
                                                color="gray"
                                                size="sm"
                                                :title="__('login_attempts.actions.unblock_ip')"
                                            />
                                        @else
                                            <x-action-button 
                                                method="blockIp"
                                                :id="$attempt->id"
                                                icon="shield-check"
                                                color="green"
                                                size="sm"
                                                :title="__('login_attempts.actions.block_ip')"
                                            />
                                        @endif
                                        <x-action-button 
                                            method="deleteAttempt"
                                            :id="$attempt->id"
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
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
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

        <!-- Login Attempt Details Modal -->
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
                     class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                    
                    <!-- Modal Header -->
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="ti ti-login w-6 h-6 text-orange-600 dark:text-orange-400"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    {{ __('login_attempts.details.title') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('login_attempts.details.description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 pb-4 sm:px-6 space-y-4">
                        <!-- Email and Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_email" :value="__('login_attempts.form.email')" />
                                <input 
                                    id="modal_email" 
                                    type="email" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalEmail" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_status" :value="__('login_attempts.form.status')" />
                                <input 
                                    id="modal_status" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalStatus" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- IP Address and Location -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-label for="modal_ip_address" :value="__('login_attempts.form.ip_address')" />
                                <input 
                                    id="modal_ip_address" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalIpAddress" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_country" :value="__('login_attempts.form.country')" />
                                <input 
                                    id="modal_country" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalCountry" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_city" :value="__('login_attempts.form.city')" />
                                <input 
                                    id="modal_city" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalCity" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- Attempt Time and Failure Reason -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_attempted_at" :value="__('login_attempts.form.attempted_at')" />
                                <input 
                                    id="modal_attempted_at" 
                                    type="datetime-local" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalAttemptedAt" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_failure_reason" :value="__('login_attempts.form.failure_reason')" />
                                <input 
                                    id="modal_failure_reason" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalFailureReason" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- Security Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_is_suspicious" :value="__('login_attempts.form.is_suspicious')" />
                                <input 
                                    id="modal_is_suspicious" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalIsSuspicious" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_blocked_until" :value="__('login_attempts.form.blocked_until')" />
                                <input 
                                    id="modal_blocked_until" 
                                    type="datetime-local" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalBlockedUntil" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- User Agent -->
                        <div>
                            <x-label for="modal_user_agent" :value="__('login_attempts.form.user_agent')" />
                            <textarea 
                                id="modal_user_agent" 
                                rows="2"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalUserAgent" 
                                readonly
                            ></textarea>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 -mx-4 -mb-4 mt-6">
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                {{ __('common.buttons.close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Unblock IP Confirmation Modal -->
        @if($confirmingUnblock && $attemptToUnblock)
            <x-confirmation-modal wire:model.live="confirmingUnblock">
                <x-slot name="title">
                    {{ __('login_attempts.confirm_unblock.title') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('login_attempts.confirm_unblock.message', ['ip' => $attemptToUnblock->ip_address]) }}
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="cancelUnblock" wire:loading.attr="disabled">
                        {{ __('common.buttons.cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3" wire:click="confirmUnblockIp" wire:loading.attr="disabled">
                        {{ __('login_attempts.actions.unblock_ip') }}
                    </x-danger-button>
                </x-slot>
            </x-confirmation-modal>
        @endif
        
    </div>
</div>
