<?php

use App\Livewire\App\Dashboard\Show as AppDashboardShow;
use App\Livewire\App\Profile\Show as AppProfileShow;
use App\Livewire\App\Transactions\Index as AppTransactionsIndex;
use App\Livewire\App\Beneficiaries\Index as AppBeneficiariesIndex;
use App\Livewire\Backoffice\Dashboard\Show as BackofficeDashboardShow;
use App\Livewire\Backoffice\Profile\Show as BackofficeProfileShow;
use App\Livewire\Backoffice\Users\Index as BackofficeUsersIndex;
use App\Livewire\Backoffice\Users\Show as BackofficeUsersShow;
use App\Livewire\Backoffice\Blog\Index as BackofficeBlogIndex;
use App\Livewire\Backoffice\Blog\Create as BackofficeBlogCreate;
use App\Livewire\Backoffice\Blog\Edit as BackofficeBlogEdit;
use App\Livewire\Backoffice\Faq\Index as BackofficeFaqIndex;
use App\Livewire\Backoffice\Logs\Index as BackofficeLogsIndex;
use App\Livewire\Backoffice\LoginAttempts\Index as BackofficeLoginAttemptsIndex;
use App\Livewire\Guest\Homepage as GuestHomepage;
use App\Livewire\Guest\AboutUs as GuestAboutUs;
use App\Livewire\Guest\HowItWorks as GuestHowItWorks;
use App\Livewire\Guest\Faqs as GuestFaqs;
use App\Livewire\Guest\Contact as GuestContact;
use App\Livewire\Backoffice\ContactForms\Index as BackofficeContactFormsIndex;
use App\Livewire\Backoffice\ContactForms\Show as BackofficeContactFormsShow;
use App\Livewire\Guest\Privacy as GuestPrivacy;
use App\Livewire\Guest\Terms as GuestTerms;
use App\Livewire\Guest\Security as GuestSecurity;
use App\Livewire\Guest\Blog as GuestBlog;
use App\Livewire\Guest\BlogPost as GuestBlogPost;
use Illuminate\Support\Facades\Route;

// Guest Routes (Public)
Route::get('/', GuestHomepage::class)->name('homepage.show');
Route::get('/about-us', GuestAboutUs::class)->name('about-us.show');
Route::get('/how-it-works', GuestHowItWorks::class)->name('how-it-works.show');
Route::get('/faqs', GuestFaqs::class)->name('faqs.show');
Route::get('/contact', GuestContact::class)->name('contact.show');
Route::get('/privacy', GuestPrivacy::class)->name('privacy.show');
Route::get('/terms', GuestTerms::class)->name('terms-of-service.show');
Route::get('/security', GuestSecurity::class)->name('security.show');

// Blog Routes
Route::get('/blog', GuestBlog::class)->name('blog.index');
Route::get('/blog/{post:slug}', GuestBlogPost::class)->name('blog.post');

// Email verification for different account
Route::get('/email/verification/different-account', function () {
    return view('auth.email-verification-different-account');
})->name('email.verification.different-account');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Client Users
    Route::middleware('role_type:client')->name('app.')->group(function () {
        // Dashboard
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/', AppDashboardShow::class)->name('show');
        });

        // Client User Profile
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', AppProfileShow::class)->name('show');
        });

        // Financial Transactions
        Route::prefix('transactions')->name('transactions.')->group(function () {
            Route::get('/', AppTransactionsIndex::class)->name('index');
        });

        // Beneficiaries (Avançado)
        Route::prefix('beneficiaries')->name('beneficiaries.')->group(function () {
            Route::get('/', AppBeneficiariesIndex::class)->name('index');
        });
    });

    // Staff Users
    Route::middleware('role_type:staff')->prefix('backoffice')->name('backoffice.')->group(function () {
        // Dashboard
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/', BackofficeDashboardShow::class)->name('show');
        });

        // Staff User Profile
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', BackofficeProfileShow::class)->name('show');
        });

        // Users Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', BackofficeUsersIndex::class)->name('index');
            Route::get('/{user}', BackofficeUsersShow::class)->name('show');
        });

        // Blog Management
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', BackofficeBlogIndex::class)->name('index');
            Route::get('/create', BackofficeBlogCreate::class)->name('create');
            Route::get('/{post}/edit', BackofficeBlogEdit::class)->name('edit');
        });

        // FAQ Management
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('/', BackofficeFaqIndex::class)->name('index');
        });

        // Logs Management
        Route::prefix('logs')->name('logs.')->group(function () {
            Route::get('/', BackofficeLogsIndex::class)->name('index');
        });

        // Login Attempts Management
        Route::prefix('login-attempts')->name('login-attempts.')->group(function () {
            Route::get('/', BackofficeLoginAttemptsIndex::class)->name('index');
        });

        // Contact Forms Management
        Route::prefix('contact-forms')->name('contact-forms.')->group(function () {
            Route::get('/', BackofficeContactFormsIndex::class)->name('index');
            Route::get('/{contactForm}', BackofficeContactFormsShow::class)->name('show');
        });
    });
});
