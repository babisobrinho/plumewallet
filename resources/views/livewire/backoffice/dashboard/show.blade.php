<x-slot name="header">
    <x-backoffice-header
        :title="__('dashboard.title')"
        :subtitle="__('dashboard.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Métricas Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <x-metric-card 
                :title="__('dashboard.metrics.total_users')"
                :value="number_format($totalUsers)"
                icon="ti ti-users"
                color="blue"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.active_users')"
                :value="number_format($activeUsers)"
                icon="ti ti-circle-check"
                color="green"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.total_transactions')"
                :value="number_format($totalTransactions)"
                icon="ti ti-chart-bar"
                color="yellow"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.total_accounts')"
                :value="number_format($totalAccounts)"
                icon="ti ti-file-text"
                color="red"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.open_tickets')"
                value="0"
                icon="ti ti-ticket"
                color="purple"
            />
        </div>

        <!-- Security Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('dashboard.metrics.total_attempts')"
                :value="number_format($totalAttempts)"
                icon="ti ti-login"
                color="blue"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.successful_attempts')"
                :value="number_format($successfulAttempts)"
                icon="ti ti-check-circle"
                color="green"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.failed_attempts')"
                :value="number_format($failedAttempts)"
                icon="ti ti-x-circle"
                color="red"
            />

            <x-metric-card 
                :title="__('dashboard.metrics.unique_ips')"
                :value="number_format($uniqueIps)"
                icon="ti ti-world"
                color="indigo"
            />
        </div>

        <!-- Atividade Recente -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-activity-section 
                :title="__('dashboard.sections.recent_users')"
                :items="[
                    [
                        'label' => __('dashboard.metrics.recent_users'),
                        'value' => $recentUsers,
                        'icon' => 'ti ti-users',
                        'color' => [
                            'bg' => 'bg-blue-100 dark:bg-blue-900',
                            'text' => 'text-blue-600 dark:text-blue-400'
                        ]
                    ],
                    [
                        'label' => __('dashboard.metrics.verified_users'),
                        'value' => $activeUsers,
                        'icon' => 'ti ti-circle-check',
                        'color' => [
                            'bg' => 'bg-green-100 dark:bg-green-900',
                            'text' => 'text-green-600 dark:text-green-400'
                        ]
                    ]
                ]"
            />

            <x-activity-section 
                :title="__('dashboard.sections.recent_tickets')"
                :items="[
                    [
                        'label' => __('dashboard.metrics.open_tickets'),
                        'value' => '0',
                        'icon' => 'ti ti-ticket',
                        'color' => [
                            'bg' => 'bg-purple-100 dark:bg-purple-900',
                            'text' => 'text-purple-600 dark:text-purple-400'
                        ]
                    ],
                    [
                        'label' => __('dashboard.metrics.recent_transactions'),
                        'value' => $recentTransactions,
                        'icon' => 'ti ti-chart-bar',
                        'color' => [
                            'bg' => 'bg-yellow-100 dark:bg-yellow-900',
                            'text' => 'text-yellow-600 dark:text-yellow-400'
                        ]
                    ]
                ]"
            />
        </div>
    </div>
</div>
