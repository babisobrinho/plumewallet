<x-slot name="header">
    <x-backoffice-header
        :title="__('logs.title')"
        :subtitle="__('logs.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Log Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('logs.metrics.recent_logs')"
                :value="number_format($recentLogs)"
                icon="ti ti-clock"
                color="blue"
            />

            <x-metric-card 
                :title="__('logs.metrics.system_logs')"
                :value="number_format($systemLogs)"
                icon="ti ti-server"
                color="green"
            />

            <x-metric-card 
                :title="__('logs.metrics.audit_logs')"
                :value="number_format($auditLogs)"
                icon="ti ti-user-check"
                color="purple"
            />

            <x-metric-card 
                :title="__('logs.metrics.api_logs')"
                :value="number_format($apiLogs)"
                icon="ti ti-api"
                color="indigo"
            />
        </div>

        <!-- Logs Table with DataTable styling -->
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
                                placeholder="{{ __('common.terms.search') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Type Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.type"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('logs.filters.type') }}</option>
                                @foreach(\App\Enums\LogType::options() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Level Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.level"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('logs.filters.level') }}</option>
                                @foreach(\App\Enums\LogLevel::options() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- User Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.user"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('logs.filters.user') }}</option>
                                @foreach(\App\Models\User::pluck('name', 'id')->toArray() as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/8">
                                {{ __('logs.table.type') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/8">
                                {{ __('logs.table.level') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/3">
                                {{ __('logs.table.message') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/8">
                                {{ __('logs.table.user') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/8">
                                {{ __('logs.table.ip_address') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider w-1/6">
                                {{ __('logs.table.created_at') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{-- ACTIONS --}}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $log)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                <!-- Type Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-badge 
                                        :item="$log"
                                        :enumClass="\App\Enums\LogType::class"
                                        :noValueKey="'common.terms.unknown'"
                                        field="type"
                                    />
                                </td>
                                
                                <!-- Level Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-badge 
                                        :item="$log"
                                        :enumClass="\App\Enums\LogLevel::class"
                                        :noValueKey="'common.terms.unknown'"
                                        field="level"
                                    />
                                </td>
                                
                                <!-- Message (truncated) -->
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    @php
                                        $message = $log->message ?? '';
                                        $truncated = strlen($message) > 30 ? substr($message, 0, 30) . '...' : $message;
                                    @endphp
                                    <span title="{{ $message }}" class="cursor-help">
                                        {{ $truncated }}
                                    </span>
                                </td>
                                
                                <!-- User -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $log->user->name ?? '-' }}
                                </td>
                                
                                <!-- IP Address -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $log->ip_address ?? '-' }}
                                </td>
                                
                                <!-- Created At -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-action-button 
                                        method="viewLog"
                                        :id="$log->id"
                                        icon="eye"
                                        color="blue"
                                        size="sm"
                                        :title="__('common.buttons.view')"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('common.messages.no_data') }}
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

        <!-- Log Details Modal -->
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
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="ti ti-file-text w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    {{ __('logs.details.view_title') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('logs.details.view_description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 pb-4 sm:px-6 space-y-4">
                        <!-- Type and Level -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_type" :value="__('logs.form.type')" />
                                <input 
                                    id="modal_type" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalType" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_level" :value="__('logs.form.level')" />
                                <input 
                                    id="modal_level" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalLevel" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <x-label for="modal_message" :value="__('logs.form.message')" />
                            <textarea 
                                id="modal_message" 
                                rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalMessage" 
                                readonly
                            ></textarea>
                        </div>

                        <!-- Context -->
                        <div>
                            <x-label for="modal_context" :value="__('logs.form.context')" />
                            <textarea 
                                id="modal_context" 
                                rows="6"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm font-mono text-sm" 
                                wire:model="modalContext" 
                                readonly
                            ></textarea>
                        </div>

                        <!-- Technical Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_ip_address" :value="__('logs.form.ip_address')" />
                                <input 
                                    id="modal_ip_address" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalIpAddress" 
                                    readonly
                                />
                            </div>
                            <div>
                                <x-label for="modal_method" :value="__('logs.form.method')" />
                                <input 
                                    id="modal_method" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalMethod" 
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- URL -->
                        <div>
                            <x-label for="modal_url" :value="__('logs.form.url')" />
                            <input 
                                id="modal_url" 
                                type="text" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalUrl" 
                                readonly
                            />
                        </div>

                        <!-- User Agent -->
                        <div>
                            <x-label for="modal_user_agent" :value="__('logs.form.user_agent')" />
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
        
    </div>
</div>
