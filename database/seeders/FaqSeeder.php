<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Enums\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create FAQs for each category
        $this->createGeneralFaqs();
        $this->createAccountFaqs();
        $this->createTransactionFaqs();
        $this->createSecurityFaqs();
        $this->createBillingFaqs();
        $this->createTechnicalFaqs();
        $this->createFeatureFaqs();
        $this->createSupportFaqs();
    }

    private function createGeneralFaqs(): void
    {
        $faqs = [
            [
                'question' => 'What is this platform about?',
                'answer' => '<p>Our platform is a comprehensive financial management tool designed to help you track expenses, manage budgets, and gain insights into your financial habits. It provides a secure and user-friendly environment for managing your personal or business finances.</p>',
                'category' => FaqCategory::GENERAL,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How do I get started?',
                'answer' => '<p>Getting started is easy! Simply create an account, verify your email, and you\'ll be guided through a quick setup process. You can start by adding your first account or importing existing financial data.</p>',
                'category' => FaqCategory::GENERAL,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Is this service free?',
                'answer' => '<p>We offer both free and premium plans. The free plan includes basic features for personal use, while our premium plans offer advanced features, priority support, and enhanced security options.</p>',
                'category' => FaqCategory::GENERAL,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createAccountFaqs(): void
    {
        $faqs = [
            [
                'question' => 'How do I create an account?',
                'answer' => '<p>Creating an account is simple. Click the "Sign Up" button, enter your email address and password, then verify your email address. You\'ll receive a confirmation email with a verification link.</p>',
                'category' => FaqCategory::ACCOUNT,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How do I reset my password?',
                'answer' => '<p>If you\'ve forgotten your password, click "Forgot Password" on the login page. Enter your email address and we\'ll send you a secure link to reset your password.</p>',
                'category' => FaqCategory::ACCOUNT,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Can I change my email address?',
                'answer' => '<p>Yes, you can change your email address in your account settings. You\'ll need to verify the new email address before the change takes effect.</p>',
                'category' => FaqCategory::ACCOUNT,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createTransactionFaqs(): void
    {
        $faqs = [
            [
                'question' => 'How do I add a transaction?',
                'answer' => '<p>Adding transactions is easy. Go to the Transactions page and click "Add Transaction". Fill in the details like amount, description, category, and date. You can also set up recurring transactions for regular expenses.</p>',
                'category' => FaqCategory::TRANSACTIONS,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Can I edit past transactions?',
                'answer' => '<p>Yes, you can edit any transaction by clicking on it in the transaction list. This is useful for correcting mistakes or updating transaction details.</p>',
                'category' => FaqCategory::TRANSACTIONS,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'How do I categorize transactions?',
                'answer' => '<p>Transactions can be categorized using our predefined categories or custom categories you create. Categories help you organize and analyze your spending patterns.</p>',
                'category' => FaqCategory::TRANSACTIONS,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createSecurityFaqs(): void
    {
        $faqs = [
            [
                'question' => 'How is my data protected?',
                'answer' => '<p>Your data is protected with bank-level encryption, secure servers, and regular security audits. We use industry-standard security practices to ensure your financial information remains safe.</p>',
                'category' => FaqCategory::SECURITY,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'What security measures are in place?',
                'answer' => '<p>We implement multiple security layers including SSL encryption, two-factor authentication, regular security updates, and monitoring for suspicious activity.</p>',
                'category' => FaqCategory::SECURITY,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createBillingFaqs(): void
    {
        $faqs = [
            [
                'question' => 'How does billing work?',
                'answer' => '<p>Billing is handled securely through our payment partners. You can choose monthly or annual billing cycles, and all payments are processed securely with automatic renewals.</p>',
                'category' => FaqCategory::ACCOUNT,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'What payment methods are accepted?',
                'answer' => '<p>We accept all major credit cards, PayPal, and bank transfers. All payments are processed securely through our trusted payment partners.</p>',
                'category' => FaqCategory::ACCOUNT,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createTechnicalFaqs(): void
    {
        $faqs = [
            [
                'question' => 'What are the system requirements?',
                'answer' => '<p>Our platform works on all modern browsers and devices. For the best experience, we recommend using the latest version of Chrome, Firefox, Safari, or Edge.</p>',
                'category' => FaqCategory::TECHNICAL,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How do I troubleshoot issues?',
                'answer' => '<p>If you\'re experiencing issues, try clearing your browser cache, disabling browser extensions, or using a different browser. You can also contact our support team for assistance.</p>',
                'category' => FaqCategory::TECHNICAL,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createFeatureFaqs(): void
    {
        $faqs = [
            [
                'question' => 'What features are available?',
                'answer' => '<p>Our platform includes transaction tracking, budget management, reporting tools, goal setting, data export, and much more. Premium users get access to advanced features and priority support.</p>',
                'category' => FaqCategory::FEATURES,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How do I use the dashboard?',
                'answer' => '<p>The dashboard provides an overview of your financial situation. You can customize it to show the information most important to you, including account balances, recent transactions, and budget progress.</p>',
                'category' => FaqCategory::FEATURES,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }

    private function createSupportFaqs(): void
    {
        $faqs = [
            [
                'question' => 'How do I get help?',
                'answer' => '<p>You can get help through our support center, email support, or live chat. Premium users get priority support with faster response times.</p>',
                'category' => FaqCategory::SUPPORT,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'What support options are available?',
                'answer' => '<p>We offer multiple support channels including email, live chat, phone support for premium users, and a comprehensive knowledge base with tutorials and guides.</p>',
                'category' => FaqCategory::SUPPORT,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}