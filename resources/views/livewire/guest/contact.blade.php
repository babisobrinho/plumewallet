<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="py-20 px-6 bg-gray-800">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                {{ __('guest.contact.title') }}
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                {{ __('guest.contact.subtitle') }}
            </p>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-16 px-6 bg-gray-200">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Operating Hours -->
                <div class="text-center">
                    <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                        <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-clock text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">
                            {{ __('guest.contact.hours.title') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('guest.contact.hours.description') }}
                        </p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="text-center">
                    <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                        <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-phone text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">
                            {{ __('guest.contact.phone.title') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('guest.contact.phone.number') }}
                        </p>
                    </div>
                </div>

                <!-- Email -->
                <div class="text-center">
                    <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                        <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-mail text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">
                            {{ __('guest.contact.email.title') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('guest.contact.email.address') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16 px-6 bg-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ __('guest.contact.form.title') }}
                </h2>
            </div>

            @if(session('success'))
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8 shadow-lg">
                    <div class="flex items-center">
                        <i class="ti ti-check-circle text-gray-800 text-2xl mr-3"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ __('contact.confirmation.title') }}
                            </h3>
                            <p class="text-gray-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8 shadow-lg">
                    <div class="flex items-center">
                        <i class="ti ti-alert-circle text-gray-800 text-2xl mr-3"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ __('guest.contact.form.error.title') }}
                            </h3>
                            <p class="text-gray-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form wire:submit="submit" class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.name') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            wire:model="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="{{ __('contact.labels.name') }}"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company -->
                    <div>
                        <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.company') }}
                        </label>
                        <input 
                            type="text" 
                            id="company"
                            wire:model="company"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('company') border-red-500 @enderror"
                            placeholder="{{ __('contact.labels.company') }}"
                        >
                        @error('company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.email') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            wire:model="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="{{ __('contact.labels.email') }}"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.phone') }}
                        </label>
                        <input 
                            type="tel" 
                            id="phone"
                            wire:model="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('phone') border-red-500 @enderror"
                            placeholder="{{ __('contact.labels.phone') }}"
                        >
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.subject') }} <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="subject"
                            wire:model.live="subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('subject') border-red-500 @enderror"
                            required
                        >
                            <option value="">{{ __('contact.placeholders.select_subject') }}</option>
                            @foreach($this->subjectOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preferred Language -->
                    <div>
                        <label for="preferred_language" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.preferred_language') }} <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="preferred_language"
                            wire:model="preferred_language"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('preferred_language') border-red-500 @enderror"
                            required
                        >
                            @foreach($this->languageOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('preferred_language')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Custom Subject (shown when "Other" is selected) -->
                @if($showCustomSubject)
                    <div class="mb-6">
                        <label for="custom_subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('contact.labels.custom_subject') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="custom_subject"
                            wire:model="custom_subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('custom_subject') border-red-500 @enderror"
                            placeholder="{{ __('contact.placeholders.custom_subject') }}"
                        >
                        @error('custom_subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Message -->
                <div class="mb-8">
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('contact.labels.message') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="message"
                        wire:model="message"
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent @error('message') border-red-500 @enderror"
                        placeholder="{{ __('contact.placeholders.message') }}"
                        required
                    ></textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button 
                        type="submit"
                        wire:loading.attr="disabled"
                        class="bg-gray-800 hover:bg-gray-700 disabled:bg-gray-400 text-white px-8 py-4 rounded-lg font-semibold transition-colors flex items-center justify-center mx-auto"
                    >
                        <span wire:loading.remove wire:target="submit">
                            {{ __('contact.buttons.submit') }}
                        </span>
                        <span wire:loading wire:target="submit" class="flex items-center">
                            <i class="ti ti-loader-2 animate-spin mr-2"></i>
                            {{ __('contact.buttons.submitting') }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 px-6 bg-gray-800">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                {{ __('guest.contact.cta.title') }}
            </h2>
            <p class="text-xl text-gray-300 mb-8">
                {{ __('guest.contact.cta.subtitle') }}
            </p>
            <a href="{{ route('register') }}" 
               class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-4 rounded-lg font-semibold transition-colors inline-block">
                {{ __('guest.contact.cta.button') }}
            </a>
        </div>
    </section>
</div>