@extends('institutional.layouts.app')

@section('title', __('institutional.contact_title'))
@section('description', __('institutional.contact_subtitle'))

@section('content')
<!-- Hero Section -->
<section class="py-20 px-6 bg-gradient-to-br from-plume-600 to-plume-800 dark:from-plume-800 dark:to-plume-900 text-white">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            {{ __('institutional.contact_title') }}
        </h1>
        <p class="text-xl text-plume-100 max-w-3xl mx-auto">
            {{ __('institutional.contact_subtitle') }}
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Horário -->
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-clock text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.business_hours') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.monday_friday') }}: 12h às 18h
                </p>
            </div>
            
            <!-- Telefone -->
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-phone text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.phone') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    <a href="tel:+351987456890" class="hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        987 456 890
                    </a>
                </p>
            </div>
            
            <!-- Email -->
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-mail text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.email') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    <a href="mailto:plume.wal@gmail.com" class="hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        plume.wal@gmail.com
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.contact_form') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                {{ __('institutional.contact_subtitle') }}
            </p>
        </div>
        
        @if(session('success'))
            <div class="mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="ti ti-check-circle text-green-600 dark:text-green-400 mr-3"></i>
                    <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="ti ti-alert-circle text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                    <div>
                        <p class="text-red-800 dark:text-red-200 font-medium mb-2">{{ __('auth.validation_errors') }}</p>
                        <ul class="text-red-700 dark:text-red-300 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        
        <form action="{{ route('institutional.contact.submit') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('institutional.email') }} *
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror"
                        placeholder="{{ __('institutional.email_placeholder') }}"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Nome Completo -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('institutional.name') }} *
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors @error('name') border-red-500 @enderror"
                        placeholder="{{ __('institutional.name_placeholder') }}"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Telefone -->
            <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('institutional.phone') }}
                </label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors @error('phone') border-red-500 @enderror"
                    placeholder="{{ __('institutional.phone_placeholder') }}"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Assunto -->
            <div class="mb-6">
                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('institutional.subject') }} *
                </label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors @error('subject') border-red-500 @enderror"
                    placeholder="{{ __('institutional.subject_placeholder') }}"
                >
                @error('subject')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Mensagem -->
            <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('institutional.message') }} *
                </label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="6"
                    required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors resize-vertical @error('message') border-red-500 @enderror"
                    placeholder="{{ __('institutional.message_placeholder') }}"
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-8 py-4 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-plume-500 focus:ring-offset-2"
                >
                    <i class="ti ti-send mr-2"></i>
                    {{ __('institutional.send_message') }}
                </button>
            </div>
        </form>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 px-6 bg-plume-600 dark:bg-plume-800 text-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            {{ __('institutional.plume_is_where_you_are') }}
        </h2>
        <p class="text-xl text-plume-100 mb-8">
            {{ __('institutional.be_part_of_story') }}
        </p>
        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
            {{ __('institutional.start') }}
            <i class="ti ti-arrow-right ml-2"></i>
        </a>
    </div>
</section>

<!-- FAQ Quick Link -->
<section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">
            {{ __('institutional.quick_question') }}
        </h2>
        <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
            {{ __('institutional.consult_faq') }}
        </p>
        <a href="{{ route('institutional.faq') }}" class="inline-flex items-center px-6 py-3 border-2 border-plume-600 dark:border-plume-400 text-plume-600 dark:text-plume-400 font-medium rounded-lg hover:bg-plume-600 dark:hover:bg-plume-400 hover:text-white transition-colors">
            {{ __('institutional.view_faq') }}
            <i class="ti ti-arrow-right ml-2"></i>
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            // Disable submit button to prevent double submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="ti ti-loader-2 animate-spin mr-2"></i>{{ __('institutional.sending') }}...';
        });
        
        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.startsWith('351')) {
                        value = '+' + value;
                    } else if (!value.startsWith('+')) {
                        value = '+351' + value;
                    }
                }
                e.target.value = value;
            });
        }
    });
</script>
@endpush
