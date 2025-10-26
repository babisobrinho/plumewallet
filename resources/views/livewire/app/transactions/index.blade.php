<x-slot name="header">
    <x-app-header
        :title="__('common.transactions.title')"
        :subtitle="__('common.transactions.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        @livewire('app.transactions.table')
    </div>
</div>
