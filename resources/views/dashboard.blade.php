<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    As Minhas Finanças
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Faça a gestão das suas informações pessoais e segurança</p>
            </div>
            <div>
                <button id="month-selector" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                    <span>Junho 2023</span>
                    <i class="ti ti-chevron-down ml-1"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        .radial-progress {
            position: relative;
            width: 80px;
            height: 80px;
        }
        .radial-progress svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }
        .radial-progress circle {
            fill: none;
            stroke-linecap: round;
        }
        .radial-track {
            stroke: #e2e8f0;
        }
        .dark .radial-track {
            stroke: #1e293b;
        }
        .radial-thumb {
            stroke-dasharray: 251;
            stroke-dashoffset: calc(251 - (251 * var(--percentage)) / 100);
            transition: stroke-dashoffset 0.5s ease;
        }
    </style>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="overflow-hidden flex-1">
            <!-- Content -->
            <!-- Summary Cards with Radial Progress -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Balance Card -->
                <div class="bg-white dark:bg-gray-800/80 rounded-lg shadow-xs p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo Total</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">€2,450.00</p>
                            <p class="text-xs text-teal-600 dark:text-teal-400 mt-2 flex items-center">
                                <i class="ti ti-trending-up mr-1"></i> 12% vs último mês
                            </p>
                        </div>
                        <div class="radial-progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="radial-track" cx="50" cy="50" r="40" stroke-width="8"></circle>
                                <circle class="radial-thumb" cx="50" cy="50" r="40" stroke-width="8" stroke="#0d9488" style="--percentage: 75"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="sparkline mt-4" id="balance-sparkline"></div>
                </div>
                
                <!-- Income Card -->
                <div class="bg-white dark:bg-gray-800/80 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Receitas</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">€1,850.00</p>
                            <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2 flex items-center">
                                <i class="ti ti-trending-up mr-1"></i> 8% vs último mês
                            </p>
                        </div>
                        <div class="radial-progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="radial-track" cx="50" cy="50" r="40" stroke-width="8"></circle>
                                <circle class="radial-thumb" cx="50" cy="50" r="40" stroke-width="8" stroke="#10b981" style="--percentage: 82"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="sparkline mt-4" id="income-sparkline"></div>
                </div>
                
                <!-- Expenses Card -->
                <div class="bg-white dark:bg-gray-800/80 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Despesas</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">€1,200.00</p>
                            <p class="text-xs text-rose-600 dark:text-rose-400 mt-2 flex items-center">
                                <i class="ti ti-trending-down mr-1"></i> 5% vs último mês
                            </p>
                        </div>
                        <div class="radial-progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="radial-track" cx="50" cy="50" r="40" stroke-width="8"></circle>
                                <circle class="radial-thumb" cx="50" cy="50" r="40" stroke-width="8" stroke="#f43f5e" style="--percentage: 65"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="sparkline mt-4" id="expenses-sparkline"></div>
                </div>
                
                <!-- Credit Card -->
                <div class="bg-white dark:bg-gray-800/80 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Cartão Crédito</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">€450.00</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 flex items-center">
                                <i class="ti ti-alert-circle mr-1"></i> 30% do limite
                            </p>
                        </div>
                        <div class="radial-progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="radial-track" cx="50" cy="50" r="40" stroke-width="8"></circle>
                                <circle class="radial-thumb" cx="50" cy="50" r="40" stroke-width="8" stroke="#f59e0b" style="--percentage: 30"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="sparkline mt-4" id="credit-sparkline"></div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Financial Health Card -->
                    <div class="bg-gradient-to-r from-teal-500 to-blue-600 rounded-2xl shadow-xl overflow-hidden text-white">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold luxury-font">Saúde Financeira</h2>
                                    <p class="text-sm opacity-90 mt-1">Seu score financeiro este mês</p>
                                </div>
                                <div class="bg-white/20 rounded-full px-3 py-1 text-xs font-medium">
                                    78/100
                                </div>
                            </div>
                            <div class="mt-6">
                                <div class="flex justify-between text-xs mb-1">
                                    <span>Bom</span>
                                    <span>Excelente</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-2">
                                    <div class="bg-white h-2 rounded-full" style="width: 78%"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mt-6">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">A</div>
                                        <div class="text-xs opacity-80 mt-1">Poupança</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">B+</div>
                                        <div class="text-xs opacity-80 mt-1">Gastos</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">B</div>
                                        <div class="text-xs opacity-80 mt-1">Investimentos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/10 p-4 text-center">
                            <button class="text-xs font-medium bg-white text-teal-700 py-2 px-4 rounded-full hover:bg-white/90 transition">
                                Ver recomendações
                            </button>
                        </div>
                    </div>

                    <!-- Interactive Charts -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Expense Categories Chart -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Despesas por Categoria</h2>
                                <div class="flex space-x-1">
                                    <button class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        Mês
                                    </button>
                                    <button class="text-xs px-2 py-1 bg-teal-100 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 rounded hover:bg-teal-200 dark:hover:bg-teal-800/30 transition-colors">
                                        Ano
                                    </button>
                                </div>
                            </div>
                            <div class="h-64">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                        
                        <!-- Cash Flow Chart -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Fluxo de Caixa</h2>
                                <div class="flex space-x-1">
                                    <button class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        Mês
                                    </button>
                                    <button class="text-xs px-2 py-1 bg-teal-100 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 rounded hover:bg-teal-200 dark:hover:bg-teal-800/30 transition-colors">
                                        Ano
                                    </button>
                                </div>
                            </div>
                            <div class="h-64">
                                <canvas id="cashflowChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Balance Chart -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Balanço Mensal</h2>
                            <div class="flex space-x-1">
                                <button class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    3M
                                </button>
                                <button class="text-xs px-2 py-1 bg-teal-100 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 rounded hover:bg-teal-200 dark:hover:bg-teal-800/30 transition-colors">
                                    6M
                                </button>
                                <button class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    12M
                                </button>
                            </div>
                        </div>
                        <div class="h-72">
                            <canvas id="balanceChart"></canvas>
                        </div>
                    </div>
                    <!-- Financial Insights -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mt-6 transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Insights Financeiros</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-gray-700">
                    <!-- Insight 1 -->
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                                <i class="ti ti-coffee"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gasto com Café</p>
                                <p class="text-xl font-semibold text-gray-800 dark:text-white mt-1">€45.60</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Você gastou €45.60 em café este mês, 12% a mais que no mês passado.</p>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Insight 2 -->
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400">
                                <i class="ti ti-car"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Economia Combustível</p>
                                <p class="text-xl font-semibold text-gray-800 dark:text-white mt-1">€28.40</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Você economizou €28.40 em combustível comparado ao mês passado.</p>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Insight 3 -->
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                                <i class="ti ti-pig-money"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Poupança Mensal</p>
                                <p class="text-xl font-semibold text-gray-800 dark:text-white mt-1">€650.00</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Você poupou 35% da sua renda este mês. Excelente trabalho!</p>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Upcoming Bills -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Próximas Contas</h2>
                        </div>
                        <div class="p-1">
                            <div class="space-y-3">
                                <!-- Bill 1 -->
                                <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400">
                                        <i class="ti ti-home"></i>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Aluguel</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Vence em 5 dias</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">€750.00</p>
                                        <div class="flex items-center justify-end mt-1">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Automático</span>
                                            <i class="ti ti-refresh ml-1 text-xs text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Bill 2 -->
                                <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                                        <i class="ti ti-device-mobile"></i>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Telemóvel</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Vence em 8 dias</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">€35.50</p>
                                        <div class="flex items-center justify-end mt-1">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">MB Way</span>
                                            <i class="ti ti-wallet ml-1 text-xs text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Bill 3 -->
                                <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="p-2 rounded-lg bg-purple-100 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400">
                                        <i class="ti ti-building-broadcast-tower"></i>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Internet</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Vence em 12 dias</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">€39.99</p>
                                        <div class="flex items-center justify-end mt-1">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Débito Direto</span>
                                            <i class="ti ti-credit-card ml-1 text-xs text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Bill 4 -->
                                <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="p-2 rounded-lg bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                                        <i class="ti ti-bolt"></i>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Eletricidade</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Vence em 15 dias</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">€62.30</p>
                                        <div class="flex items-center justify-end mt-1">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Referência</span>
                                            <i class="ti ti-receipt-2 ml-1 text-xs text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full py-2 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 text-sm font-medium rounded-lg transition-colors duration-150">
                                Ver todas as contas
                            </button>
                        </div>
                    </div>
                    
                    <!-- Savings Goals -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Objetivos de Poupança</h2>
                        </div>
                        <div class="p-5">
                            <div class="space-y-5">
                                <!-- Goal 1 -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg bg-teal-100 dark:bg-teal-900/20 flex items-center justify-center text-teal-600 dark:text-teal-400 mr-3">
                                                <i class="ti ti-beach"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800 dark:text-white">Férias no Algarve</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Meta: €2,000</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-teal-600 dark:text-teal-400">60%</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">€1,200</p>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                        <div class="bg-teal-500 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                
                                <!-- Goal 2 -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mr-3">
                                                <i class="ti ti-device-laptop"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800 dark:text-white">Novo Portátil</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Meta: €1,200</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">33%</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">€400</p>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 33%"></div>
                                    </div>
                                </div>
                                
                                <!-- Goal 3 -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg bg-rose-100 dark:bg-rose-900/20 flex items-center justify-center text-rose-600 dark:text-rose-400 mr-3">
                                                <i class="ti ti-building"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800 dark:text-white">Entrada Casa</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Meta: €30,000</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-rose-600 dark:text-rose-400">17%</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">€5,000</p>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                        <div class="bg-rose-500 h-2 rounded-full" style="width: 17%"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-5 w-full py-2.5 bg-gradient-to-r from-teal-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity shadow-md">
                                Adicionar Objetivo
                            </button>
                        </div>
                    </div>
                    
                    <!-- Recent Transactions -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 card-hover border border-gray-100 dark:border-gray-800">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Transações Recentes</h2>
                        </div>
                        <div class="p-1">
                            <div class="space-y-3 max-h-96 overflow-y-auto">
                                <!-- Transaction 1 -->
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="category-badge bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                                            <i class="ti ti-briefcase"></i>
                                        </div>
                                        <div class="ml-4 flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Salário - Empresa XYZ</p>
                                                <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 ml-2">+€1,200.00</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">15 Jun</span>
                                                    <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Conta Corrente</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <span class="tag bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs">
                                                        <i class="ti ti-discount-2 mr-1"></i> Student
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Transaction 2 -->
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="category-badge bg-rose-100 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                                            <i class="ti ti-shopping-cart"></i>
                                        </div>
                                        <div class="ml-4 flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Supermercado Continente</p>
                                                <p class="text-sm font-semibold text-rose-600 dark:text-rose-400 ml-2">-€85.50</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">14 Jun</span>
                                                    <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Cartão Crédito</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <span class="tag bg-purple-100 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 text-xs">
                                                        <i class="ti ti-tag mr-1"></i> Online
                                                    </span>
                                                    <span class="tag bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-xs">
                                                        <i class="ti ti-discount mr-1"></i> Coupon
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Transaction 3 -->
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="category-badge bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                                            <i class="ti ti-school"></i>
                                        </div>
                                        <div class="ml-4 flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Aulas Particulares</p>
                                                <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 ml-2">+€150.00</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">12 Jun</span>
                                                    <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Conta Poupança</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <span class="tag bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs">
                                                        <i class="ti ti-heart mr-1"></i> Love
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Transaction 4 -->
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="category-badge bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400">
                                            <i class="ti ti-gas-station"></i>
                                        </div>
                                        <div class="ml-4 flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Posto Galp</p>
                                                <p class="text-sm font-semibold text-rose-600 dark:text-rose-400 ml-2">-€45.00</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">10 Jun</span>
                                                    <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Cartão Débito</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <span class="tag bg-green-100 dark:bg-green-900/20 text-green-600 dark:text-green-400 text-xs">
                                                        <i class="ti ti-coin mr-1"></i> MB
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Transaction 5 -->
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="category-badge bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                                            <i class="ti ti-gift"></i>
                                        </div>
                                        <div class="ml-4 flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Presente de Aniversário</p>
                                                <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 ml-2">+€50.00</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">8 Jun</span>
                                                    <span class="mx-2 text-gray-400 dark:text-gray-500">•</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Dinheiro</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <span class="tag bg-pink-100 dark:bg-pink-900/20 text-pink-600 dark:text-pink-400 text-xs">
                                                        <i class="ti ti-recycle mr-1"></i> 2nd hand
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full py-2.5 border border-gray-200 dark:border-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Ver todas as transações
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
// Variáveis globais para os gráficos
let balanceChart, categoryChart, cashflowChart;

