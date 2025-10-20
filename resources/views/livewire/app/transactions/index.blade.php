<x-slot name="header">
    <x-app-header
        :title="__('transactions.title')"
        :subtitle="__('transactions.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            @livewire('app.transactions.table')
        </div>
    </div>
</div>
