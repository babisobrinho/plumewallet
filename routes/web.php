<?php

use App\Livewire\App\Dashboard\Show as AppDashboardShow;
use App\Livewire\App\Profile\Show as AppProfileShow;
use App\Livewire\App\Transactions\Index as AppTransactionsIndex;
use App\Livewire\Backoffice\Dashboard\Show as BackofficeDashboardShow;
use App\Livewire\Backoffice\Profile\Show as BackofficeProfileShow;
use App\Livewire\Backoffice\Users\Index as BackofficeUsersIndex;
use App\Livewire\Backoffice\Users\Show as BackofficeUsersShow;
use App\Livewire\Backoffice\Blog\Index as BackofficeBlogIndex;
use App\Livewire\Backoffice\Faq\Index as BackofficeFaqIndex;
use App\Livewire\Backoffice\Logs\Index as BackofficeLogsIndex;
use App\Livewire\Backoffice\LoginAttempts\Index as BackofficeLoginAttemptsIndex;
use Illuminate\Support\Facades\Route;

// Guest Users
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
    });
});
