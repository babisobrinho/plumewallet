<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="bg-gray-800 py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ __('legal.privacy.title') }}
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    {{ __('legal.privacy.subtitle') }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ __('legal.privacy.last_updated') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto">
            
            <!-- Introduction -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.privacy.introduction.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.privacy.introduction.description') }}</p>
                        <p class="mb-4">{{ __('legal.privacy.introduction.gdpr_compliance') }}</p>
                    </div>
                </div>
            </div>

            <!-- Data Controller -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.privacy.data_controller.title') }}</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <p class="text-gray-700 leading-relaxed">
                            <strong>{{ __('legal.privacy.data_controller.name') }}:</strong> Plume Wallet<br>
                            <strong>{{ __('legal.privacy.data_controller.address') }}:</strong> Rua da Inovação, 123, 1000-001 Lisboa, Portugal<br>
                            <strong>{{ __('legal.privacy.data_controller.email') }}:</strong> privacy@plume.pt<br>
                            <strong>{{ __('legal.privacy.data_controller.phone') }}:</strong> +351 987 456 680
                        </p>
                    </div>
                </div>
            </div>

            <!-- Data Collection -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.privacy.data_collection.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.privacy.data_collection.description') }}</p>
                        <ul class="list-disc list-inside text-gray-700 mb-6 ml-4">
                            <li><strong>{{ __('legal.privacy.data_collection.personal_data.title') }}:</strong>
                                <ul class="list-disc list-inside ml-6">
                                    <li>{{ __('legal.privacy.data_collection.personal_data.name') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.personal_data.email') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.personal_data.phone') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.personal_data.address') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.personal_data.birth_date') }}</li>
                                </ul>
                            </li>
                            <li><strong>{{ __('legal.privacy.data_collection.financial_data.title') }}:</strong>
                                <ul class="list-disc list-inside ml-6">
                                    <li>{{ __('legal.privacy.data_collection.financial_data.transactions') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.financial_data.accounts') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.financial_data.budgets') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.financial_data.goals') }}</li>
                                </ul>
                            </li>
                            <li><strong>{{ __('legal.privacy.data_collection.technical_data.title') }}:</strong>
                                <ul class="list-disc list-inside ml-6">
                                    <li>{{ __('legal.privacy.data_collection.technical_data.ip_address') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.technical_data.browser') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.technical_data.device') }}</li>
                                    <li>{{ __('legal.privacy.data_collection.technical_data.cookies') }}</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Legal Basis for Processing -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.privacy.legal_basis.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.privacy.legal_basis.description') }}</p>
                        <ul class="list-disc list-inside text-gray-700 mb-6 ml-4">
                            <li><strong>{{ __('legal.privacy.legal_basis.consent.title') }}:</strong> {{ __('legal.privacy.legal_basis.consent.description') }}</li>
                            <li><strong>{{ __('legal.privacy.legal_basis.contract.title') }}:</strong> {{ __('legal.privacy.legal_basis.contract.description') }}</li>
                            <li><strong>{{ __('legal.privacy.legal_basis.legitimate_interest.title') }}:</strong> {{ __('legal.privacy.legal_basis.legitimate_interest.description') }}</li>
                            <li><strong>{{ __('legal.privacy.legal_basis.legal_obligation.title') }}:</strong> {{ __('legal.privacy.legal_basis.legal_obligation.description') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Your Rights -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.privacy.user_rights.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.privacy.user_rights.description') }}</p>
                        <ul class="list-disc list-inside text-gray-700 mb-6 ml-4">
                            <li><strong>{{ __('legal.privacy.user_rights.access.title') }}:</strong> {{ __('legal.privacy.user_rights.access.description') }}</li>
                            <li><strong>{{ __('legal.privacy.user_rights.rectification.title') }}:</strong> {{ __('legal.privacy.user_rights.rectification.description') }}</li>
                            <li><strong>{{ __('legal.privacy.user_rights.erasure.title') }}:</strong> {{ __('legal.privacy.user_rights.erasure.description') }}</li>
                            <li><strong>{{ __('legal.privacy.user_rights.restriction.title') }}:</strong> {{ __('legal.privacy.user_rights.restriction.description') }}</li>
                            <li><strong>{{ __('legal.privacy.user_rights.portability.title') }}:</strong> {{ __('legal.privacy.user_rights.portability.description') }}</li>
                            <li><strong>{{ __('legal.privacy.user_rights.objection.title') }}:</strong> {{ __('legal.privacy.user_rights.objection.description') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="mb-16">
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('legal.privacy.contact.title') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('legal.privacy.contact.data_protection_officer.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('legal.privacy.contact.data_protection_officer.email') }}</p>
                            <p class="text-gray-300 mb-2">{{ __('legal.privacy.contact.data_protection_officer.phone') }}</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('legal.privacy.contact.supervisory_authority.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('legal.privacy.contact.supervisory_authority.name') }}</p>
                            <p class="text-gray-300 mb-2">
                                Website: <a href="{{ __('legal.privacy.contact.supervisory_authority.website') }}" target="_blank" class="text-blue-400 hover:underline">{{ __('legal.privacy.contact.supervisory_authority.website') }}</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <a href="{{ route('contact.show') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition-colors">
                            {{ __('legal.privacy.contact.contact_button') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>