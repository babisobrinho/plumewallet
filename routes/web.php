<?php

use App\Livewire\App\Dashboard\Show as AppDashboardShow;
use App\Livewire\App\Profile\Show as AppProfileShow;
use App\Livewire\App\Transactions\Index as AppTransactionsIndex;
use App\Livewire\Backoffice\Dashboard\Show as BackofficeDashboardShow;
use App\Livewire\Backoffice\Profile\Show as BackofficeProfileShow;
use App\Livewire\Backoffice\Users\Index as BackofficeUsersIndex;
use App\Livewire\Backoffice\Users\Show as BackofficeUsersShow;
use App\Livewire\Institutional\Homepage\Show as InstitutionalHomepageShow;
use App\Livewire\Institutional\AboutUs\Show as InstitutionalAboutUsShow;
use Illuminate\Support\Facades\Route;

// Institutional Routes (Public)
Route::prefix('institutional')->name('institutional.')->group(function () {
    Route::get('/', InstitutionalHomepageShow::class)->name('homepage.show');
    Route::get('/about-us', InstitutionalAboutUsShow::class)->name('about-us.show');
});

// Root route redirects to institutional homepage
Route::get('/', function () {
    return redirect()->route('institutional.homepage.show');
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
    });
});
