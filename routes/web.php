<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação e Verificação de E-mail
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {
    // Página de aviso de verificação
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Processar o link de verificação
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()
            ->route('dashboard')
            ->with('success', 'E-mail verificado com sucesso!');
    })->middleware('signed')->name('verification.verify');

    // Reenviar e-mail de verificação
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()
            ->with('success', 'Novo link de verificação enviado para seu e-mail!');
    })->middleware('throttle:6,1')->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Requerem Autenticação + E-mail Verificado)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestão de Carteiras
    Route::resource('accounts', AccountController::class)->except(['show']);

    // Rota para visualizar a carteira (detalhes)
    Route::get('accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');

    // Rota customizada para alternar status
    Route::patch('accounts/{account}/toggle-status',
        [AccountController::class, 'toggleStatus'])
        ->name('accounts.toggle-status');

    // API para gráficos
    Route::get('api/accounts/data',
        [AccountController::class, 'apiData'])
        ->name('accounts.api.data');
});

/*
|--------------------------------------------------------------------------
| Rotas de Compatibilidade e Redirecionamento
|--------------------------------------------------------------------------
*/
Route::redirect('/carteira', '/wallets')
    ->middleware(['auth:sanctum', 'verified']);

/*
|--------------------------------------------------------------------------
| Rotas de Desenvolvimento (Remover em Produção)
|--------------------------------------------------------------------------
*/
if (app()->environment('local')) {
    Route::get('/test-verify', function() {
        if (!auth()->user()->hasVerifiedEmail()) {
            auth()->user()->sendEmailVerificationNotification();
            return response()->json([
                'message' => 'E-mail de verificação enviado para ' . auth()->user()->email
            ]);
        }
        return response()->json(['message' => 'E-mail já verificado']);
    })->middleware('auth:sanctum');
}
