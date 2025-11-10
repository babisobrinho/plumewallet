<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="bg-gray-800 py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ __('legal.security.title') }}
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    {{ __('legal.security.subtitle') }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ __('legal.security.last_updated') }}
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.introduction.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.introduction.description') }}</p>
                        <p class="mb-4">{{ __('legal.security.introduction.commitment') }}</p>
                    </div>
                </div>
            </div>

            <!-- Security Measures -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.security_measures.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.security_measures.description') }}</p>
                        <ul class="list-disc list-inside text-gray-700 mb-6 ml-4">
                            <li><strong>{{ __('legal.security.security_measures.encryption.title') }}:</strong> {{ __('legal.security.security_measures.encryption.description') }}</li>
                            <li><strong>{{ __('legal.security.security_measures.access_control.title') }}:</strong> {{ __('legal.security.security_measures.access_control.description') }}</li>
                            <li><strong>{{ __('legal.security.security_measures.monitoring.title') }}:</strong> {{ __('legal.security.security_measures.monitoring.description') }}</li>
                            <li><strong>{{ __('legal.security.security_measures.backup.title') }}:</strong> {{ __('legal.security.security_measures.backup.description') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Data Protection -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.data_protection.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.data_protection.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('legal.security.data_protection.storage.title') }}</h3>
                                <p class="text-blue-800 text-sm mb-3">{{ __('legal.security.data_protection.storage.description') }}</p>
                                <ul class="list-disc pl-6 text-blue-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.data_protection.storage.encrypted_storage') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.storage.secure_servers') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.storage.geographic_restrictions') }}</li>
                                </ul>
                            </div>
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('legal.security.data_protection.transmission.title') }}</h3>
                                <p class="text-green-800 text-sm mb-3">{{ __('legal.security.data_protection.transmission.description') }}</p>
                                <ul class="list-disc pl-6 text-green-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.data_protection.transmission.tls_encryption') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.transmission.secure_protocols') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.transmission.certificate_validation') }}</li>
                                </ul>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-purple-900 mb-3">{{ __('legal.security.data_protection.processing.title') }}</h3>
                                <p class="text-purple-800 text-sm mb-3">{{ __('legal.security.data_protection.processing.description') }}</p>
                                <ul class="list-disc pl-6 text-purple-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.data_protection.processing.minimal_data') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.processing.purpose_limitation') }}</li>
                                    <li class="mb-1">{{ __('legal.security.data_protection.processing.data_minimization') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Authentication -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.authentication.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.authentication.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('legal.security.authentication.password_security.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600 text-sm">
                                    <li class="mb-2">{{ __('legal.security.authentication.password_security.hashing') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.password_security.complexity') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.password_security.expiration') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.password_security.history') }}</li>
                                </ul>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('legal.security.authentication.multi_factor.title') }}</h3>
                                <ul class="list-disc pl-6 text-gray-600 text-sm">
                                    <li class="mb-2">{{ __('legal.security.authentication.multi_factor.sms') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.multi_factor.email') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.multi_factor.authenticator') }}</li>
                                    <li class="mb-2">{{ __('legal.security.authentication.multi_factor.backup_codes') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Infrastructure Security -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.infrastructure.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.infrastructure.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('legal.security.infrastructure.cloud_security.title') }}</h3>
                                <p class="text-blue-800 text-sm">{{ __('legal.security.infrastructure.cloud_security.description') }}</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('legal.security.infrastructure.network_security.title') }}</h3>
                                <p class="text-green-800 text-sm">{{ __('legal.security.infrastructure.network_security.description') }}</p>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-yellow-900 mb-3">{{ __('legal.security.infrastructure.updates.title') }}</h3>
                                <p class="text-yellow-800 text-sm">{{ __('legal.security.infrastructure.updates.description') }}</p>
                            </div>
                            <div class="bg-red-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-red-900 mb-3">{{ __('legal.security.infrastructure.incident_response.title') }}</h3>
                                <p class="text-red-800 text-sm">{{ __('legal.security.infrastructure.incident_response.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compliance -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.compliance.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.compliance.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('legal.security.compliance.gdpr.title') }}</h3>
                                <p class="text-blue-800 text-sm mb-3">{{ __('legal.security.compliance.gdpr.description') }}</p>
                                <ul class="list-disc pl-6 text-blue-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.compliance.gdpr.data_protection') }}</li>
                                    <li class="mb-1">{{ __('legal.security.compliance.gdpr.privacy_by_design') }}</li>
                                    <li class="mb-1">{{ __('legal.security.compliance.gdpr.user_rights') }}</li>
                                </ul>
                            </div>
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('legal.security.compliance.iso.title') }}</h3>
                                <p class="text-green-800 text-sm mb-3">{{ __('legal.security.compliance.iso.description') }}</p>
                                <ul class="list-disc pl-6 text-green-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.compliance.iso.security_management') }}</li>
                                    <li class="mb-1">{{ __('legal.security.compliance.iso.risk_assessment') }}</li>
                                    <li class="mb-1">{{ __('legal.security.compliance.iso.continuous_improvement') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Responsibilities -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.user_responsibilities.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.user_responsibilities.description') }}</p>
                        
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('legal.security.user_responsibilities.best_practices.title') }}</h3>
                            <ul class="list-disc pl-6 text-gray-600">
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.strong_passwords') }}</li>
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.two_factor') }}</li>
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.secure_devices') }}</li>
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.regular_updates') }}</li>
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.suspicious_activity') }}</li>
                                <li class="mb-2">{{ __('legal.security.user_responsibilities.best_practices.logout') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Incident Response -->
            <div class="mb-16">
                <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('legal.security.incident_response.title') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p class="mb-4">{{ __('legal.security.incident_response.description') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('legal.security.incident_response.detection.title') }}</h3>
                                <p class="text-blue-800 text-sm mb-3">{{ __('legal.security.incident_response.detection.description') }}</p>
                                <ul class="list-disc pl-6 text-blue-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.incident_response.detection.automated_monitoring') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.detection.user_reports') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.detection.security_audits') }}</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-yellow-900 mb-3">{{ __('legal.security.incident_response.response.title') }}</h3>
                                <p class="text-yellow-800 text-sm mb-3">{{ __('legal.security.incident_response.response.description') }}</p>
                                <ul class="list-disc pl-6 text-yellow-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.incident_response.response.immediate_containment') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.response.assessment') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.response.notification') }}</li>
                                </ul>
                            </div>
                            <div class="bg-green-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('legal.security.incident_response.recovery.title') }}</h3>
                                <p class="text-green-800 text-sm mb-3">{{ __('legal.security.incident_response.recovery.description') }}</p>
                                <ul class="list-disc pl-6 text-green-800 text-sm">
                                    <li class="mb-1">{{ __('legal.security.incident_response.recovery.data_restoration') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.recovery.service_restoration') }}</li>
                                    <li class="mb-1">{{ __('legal.security.incident_response.recovery.lessons_learned') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="mb-16">
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-100">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('legal.security.contact.title') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('legal.security.contact.security_team.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('legal.security.contact.security_team.email') }}</p>
                            <p class="text-gray-300 mb-2">{{ __('legal.security.contact.security_team.phone') }}</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-4 text-white">{{ __('legal.security.contact.reporting.title') }}</h3>
                            <p class="text-gray-300 mb-2">{{ __('legal.security.contact.reporting.vulnerability') }}</p>
                            <p class="text-gray-300 mb-2">{{ __('legal.security.contact.reporting.incident') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <a href="{{ route('contact.show') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition-colors">
                            {{ __('legal.security.contact.contact_button') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>