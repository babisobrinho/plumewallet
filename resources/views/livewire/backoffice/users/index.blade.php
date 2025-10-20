<x-slot name="header">
    <x-backoffice-header
        title="Gestão de Utilizadores"
        subtitle="Gerir utilizadores do sistema"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header com botão de criar -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Utilizadores</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Total: {{ $users->total() }} utilizadores
                </p>
            </div>
            <div>
                <a 
                    href="{{ route('backoffice.users.create') }}" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <x-icon name="user-plus" class="w-4 h-4 mr-2" />
                    Novo Utilizador
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <x-filter-bar
            :filters="$filterOptions"
            :sort-options="$sortOptions"
            search-placeholder="Pesquisar por nome ou email..."
        />

        <!-- Tabela de dados -->
        <x-data-table
            :columns="$tableColumns"
            :data="$users"
            :actions="$tableActions"
            empty-message="Nenhum utilizador encontrado"
        />

        <!-- Mensagens de feedback -->
        @if (session()->has('message'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
    </div>
</div>
