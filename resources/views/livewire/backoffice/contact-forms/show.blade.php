<x-slot name="header">
    <x-backoffice-header
        :title="__('contact.details.title') . ' - ' . $contactForm->process_number"
        :subtitle="__('contact.details.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header with actions -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $contactForm->name }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('contact.labels.process_number') }}: {{ $contactForm->process_number }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a 
                    href="{{ route('backoffice.contact-forms.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <i class="ti ti-arrow-left w-4 h-4 mr-2"></i>
                    {{ __('common.buttons.back') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Contact Form Details -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('contact.details.information') }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.process_number') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white font-mono">{{ $contactForm->process_number }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.status') }}
                                </label>
                                <p class="mt-1">
                                    @php
                                        $statusStyles = \App\Enums\ContactFormStatus::styles()[$contactForm->status->value];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $statusStyles['light_bg_color'] }} {{ $statusStyles['light_text_color'] }}
                                        dark:{{ $statusStyles['dark_bg_color'] }} dark:{{ $statusStyles['dark_text_color'] }}">
                                        {{ \App\Enums\ContactFormStatus::label($contactForm->status) }}
                                    </span>
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.name') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.email') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->email }}</p>
                            </div>
                            
                            @if($contactForm->company)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ __('contact.labels.company') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->company }}</p>
                                </div>
                            @endif
                            
                            @if($contactForm->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ __('contact.labels.phone') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->phone }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.subject') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->full_subject }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.preferred_language') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ \App\Enums\ContactFormLanguage::label($contactForm->preferred_language) }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('common.labels.created_at') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactForm->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('contact.labels.message') }}
                            </label>
                            <div class="mt-1 p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                                <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $contactForm->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update and Observations -->
            <div class="space-y-6">
                <!-- Status Update -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('contact.details.update_status') }}
                        </h3>
                        
                        <form wire:submit="updateStatus" class="space-y-4">
                            <div>
                                <label for="newStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('contact.labels.status') }}
                                </label>
                                <select id="newStatus" 
                                        wire:model="newStatus" 
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    @foreach($this->statusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                {{ __('contact.buttons.update_status') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Observations Timeline -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                {{ __('contact.details.observations') }}
                            </h3>
                            <button wire:click="openObservationModal" 
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm font-medium">
                                {{ __('contact.buttons.add_observation') }}
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($contactForm->observations as $observation)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $observation->observation }}</p>
                                            @if($observation->status_change)
                                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                                    {{ __('contact.details.status_changed_to') }}: {{ $observation->status_change_text }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $observation->user->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $observation->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                    {{ __('contact.messages.no_observations') }}
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Observation Modal -->
@if($showObservationModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    {{ __('contact.modals.add_observation') }}
                </h3>
                
                <form wire:submit="addObservation">
                    <div class="mb-4">
                        <label for="observationText" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('contact.labels.observation') }}
                        </label>
                        <textarea id="observationText" 
                                  wire:model="observationText" 
                                  rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                  placeholder="{{ __('contact.placeholders.observation') }}"
                                  required></textarea>
                        @error('observationText') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                wire:click="closeObservationModal" 
                                class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-md text-sm font-medium">
                            {{ __('common.buttons.cancel') }}
                        </button>
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            {{ __('contact.buttons.add_observation') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif