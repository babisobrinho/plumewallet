<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="bg-gray-800 py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ __('guest.terms.title') }}
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    {{ __('guest.terms.subtitle') }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ __('guest.terms.last_updated') }}
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.introduction.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.introduction.description') }}</p>
                        <p class="mb-4">{{ __('guest.terms.introduction.acceptance') }}</p>
                    </div>
                </div>
            </div>

            <!-- Service Description -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.service_description.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.service_description.description') }}</p>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('guest.terms.service_description.features.title') }}</h3>
                        <ul class="list-disc pl-6 mb-6">
                            <li class="mb-2">{{ __('guest.terms.service_description.features.budget_management') }}</li>
                            <li class="mb-2">{{ __('guest.terms.service_description.features.transaction_tracking') }}</li>
                            <li class="mb-2">{{ __('guest.terms.service_description.features.financial_reports') }}</li>
                            <li class="mb-2">{{ __('guest.terms.service_description.features.goal_setting') }}</li>
                            <li class="mb-2">{{ __('guest.terms.service_description.features.mobile_access') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- User Accounts -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.user_accounts.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.user_accounts.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('guest.terms.user_accounts.registration.title') }}</h3>
                                <ul class="list-disc pl-6 text-green-800 text-sm">
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.registration.age_requirement') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.registration.accurate_information') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.registration.account_security') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.registration.one_account') }}</li>
                                </ul>
                            </div>
                            <div class="bg-red-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-red-900 mb-3">{{ __('guest.terms.user_accounts.prohibited.title') }}</h3>
                                <ul class="list-disc pl-6 text-red-800 text-sm">
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.prohibited.false_information') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.prohibited.account_sharing') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.prohibited.unauthorized_access') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.user_accounts.prohibited.multiple_accounts') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acceptable Use -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.acceptable_use.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.acceptable_use.description') }}</p>
                        
                        <div class="space-y-6">
                            <div class="border-l-4 border-red-500 pl-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600">
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.illegal_activities') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.harmful_content') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.system_disruption') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.data_mining') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.prohibited_activities.reverse_engineering') }}</li>
                                </ul>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('guest.terms.acceptable_use.responsible_use.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600">
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.responsible_use.compliance') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.responsible_use.respect') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.responsible_use.security') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.acceptable_use.responsible_use.reporting') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacy and Data -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.privacy_data.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.privacy_data.description') }}</p>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('guest.terms.privacy_data.gdpr_compliance.title') }}</h3>
                            <p class="text-blue-800 mb-4">{{ __('guest.terms.privacy_data.gdpr_compliance.description') }}</p>
                            <a href="{{ route('privacy.show') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                {{ __('guest.terms.privacy_data.gdpr_compliance.privacy_policy') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Intellectual Property -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.intellectual_property.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.intellectual_property.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('guest.terms.intellectual_property.our_rights.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600 text-sm">
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.our_rights.software') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.our_rights.content') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.our_rights.trademarks') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.our_rights.designs') }}</li>
                                </ul>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('guest.terms.intellectual_property.user_content.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600 text-sm">
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.user_content.ownership') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.user_content.license') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.user_content.responsibility') }}</li>
                                    <li class="mb-2">{{ __('guest.terms.intellectual_property.user_content.removal') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Availability -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.service_availability.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.service_availability.description') }}</p>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-yellow-900 mb-3">{{ __('guest.terms.service_availability.disclaimers.title') }}</h3>
                            <ul class="list-disc pl-6 text-yellow-800">
                                <li class="mb-2">{{ __('guest.terms.service_availability.disclaimers.no_guarantee') }}</li>
                                <li class="mb-2">{{ __('guest.terms.service_availability.disclaimers.maintenance') }}</li>
                                <li class="mb-2">{{ __('guest.terms.service_availability.disclaimers.technical_issues') }}</li>
                                <li class="mb-2">{{ __('guest.terms.service_availability.disclaimers.third_party') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Limitation of Liability -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.limitation_liability.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.limitation_liability.description') }}</p>
                        
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-red-900 mb-3">{{ __('guest.terms.limitation_liability.exclusions.title') }}</h3>
                            <ul class="list-disc pl-6 text-red-800">
                                <li class="mb-2">{{ __('guest.terms.limitation_liability.exclusions.direct_damages') }}</li>
                                <li class="mb-2">{{ __('guest.terms.limitation_liability.exclusions.indirect_damages') }}</li>
                                <li class="mb-2">{{ __('guest.terms.limitation_liability.exclusions.consequential_damages') }}</li>
                                <li class="mb-2">{{ __('guest.terms.limitation_liability.exclusions.lost_profits') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Termination -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.termination.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.termination.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('guest.terms.termination.user_termination.title') }}</h3>
                                <p class="text-green-800 text-sm mb-3">{{ __('guest.terms.termination.user_termination.description') }}</p>
                                <ul class="list-disc pl-6 text-green-800 text-sm">
                                    <li class="mb-1">{{ __('guest.terms.termination.user_termination.account_settings') }}</li>
                                    <li class="mb-1">{{ __('guest.terms.termination.user_termination.contact_support') }}</li>
                                    <li class="mb-1">{{ __('guest.terms.termination.user_termination.data_deletion') }}</li>
                                </ul>
                            </div>
                            <div class="bg-red-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-red-900 mb-3">{{ __('guest.terms.termination.company_termination.title') }}</h3>
                                <p class="text-red-800 text-sm mb-3">{{ __('guest.terms.termination.company_termination.description') }}</p>
                                <ul class="list-disc pl-6 text-red-800 text-sm">
                                    <li class="mb-1">{{ __('guest.terms.termination.company_termination.violation') }}</li>
                                    <li class="mb-1">{{ __('guest.terms.termination.company_termination.fraud') }}</li>
                                    <li class="mb-1">{{ __('guest.terms.termination.company_termination.illegal_use') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Changes to Terms -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.changes.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.changes.description') }}</p>
                        
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('guest.terms.changes.notification.title') }}</h3>
                            <ul class="list-disc pl-6 text-gray-600">
                                <li class="mb-2">{{ __('guest.terms.changes.notification.email') }}</li>
                                <li class="mb-2">{{ __('guest.terms.changes.notification.website') }}</li>
                                <li class="mb-2">{{ __('guest.terms.changes.notification.app') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Governing Law -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('guest.terms.governing_law.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('guest.terms.governing_law.description') }}</p>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('guest.terms.governing_law.jurisdiction.title') }}</h3>
                            <p class="text-blue-800 mb-2">{{ __('guest.terms.governing_law.jurisdiction.description') }}</p>
                            <p class="text-blue-800">{{ __('guest.terms.governing_law.jurisdiction.courts') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="mb-16">
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('guest.terms.contact.title') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('guest.terms.contact.legal.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('guest.terms.contact.legal.email') }}</p>
                            <p class="text-gray-300 mb-2">{{ __('guest.terms.contact.legal.phone') }}</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('guest.terms.contact.support.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('guest.terms.contact.support.email') }}</p>
                            <p class="text-gray-300 mb-2">{{ __('guest.terms.contact.support.hours') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <a href="{{ route('contact.show') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition-colors">
                            {{ __('guest.terms.contact.contact_button') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>