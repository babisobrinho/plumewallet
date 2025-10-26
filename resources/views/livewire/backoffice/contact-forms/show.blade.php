<x-slot name="header">
    <x-backoffice-header
        :title="__('contact.details.title') . ' - ' . $contactForm->process_number"
        :subtitle="__('contact.details.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6">
        <!-- Header with actions -->
        <div class="flex items-start justify-start">
            <a 
                href="{{ route('backoffice.contact-forms.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="ti ti-arrow-left w-4 h-4 mr-2"></i>
                {{ __('common.buttons.back') }}
            </a>
        </div>

        <div class="w-full bg-white dark:bg-gray-900 shadow rounded-lg">
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

        <div class="flex items-center justify-between w-full bg-white dark:bg-gray-900 shadow rounded-lg p-6">
            <div>
                <button wire:click="openObservationModal" 
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                    {{ __('contact.buttons.add_observation') }}
                </button>
            </div>
            <div>
                <form wire:submit="updateStatus" class="flex items-center justify-end gap-2">
                    <select id="newStatus" 
                            wire:model="newStatus" 
                            class="block w-min-32 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @foreach($this->statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                        {{ __('contact.buttons.update_status') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-col w-full bg-white dark:bg-gray-900 shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    {{ __('contact.details.observations') }}
                </h3>
            </div>
                        
            <div class="space-y-4">
                @forelse($contactForm->observations as $observation)
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 dark:text-white">{{ $observation->observation }}</p>
                                            @if($observation->status)
                                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                                    {{ __('contact.details.status_changed_to') }}: {{ $observation->status_text }}
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

    <!-- SIMPLE MODAL - NO ALPINE.JS COMPLEXITY -->
    @if($showObservationModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center p-4" 
         style="position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6" 
             style="position: relative; z-index: 1000;">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ __('contact.modals.add_observation') }}
                </h3>
                <button wire:click="closeObservationModal" 
                        class="text-gray-400 hover:text-gray-600">
                    <i class="ti ti-x w-5 h-5"></i>
                </button>
            </div>
            
            <div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('contact.labels.observation') }}
                    </label>
                    <textarea wire:model="observationText" 
                              rows="4" 
                              class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="{{ __('contact.placeholders.observation') }}"
                              required></textarea>
                    @error('observationText') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('contact.labels.status') }} ({{ __('common.labels.optional') }})
                    </label>
                    <select wire:model="observationStatus" 
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">{{ __('contact.details.keep_current_status') }}</option>
                        @foreach($this->statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('observationStatus') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button wire:click="closeObservationModal" 
                            type="button"
                            class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-md text-sm">
                        {{ __('common.buttons.cancel') }}
                    </button>
                    <button wire:click="addObservation" 
                            type="button"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">
                        {{ __('contact.buttons.add_observation') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
