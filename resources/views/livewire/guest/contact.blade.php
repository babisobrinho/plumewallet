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
    <section class="py-16 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Operating Hours -->
                <div class="text-center">
                    <div class="bg-white rounded-xl p-8 shadow-lg">
                        <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-clock text-blue-600 text-2xl"></i>
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
                    <div class="bg-white rounded-xl p-8 shadow-lg">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-phone text-green-600 text-2xl"></i>
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
                    <div class="bg-white rounded-xl p-8 shadow-lg">
                        <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-mail text-purple-600 text-2xl"></i>
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
    <section class="py-16 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ __('guest.contact.form.title') }}
                </h2>
            </div>

            @if($submitted)
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                    <div class="flex items-center">
                        <i class="ti ti-check-circle text-green-600 text-2xl mr-3"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-green-800">
                                {{ __('guest.contact.form.success.title') }}
                            </h3>
                            <p class="text-green-700">
                                {{ __('guest.contact.form.success.message') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
                    <div class="flex items-center">
                        <i class="ti ti-alert-circle text-red-600 text-2xl mr-3"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-red-800">
                                {{ __('guest.contact.form.error.title') }}
                            </h3>
                            <p class="text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form wire:submit="submit" class="bg-gray-50 rounded-2xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('guest.contact.form.email') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            wire:model="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="{{ __('guest.contact.form.email_placeholder') }}"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('guest.contact.form.phone') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone"
                            wire:model="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                            placeholder="{{ __('guest.contact.form.phone_placeholder') }}"
                        >
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('guest.contact.form.name') }}
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        wire:model="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="{{ __('guest.contact.form.name_placeholder') }}"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-8">
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('guest.contact.form.message') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="message"
                        wire:model="message"
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                        placeholder="{{ __('guest.contact.form.message_placeholder') }}"
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
                        class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 text-white px-8 py-4 rounded-lg font-semibold transition-colors flex items-center justify-center mx-auto"
                    >
                        <span wire:loading.remove wire:target="submit">
                            {{ __('guest.contact.form.submit') }}
                        </span>
                        <span wire:loading wire:target="submit" class="flex items-center">
                            <i class="ti ti-loader-2 animate-spin mr-2"></i>
                            {{ __('guest.contact.form.sending') }}
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
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold transition-colors inline-block">
                {{ __('guest.contact.cta.button') }}
            </a>
        </div>
    </section>
</div>