// Inicialização quando o Alpine estiver pronto
document.addEventListener('alpine:initialized', () => {
    initCharts();
    initSparklines();
});

// Atualizar gráficos quando o tema mudar
document.addEventListener('theme-changed', () => {
    updateCharts();
});

// Função para atualizar todos os gráficos
function updateCharts() {
    if (balanceChart) balanceChart.destroy();
    if (categoryChart) categoryChart.destroy();
    if (cashflowChart) cashflowChart.destroy();
    initCharts();
    initSparklines();
}

// Inicializar gráficos principais
function initCharts() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#e2e8f0' : '#1f2937';
    const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
    const bgColor = isDark ? '#0f172a' : '#ffffff';
    
    // Balance Chart
    const balanceCtx = document.getElementById('balanceChart')?.getContext('2d');
    if (balanceCtx) {
        balanceChart = new Chart(balanceCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                datasets: [
                    {
                        label: 'Receitas',
                        data: [1200, 1900, 1500, 1800, 2000, 1850],
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        borderWidth: 0
                    },
                    {
                        label: 'Despesas',
                        data: [800, 1100, 900, 1200, 1500, 1200],
                        backgroundColor: '#f43f5e',
                        borderRadius: 6,
                        borderWidth: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: textColor,
                            usePointStyle: true,
                            padding: 20,
                            font: { family: 'Poppins', size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#1e293b' : '#ffffff',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1,
                        usePointStyle: true,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': €' + context.raw.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: {
                            color: isDark ? '#94a3b8' : '#6b7280',
                            callback: function(value) { return '€' + value; }
                        }
                    },
                    x: {
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { color: isDark ? '#94a3b8' : '#6b7280' }
                    }
                },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart')?.getContext('2d');
    if (categoryCtx) {
        categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Alimentação', 'Casa', 'Transporte', 'Entretenimento', 'Saúde', 'Outros'],
                datasets: [{
                    data: [250, 500, 120, 50, 80, 200],
                    backgroundColor: [
                        '#3b82f6', '#8b5cf6', '#10b981',
                        '#f59e0b', '#ec4899', '#64748b'
                    ],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: textColor,
                            padding: 20,
                            font: { family: 'Poppins', size: 12 },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#1e293b' : '#ffffff',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1,
                        usePointStyle: true,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return ` ${label}: €${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Cashflow Chart
    const cashflowCtx = document.getElementById('cashflowChart')?.getContext('2d');
    if (cashflowCtx) {
        cashflowChart = new Chart(cashflowCtx, {
            type: 'line',
            data: {
                labels: ['1', '5', '10', '15', '20', '25', '30'],
                datasets: [
                    {
                        label: 'Entradas',
                        data: [200, 400, 300, 500, 400, 600, 500],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointBackgroundColor: bgColor,
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Saídas',
                        data: [100, 300, 200, 400, 300, 500, 400],
                        borderColor: '#f43f5e',
                        backgroundColor: 'rgba(244, 63, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointBackgroundColor: bgColor,
                        pointBorderColor: '#f43f5e',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: textColor,
                            usePointStyle: true,
                            padding: 20,
                            font: { family: 'Poppins', size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#1e293b' : '#ffffff',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#334155' : '#e2e8f0',
                        borderWidth: 1,
                        usePointStyle: true,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': €' + context.raw.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: {
                            color: isDark ? '#94a3b8' : '#6b7280',
                            callback: function(value) { return '€' + value; }
                        }
                    },
                    x: {
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { color: isDark ? '#94a3b8' : '#6b7280' }
                    }
                },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    }
}

// Inicializar sparklines
function initSparklines() {
    const isDark = document.documentElement.classList.contains('dark');
    const lineColor = isDark ? '#ffffff' : '#0f172a';
    
    // Balance Sparkline
    if (document.querySelector("#balance-sparkline")) {
        new ApexCharts(document.querySelector("#balance-sparkline"), {
            series: [{ data: [30, 40, 35, 50, 49, 60, 70, 91, 125] }],
            chart: {
                type: 'area',
                sparkline: { enabled: true },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            stroke: { curve: 'smooth', width: 2, colors: [lineColor] },
            fill: {
                colors: [lineColor],
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.1, stops: [0, 100] }
            },
            tooltip: { enabled: false }
        }).render();
    }
    
    // Income Sparkline
    if (document.querySelector("#income-sparkline")) {
        new ApexCharts(document.querySelector("#income-sparkline"), {
            series: [{ data: [20, 35, 45, 30, 55, 40, 60, 75, 110] }],
            chart: {
                type: 'area',
                sparkline: { enabled: true },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            stroke: { curve: 'smooth', width: 2, colors: ['#10b981'] },
            fill: {
                colors: ['#10b981'],
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.1, stops: [0, 100] }
            },
            tooltip: { enabled: false }
        }).render();
    }
    
    // Expenses Sparkline
    if (document.querySelector("#expenses-sparkline")) {
        new ApexCharts(document.querySelector("#expenses-sparkline"), {
            series: [{ data: [15, 25, 30, 20, 40, 35, 45, 50, 70] }],
            chart: {
                type: 'area',
                sparkline: { enabled: true },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            stroke: { curve: 'smooth', width: 2, colors: ['#f43f5e'] },
            fill: {
                colors: ['#f43f5e'],
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.1, stops: [0, 100] }
            },
            tooltip: { enabled: false }
        }).render();
    }
    
    // Credit Sparkline
    if (document.querySelector("#credit-sparkline")) {
        new ApexCharts(document.querySelector("#credit-sparkline"), {
            series: [{ data: [5, 10, 8, 12, 15, 10, 18, 20, 25] }],
            chart: {
                type: 'area',
                sparkline: { enabled: true },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            stroke: { curve: 'smooth', width: 2, colors: ['#f59e0b'] },
            fill: {
                colors: ['#f59e0b'],
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.1, stops: [0, 100] }
            },
            tooltip: { enabled: false }
        }).render();
    }
}

// Observar mudanças no tema
const observer = new MutationObserver(() => {
    const event = new Event('theme-changed');
    document.dispatchEvent(event);
});

observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class']
});
</script>
</x-app-layout>
