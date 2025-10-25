<footer class="bg-gray-800 border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Plume Wallet Column -->
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold text-white mb-4">{{ __('guest.footer.plume_wallet') }}</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    {{ __('guest.footer.description') }}
                </p>
            </div>

            <!-- Produto Column -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">{{ __('guest.footer.product') }}</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('how-it-works.show') }}" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.how_it_works') }}</a></li>
                    <li><a href="{{ route('faqs.show') }}" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.faq') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.blog') }}</a></li>
                </ul>
            </div>

            <!-- Empresa Column -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">{{ __('guest.footer.company') }}</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about-us.show') }}" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.about_us') }}</a></li>
                    <li><a href="{{ route('contact.show') }}" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.contact') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.careers') }}</a></li>
                </ul>
            </div>

            <!-- Legal Column -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">{{ __('guest.footer.legal') }}</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.privacy') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.terms') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('guest.footer.security') }}</a></li>
                </ul>
            </div>
        </div>

        <!-- Separator Line -->
        <div class="border-t border-gray-700 mt-8 pt-8">
            <p class="text-center text-gray-400 text-sm">
                {{ __('guest.footer.copyright') }}
            </p>
        </div>
    </div>
</footer>