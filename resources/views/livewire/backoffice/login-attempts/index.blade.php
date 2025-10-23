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
                :title="__('login_attempts.metrics.total_attempts')"
                :value="number_format($totalAttempts)"
                icon="ti ti-login"
                color="blue"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.successful_attempts')"
                :value="number_format($successfulAttempts)"
                icon="ti ti-check"
                color="green"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.failed_attempts')"
                :value="number_format($failedAttempts)"
                icon="ti ti-x"
                color="red"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.suspicious_attempts')"
                :value="number_format($suspiciousAttempts)"
                icon="ti ti-alert-triangle"
                color="orange"
            />
        </div>

        <!-- Additional Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('login_attempts.metrics.blocked_attempts')"
                :value="number_format($blockedAttempts)"
                icon="ti ti-shield-x"
                color="gray"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.recent_attempts')"
                :value="number_format($recentAttempts)"
                icon="ti ti-clock"
                color="blue"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.unique_ips')"
                :value="number_format($uniqueIps)"
                icon="ti ti-world"
                color="purple"
            />

            <x-metric-card 
                :title="__('login_attempts.metrics.security_score')"
                value="85%"
                icon="ti ti-shield-check"
                color="green"
            />
        </div>

        <livewire:shared.partials.data-table 
            :model="'LoginAttempt'"
            :tableColumns="$tableColumns"
            :tableActions="$tableActions"
            :filterOptions="$filterOptions"
        />

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
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 -mx-4 -mb-4 mt-6">
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
        
    </div>
</div>
