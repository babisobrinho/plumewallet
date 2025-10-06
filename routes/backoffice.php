<?php

use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\UsersController;
use App\Http\Controllers\Backoffice\SystemSettingsController;
use App\Http\Controllers\Backoffice\SecuritySettingsController;
use App\Http\Controllers\Backoffice\IntegrationsController;
use App\Http\Controllers\Backoffice\LoginAttemptsController;
use App\Http\Controllers\Backoffice\BlogController;
use App\Http\Controllers\Backoffice\BlogCategoryController;
use App\Http\Controllers\Backoffice\FaqController;
use App\Http\Controllers\Backoffice\SupportController;
use App\Http\Controllers\Backoffice\TicketCategoryController;
use App\Http\Controllers\Backoffice\ReportsController;
use App\Http\Controllers\Backoffice\LogsController;
use App\Http\Controllers\Backoffice\TeamsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas do Backoffice
|--------------------------------------------------------------------------
|
| Aqui estão definidas todas as rotas do sistema de backoffice.
| Todas as rotas requerem autenticação e verificação de email.
| TODO: Adicionar middleware de admin quando implementado.
|
*/

Route::prefix('backoffice')->name('backoffice.')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestão de Usuários
    Route::resource('users', UsersController::class);
    Route::patch('users/{user}/activate', [UsersController::class, 'activate'])->name('users.activate');
    Route::patch('users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
    
    // Configurações do Sistema
    Route::prefix('system')->name('system.')->group(function () {
        Route::get('settings', [SystemSettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SystemSettingsController::class, 'update'])->name('settings.update');
        
        Route::get('security', [SecuritySettingsController::class, 'index'])->name('security.index');
        Route::put('security', [SecuritySettingsController::class, 'update'])->name('security.update');
    });
    
    // Integrações
    Route::resource('integrations', IntegrationsController::class);
    Route::patch('integrations/{integration}/toggle', [IntegrationsController::class, 'toggle'])->name('integrations.toggle');
    
    // Tentativas de Login
    Route::get('login-attempts', [LoginAttemptsController::class, 'index'])->name('login-attempts.index');
    Route::get('login-attempts/{loginAttempt}', [LoginAttemptsController::class, 'show'])->name('login-attempts.show');
    
    // Gestão de Conteúdo - Blog
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::resource('posts', BlogController::class);
        Route::resource('categories', BlogCategoryController::class);
        Route::patch('posts/{post}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('posts.toggle-featured');
    });
    
    // FAQ
    Route::resource('faqs', FaqController::class);
    
    // Centro de Suporte
    Route::prefix('support')->name('support.')->group(function () {
        Route::resource('tickets', SupportController::class);
        Route::resource('categories', TicketCategoryController::class);
        Route::patch('tickets/{ticket}/assign', [SupportController::class, 'assign'])->name('tickets.assign');
        Route::patch('tickets/{ticket}/close', [SupportController::class, 'close'])->name('tickets.close');
    });
    
    // Relatórios
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('index');
        Route::get('metrics', [ReportsController::class, 'metrics'])->name('metrics');
        Route::get('templates', [ReportsController::class, 'templates'])->name('templates.index');
        Route::get('saved', [ReportsController::class, 'saved'])->name('saved.index');
    });
    
    // Logs do Sistema
    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [LogsController::class, 'index'])->name('index');
        Route::get('system', [LogsController::class, 'system'])->name('system');
        Route::get('audit', [LogsController::class, 'audit'])->name('audit');
        Route::get('api', [LogsController::class, 'api'])->name('api');
    });
    
    // Gestão de Teams
    Route::resource('teams', TeamsController::class);
    Route::patch('teams/{team}/toggle-status', [TeamsController::class, 'toggleStatus'])->name('teams.toggle-status');
});
