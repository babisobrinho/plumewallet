<?php

return [
    'privacy' => [
        'title' => 'Privacy Policy',
        'subtitle' => 'How we collect, use and protect your personal data',
        'last_updated' => 'Last updated: January 2025',
        'introduction' => [
            'title' => 'Introduction',
            'description' => 'Plume Wallet is committed to protecting your privacy. This Privacy Policy explains what personal data we collect, why we collect it and how we use it to provide and improve our services.',
            'gdpr_compliance' => 'This policy follows applicable data protection laws, including the EU General Data Protection Regulation (GDPR).',
        ],
        'data_controller' => [
            'title' => 'Data Controller',
            'name' => 'Plume Wallet',
            'address' => 'Rua da Inovação, 123, 1000-001 Lisbon, Portugal',
            'email' => 'privacy@plume.pt',
            'phone' => '+351 987 456 680',
        ],
        'data_collection' => [
            'title' => 'Data Collection',
            'description' => 'We collect different types of data to provide and improve our services, including personal, financial and technical data.',
            'personal_data' => [
                'title' => 'Personal Data',
                'name' => 'Full name and contact information',
                'email' => 'Email address for communication',
                'phone' => 'Phone number (optional)',
                'address' => 'Postal address (optional)',
                'birth_date' => 'Date of birth for age verification',
            ],
            'financial_data' => [
                'title' => 'Financial Data',
                'transactions' => 'Transaction history and financial movements',
                'accounts' => 'Information about connected bank accounts',
                'budgets' => 'Budgets and financial goals you create',
                'goals' => 'Savings and investment goals',
            ],
            'technical_data' => [
                'title' => 'Technical Data',
                'ip_address' => 'IP address for security and analytics',
                'browser' => 'Browser type and version',
                'device' => 'Device information',
                'cookies' => 'Cookie data and similar technologies',
            ],
        ],
        'legal_basis' => [
            'title' => 'Legal Basis for Processing',
            'description' => 'We process personal data when we have a legal basis to do so, such as consent, contract performance, legitimate interests or legal obligations.',
            'consent' => [
                'title' => 'Consent',
                'description' => 'When you give explicit consent for specific processing activities.',
            ],
            'contract' => [
                'title' => 'Contract',
                'description' => 'When processing is necessary to provide the services you requested.',
            ],
            'legitimate_interest' => [
                'title' => 'Legitimate Interest',
                'description' => 'For improving our services, fraud prevention and ensuring security.',
            ],
            'legal_obligation' => [
                'title' => 'Legal Obligation',
                'description' => 'When we must process data to comply with laws or regulatory requirements.',
            ],
        ],
        'user_rights' => [
            'title' => 'Your Rights',
            'description' => 'Depending on your jurisdiction, you may have rights regarding your personal data, such as access, correction, deletion and portability.',
            'access' => [
                'title' => 'Right of Access',
                'description' => 'You can request information about the data we hold about you.',
            ],
            'rectification' => [
                'title' => 'Right to Rectification',
                'description' => 'You can correct inaccurate or incomplete data.',
            ],
            'erasure' => [
                'title' => 'Right to Erasure',
                'description' => 'You can request deletion of your personal data where applicable.',
            ],
            'restriction' => [
                'title' => 'Right to Restrict Processing',
                'description' => 'You may request limits on how we process your data in certain circumstances.',
            ],
            'portability' => [
                'title' => 'Right to Data Portability',
                'description' => 'You can request a copy of your data in a structured, machine-readable format.',
            ],
            'objection' => [
                'title' => 'Right to Object',
                'description' => 'You can object to certain processing activities, such as direct marketing.',
            ],
        ],
        'contact' => [
            'title' => 'Contact',
            'data_protection_officer' => [
                'title' => 'Data Protection Officer',
                'email' => 'dpo@plume.pt',
                'phone' => '+351 987 456 680',
            ],
            'supervisory_authority' => [
                'title' => 'Supervisory Authority',
                'name' => 'Commission Nationale de l\'Informatique et des Libertés (CNIL) / Local Authorities',
                'website' => 'https://www.cnil.fr/',
            ],
            'contact_button' => 'Contact Us',
        ],
    ],

    'security' => [
        'title' => 'Security',
        'subtitle' => 'How we protect your account and data',
        'last_updated' => 'Last updated: January 2025',
        'introduction' => [
            'title' => 'Introduction',
            'description' => 'Security is a core priority at Plume Wallet. We implement technical and organizational measures to protect user data and maintain service availability.',
            'commitment' => 'We continually invest in security, audits and best practices to keep your information safe.',
        ],
        'security_measures' => [
            'title' => 'Security Measures',
            'description' => 'We apply industry-standard controls to protect data, infrastructure and services.',
            'encryption' => [
                'title' => 'Encryption',
                'description' => 'Data is encrypted at rest and in transit using strong cryptographic algorithms.',
            ],
            'access_control' => [
                'title' => 'Access Control',
                'description' => 'Strict access policies and role-based permissions limit access to sensitive data.',
            ],
            'monitoring' => [
                'title' => 'Monitoring',
                'description' => 'Continuous monitoring and logging help detect and respond to security events.',
            ],
            'backup' => [
                'title' => 'Backup & Recovery',
                'description' => 'We maintain backups and tested recovery procedures to ensure resilience.',
            ],
        ],
        'data_protection' => [
            'title' => 'Data Protection',
            'description' => 'We minimise data retention and apply technical measures to safeguard personal information.',
            'storage' => [
                'title' => 'Storage',
                'description' => 'Encrypted storage and secure servers',
                'encrypted_storage' => 'Encrypted databases and backups',
                'secure_servers' => 'Hardened servers in trusted data centers',
                'geographic_restrictions' => 'Data residency and geographic restrictions where applicable',
            ],
            'transmission' => [
                'title' => 'Transmission',
                'description' => 'All network communication is protected using TLS.',
                'tls_encryption' => 'TLS encryption for data in transit',
                'secure_protocols' => 'Secure protocols and certificate validation',
                'certificate_validation' => 'Proper certificate management and validation',
            ],
            'processing' => [
                'title' => 'Processing',
                'description' => 'We follow principles of data minimization and purpose limitation.',
                'minimal_data' => 'Collect only the data necessary to provide the service',
                'purpose_limitation' => 'Use data only for declared purposes',
                'data_minimization' => 'Retention and deletion policies',
            ],
        ],
        'authentication' => [
            'title' => 'Authentication',
            'description' => 'We offer strong authentication options and best practices to secure accounts.',
            'password_security' => [
                'title' => 'Password Security',
                'hashing' => 'Secure password hashing and storage',
                'complexity' => 'Encourage strong passwords and complexity requirements',
                'expiration' => 'Optional password expiration policies',
                'history' => 'Policies to prevent reuse where applicable',
            ],
            'multi_factor' => [
                'title' => 'Multi-factor Authentication',
                'sms' => 'SMS verification as an option',
                'email' => 'Email verification for critical actions',
                'authenticator' => 'Support for authenticator apps (TOTP)',
                'backup_codes' => 'Backup codes for account recovery',
            ],
        ],
        'infrastructure' => [
            'title' => 'Infrastructure Security',
            'description' => 'Secure hosting, network controls and operational practices protect our platform.',
            'cloud_security' => [
                'title' => 'Cloud Security',
                'description' => 'Secure cloud configurations and managed services',
            ],
            'network_security' => [
                'title' => 'Network Security',
                'description' => 'Firewalls, segmentation and secure network architecture',
            ],
            'updates' => [
                'title' => 'Patching & Updates',
                'description' => 'Regular updates and vulnerability management',
            ],
            'incident_response' => [
                'title' => 'Incident Response',
                'description' => 'Formal incident response plans and post-incident reviews',
            ],
        ],
        'compliance' => [
            'title' => 'Compliance',
            'description' => 'We align with relevant security standards and regulatory requirements.',
            'gdpr' => [
                'title' => 'GDPR',
                'description' => 'We follow GDPR principles such as data protection by design and user rights.',
                'data_protection' => 'Data protection practices and privacy by design',
                'privacy_by_design' => 'Embedding privacy into product design',
                'user_rights' => 'Respect user rights and transparency',
            ],
            'iso' => [
                'title' => 'ISO & Standards',
                'description' => 'We adopt recognized security frameworks and continuous improvement practices.',
                'security_management' => 'Security management processes',
                'risk_assessment' => 'Regular risk assessments and audits',
                'continuous_improvement' => 'Ongoing security improvements',
            ],
        ],
        'user_responsibilities' => [
            'title' => 'User Responsibilities',
            'description' => 'Users should follow best practices to help keep their accounts secure.',
            'best_practices' => [
                'title' => 'Best Practices',
                'strong_passwords' => 'Use strong, unique passwords',
                'two_factor' => 'Enable two-factor authentication',
                'secure_devices' => 'Keep your devices and apps updated',
                'regular_updates' => 'Install security updates promptly',
                'suspicious_activity' => 'Report suspicious activity immediately',
                'logout' => 'Log out from shared devices',
            ],
        ],
        'incident_response' => [
            'title' => 'Incident Response',
            'description' => 'If an incident occurs, we follow a defined process to detect, contain and recover services.',
            'detection' => [
                'title' => 'Detection',
                'description' => 'Automated monitoring and user reports',
                'automated_monitoring' => 'Continuous security monitoring',
                'user_reports' => 'Channels for users to report issues',
                'security_audits' => 'Regular security audits',
            ],
            'response' => [
                'title' => 'Response',
                'description' => 'Containment, assessment and notification procedures',
                'immediate_containment' => 'Immediate containment steps',
                'assessment' => 'Impact assessment and remediation planning',
                'notification' => 'User and authority notification when required',
            ],
            'recovery' => [
                'title' => 'Recovery',
                'description' => 'Restoration and lessons learned processes',
                'data_restoration' => 'Data restoration procedures',
                'service_restoration' => 'Service restoration and testing',
                'lessons_learned' => 'Post-incident reviews and improvements',
            ],
        ],
        'contact' => [
            'title' => 'Contact',
            'security_team' => [
                'title' => 'Security Team',
                'email' => 'security@plume.pt',
                'phone' => '+351 987 456 680',
            ],
            'reporting' => [
                'title' => 'Reporting',
                'vulnerability' => 'Report vulnerabilities to security@plume.pt',
                'incident' => 'Report incidents using the support form or email',
            ],
            'contact_button' => 'Contact Support',
        ],
    ],

    'terms' => [
        'title' => 'Terms of Use',
        'subtitle' => 'Rules and conditions for using Plume Wallet',
        'last_updated' => 'Last updated: January 2025',
        'introduction' => [
            'title' => 'Introduction',
            'description' => 'These Terms govern your access and use of Plume Wallet services. By using the service you agree to these Terms.',
            'acceptance' => 'By accessing or using our services you accept and agree to be bound by these Terms.',
        ],
        'service_description' => [
            'title' => 'Service Description',
            'description' => 'Plume Wallet provides tools to manage budgets, track transactions, set goals and access reports via web and mobile applications.',
            'features' => [
                'title' => 'Key Features',
                'budget_management' => 'Budget management and categorization',
                'transaction_tracking' => 'Transaction importing and categorization',
                'financial_reports' => 'Personalized financial reports',
                'goal_setting' => 'Savings and goal planning',
                'mobile_access' => 'Access via mobile applications',
            ],
        ],
        'user_accounts' => [
            'title' => 'User Accounts',
            'description' => 'Account creation and basic rules for account ownership and security.',
            'registration' => [
                'title' => 'Registration',
                'age_requirement' => 'Users must meet minimum age requirements to register.',
                'accurate_information' => 'Provide accurate and up-to-date information.',
                'account_security' => 'Keep your credentials secure and notify us of unauthorized access.',
                'one_account' => 'Each user should maintain a single account unless otherwise permitted.',
            ],
            'prohibited' => [
                'title' => 'Prohibited Conduct',
                'false_information' => 'Do not provide false or misleading information.',
                'account_sharing' => 'Do not share your account credentials.',
                'unauthorized_access' => 'Do not attempt unauthorized access to the service.',
                'multiple_accounts' => 'Do not create multiple accounts for abusive purposes.',
            ],
        ],
        'acceptable_use' => [
            'title' => 'Acceptable Use',
            'description' => 'Guidelines on acceptable and prohibited uses of the service.',
            'prohibited_activities' => [
                'title' => 'Prohibited Activities',
                'illegal_activities' => 'Illegal activities or fraud',
                'harmful_content' => 'Distribution of harmful or infringing content',
                'system_disruption' => 'Actions that disrupt the service',
                'data_mining' => 'Automated data scraping or mining',
                'reverse_engineering' => 'Reverse engineering or tampering with the service',
            ],
            'responsible_use' => [
                'title' => 'Responsible Use',
                'compliance' => 'Comply with applicable laws and respect other users',
                'respect' => 'Respect privacy and intellectual property rights',
                'security' => 'Follow security best practices',
                'reporting' => 'Report abuses or vulnerabilities',
            ],
        ],
        'privacy_data' => [
            'title' => 'Privacy & Data',
            'description' => 'How privacy and data protection are handled; links to the Privacy Policy.',
            'gdpr_compliance' => [
                'title' => 'Privacy Policy',
                'description' => 'Refer to our Privacy Policy for details on data handling and user rights.',
                'privacy_policy' => 'View Privacy Policy',
            ],
        ],
        'intellectual_property' => [
            'title' => 'Intellectual Property',
            'description' => 'Our rights and user content rules.',
            'our_rights' => [
                'title' => 'Our Rights',
                'software' => 'All software, designs and trademarks are our property.',
                'content' => 'Content on the site is protected by copyright.',
                'trademarks' => 'All trademarks are our property.',
                'designs' => 'Designs and trade dress are protected.',
            ],
            'user_content' => [
                'title' => 'User Content',
                'ownership' => 'Users retain ownership of content they submit where applicable.',
                'license' => 'By submitting content you grant us a license to operate the service.',
                'responsibility' => 'Users are responsible for the legality of their content.',
                'removal' => 'We may remove content that violates the Terms.',
            ],
        ],
        'service_availability' => [
            'title' => 'Service Availability',
            'description' => 'Information about uptime, maintenance and third-party services.',
            'disclaimers' => [
                'title' => 'Disclaimers',
                'no_guarantee' => 'No guarantee of uninterrupted service',
                'maintenance' => 'Scheduled maintenance windows',
                'technical_issues' => 'Possible technical issues and limitations',
                'third_party' => 'Dependence on third-party providers',
            ],
        ],
        'limitation_liability' => [
            'title' => 'Limitation of Liability',
            'description' => 'Limits on our liability for damages related to the service.',
            'exclusions' => [
                'title' => 'Exclusions',
                'direct_damages' => 'Direct damages',
                'indirect_damages' => 'Indirect or consequential damages',
                'consequential_damages' => 'Loss of profits or data',
                'lost_profits' => 'Lost profits or business interruption',
            ],
        ],
        'termination' => [
            'title' => 'Termination',
            'description' => 'How accounts may be suspended or terminated.',
            'user_termination' => [
                'title' => 'User Termination',
                'description' => 'How a user can close their account and request data deletion.',
                'account_settings' => 'Account settings to close or deactivate an account',
                'contact_support' => 'Contact support to request deletion or closure',
                'data_deletion' => 'Data deletion policies and timelines',
            ],
            'company_termination' => [
                'title' => 'Company Termination',
                'description' => 'Circumstances where we may suspend or terminate accounts.',
                'violation' => 'Violation of terms',
                'fraud' => 'Fraud or illegal activity',
                'illegal_use' => 'Illegal use of the service',
            ],
        ],
        'changes' => [
            'title' => 'Changes to Terms',
            'description' => 'We may update these Terms from time to time and will notify users as appropriate.',
            'notification' => [
                'title' => 'Notification',
                'email' => 'Notifications may be sent by email',
                'website' => 'Changes will be posted on our website',
                'app' => 'Important changes may also be communicated through the app',
            ],
        ],
        'governing_law' => [
            'title' => 'Governing Law',
            'description' => 'These Terms are governed by the laws of the applicable jurisdiction.',
            'jurisdiction' => [
                'title' => 'Jurisdiction',
                'description' => 'Portuguese law applies to disputes arising from these Terms where applicable.',
                'courts' => 'Courts of Lisbon or other competent courts',
            ],
        ],
        'contact' => [
            'title' => 'Contact',
            'legal' => [
                'title' => 'Legal Contact',
                'email' => 'legal@plume.pt',
                'phone' => '+351 987 456 680',
            ],
            'support' => [
                'title' => 'Support',
                'email' => 'support@plume.pt',
                'hours' => 'Mon-Fri 9:00-18:00',
            ],
            'contact_button' => 'Contact Support',
        ],
    ],
];
