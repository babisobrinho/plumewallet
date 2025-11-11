
<x-slot name="header">
    <x-backoffice-header
        :title="__('dashboard.title')"
        :subtitle="__('dashboard.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Métricas Principais do Sistema -->
         @can("users_read")
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('dashboard.metrics.total_users')"
                :value="number_format($totalUsers)"
                icon="ti ti-users"
                color="blue"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.staff_users')"
                :value="number_format($staffUsers)"
                icon="ti ti-user-cog"
                color="purple"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.client_users')"
                :value="number_format($clientUsers)"
                icon="ti ti-user"
                color="indigo"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.active_sessions')"
                :value="number_format($activeSessions)"
                icon="ti ti-device-desktop"
                color="green"
            />
        </div>
        @endcan

        <!-- Métricas de Segurança  -->
         
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @can("login_attempts_read")
            <x-metric-card 
                :title="__('dashboard.metrics.login_attempts_24h')"
                :value="number_format($recentLoginAttempts)"
                icon="ti ti-login"
                color="blue"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.suspicious_attempts')"
                :value="number_format($suspiciousAttempts)"
                icon="ti ti-alert-triangle"
                color="orange"
            />
            @endcan
            @can("logs_read")
            <x-metric-card 
                :title="__('dashboard.metrics.system_logs')"
                :value="number_format($systemLogs)"
                icon="ti ti-file-text"
                color="gray"
            />
            <x-metric-card 
                :title="__('dashboard.metrics.error_logs')"
                :value="number_format($errorLogs)"
                icon="ti ti-alert-circle"
                color="red"
            />
            @endcan
        </div>

        <!-- Métricas de Conteúdo  -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @can("blog_read")
            <x-metric-card 
                :title="__('dashboard.metrics.total_posts')"
                :value="number_format($totalPosts)"
                icon="ti ti-news"
                color="blue"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.published_posts')"
                :value="number_format($publishedPosts)"
                icon="ti ti-circle-check"
                color="green"
            />
            @endcan
            @can("faq_read")
            <x-metric-card 
                :title="__('dashboard.metrics.total_faqs')"
                :value="number_format($totalFaqs)"
                icon="ti ti-help-circle"
                color="purple"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.pending_contacts')"
                :value="number_format($pendingContacts)"
                icon="ti ti-mail"
                color="orange"
            />
            @endcan
        </div>

        <!-- Atividade Recente  -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Activity -->
            @can("users_read")
            <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('dashboard.sections.user_activity') }}</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-lg">
                                <i class="ti ti-user-plus text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.new_users_today') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($newUsersToday) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg">
                                <i class="ti ti-circle-check text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.verified_users') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($verifiedUsers) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-lg">
                                <i class="ti ti-clock text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.pending_verification') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($pendingVerification) }}</span>
                    </div>
                </div>
            </div>
            @endcan

            <!-- System Activity -->
            <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('dashboard.sections.system_activity') }}</h3>
                <div class="space-y-4">
                    @can("logs_read")
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-gray-100 dark:bg-gray-800 p-2 rounded-lg">
                                <i class="ti ti-file-text text-gray-600 dark:text-gray-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.recent_logs_24h') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($recentLogs) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-red-100 dark:bg-red-900 p-2 rounded-lg">
                                <i class="ti ti-alert-circle text-red-600 dark:text-red-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.error_logs') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($errorLogs) }}</span>
                    </div>
                    @endcan

                    @can("contact_forms_read")
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-lg">
                                <i class="ti ti-mail text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('dashboard.activity.contact_forms_today') }}</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($contactFormsToday) }}</span>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>