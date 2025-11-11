<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="py-20 px-6 bg-gray-200">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                {{ __('guest.how_it_works.title') }}
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                {{ __('guest.how_it_works.subtitle') }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-20 px-6 bg-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ __('guest.how_it_works.main_title') }}
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed">
                    {{ __('guest.how_it_works.main_description') }}
                </p>
            </div>

            <!-- Steps Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="bg-gray-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <i class="ti ti-user-plus text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ __('guest.how_it_works.step1.title') }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('guest.how_it_works.step1.description') }}
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="bg-gray-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <i class="ti ti-pig-money text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ __('guest.how_it_works.step2.title') }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('guest.how_it_works.step2.description') }}
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="bg-gray-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <i class="ti ti-chart-line text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ __('guest.how_it_works.step3.title') }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('guest.how_it_works.step3.description') }}
                    </p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg border border-gray-100">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ __('guest.how_it_works.cta.title') }}
                </h3>
                <p class="text-lg text-gray-600 mb-8">
                    {{ __('guest.how_it_works.cta.description') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" 
                       class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-4 rounded-lg font-semibold transition-colors">
                        {{ __('guest.how_it_works.cta.create_account') }}
                    </a>
                    <a href="{{ route('faqs.show') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-4 rounded-lg font-semibold transition-colors">
                        {{ __('guest.how_it_works.cta.view_faqs') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ __('guest.how_it_works.benefits.title') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white rounded-xl p-6 shadow-lg text-center border border-gray-100">
                    <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-shield-check text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        {{ __('guest.how_it_works.benefits.secure.title') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('guest.how_it_works.benefits.secure.description') }}
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white rounded-xl p-6 shadow-lg text-center border border-gray-100">
                    <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        {{ __('guest.how_it_works.benefits.easy.title') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('guest.how_it_works.benefits.easy.description') }}
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white rounded-xl p-6 shadow-lg text-center border border-gray-100">
                    <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-device-mobile text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        {{ __('guest.how_it_works.benefits.mobile.title') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('guest.how_it_works.benefits.mobile.description') }}
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="bg-white rounded-xl p-6 shadow-lg text-center border border-gray-100">
                    <div class="bg-gray-800 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-heart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        {{ __('guest.how_it_works.benefits.free.title') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('guest.how_it_works.benefits.free.description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
