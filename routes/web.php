<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController; // Importe o TransactionController
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Rotas Institucionais
Route::prefix('institutional')->name('institutional.')->group(function () {
    Route::get('/', [App\Http\Controllers\InstitutionalController::class, 'index'])->name('index');
    Route::get('/sobre-nos', [App\Http\Controllers\InstitutionalController::class, 'aboutUs'])->name('about-us');
    Route::get('/como-funciona', [App\Http\Controllers\InstitutionalController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/faq', [App\Http\Controllers\InstitutionalController::class, 'faq'])->name('faq');
    Route::get('/blog', [App\Http\Controllers\InstitutionalController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [App\Http\Controllers\InstitutionalController::class, 'blogShow'])->name('blog.show');
    Route::get('/contacto', [App\Http\Controllers\InstitutionalController::class, 'contact'])->name('contact');
    Route::post('/contacto', [App\Http\Controllers\InstitutionalController::class, 'contactSubmit'])->name('contact.submit');
});

// Rota para trocar idioma
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Rota raiz redireciona para a página institucional
Route::get("/", function () {
    return redirect()->route('institutional.index');
});

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação e Verificação de E-mail
|--------------------------------------------------------------------------
*/
Route::middleware(["auth:sanctum"])->group(function () {
    Route::get("/email/verify", function () {
        return view("auth.verify-email");
    })->name("verification.notice");

    Route::get("/email/verify/{id}/{hash}", function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route("dashboard")->with("success", "E-mail verificado com sucesso!");
    })->middleware("signed")->name("verification.verify");

    Route::post("/email/verification-notification", function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with("success", "Novo link de verificação enviado para seu e-mail!");
    })->middleware("throttle:6,1")->name("verification.send");
});

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Requerem Autenticação + E-mail Verificado)
|--------------------------------------------------------------------------
*/
Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified"
])->group(function () {
    // Dashboard
    Route::get("/dashboard", function () {
        return view("dashboard");
    })->name("dashboard");

    // Rotas de Budget (YNAB)
    Route::resource('budget', BudgetController::class);

    // Rotas de Accounts - Definidas manualmente para maior controle
    Route::prefix("accounts")->name("accounts.")->group(function () {
        Route::get("/",[AccountController::class, "index"])->name("index");
        Route::get("/archive",[AccountController::class, "archive"])->name("archive");
        Route::get("/create",[AccountController::class, "create"])->name("create");
        Route::post("/",[AccountController::class, "store"])->name("store");
        Route::get("/{account}",[AccountController::class, "show"])->name("show");
        Route::get("/{account}/edit",[AccountController::class, "edit"])->name("edit");
        Route::put("/{account}",[AccountController::class, "update"])->name("update");
        Route::delete("/{account}",[AccountController::class, "destroy"])->name("destroy");

        // Rotas customizadas
        Route::patch("/{account}/toggle-status",[AccountController::class, "toggleStatus"])
            ->name("toggle-status");

        Route::patch("/{account}/toggle-balance-effective",[AccountController::class, "toggleBalanceEffective"])
            ->name("toggle-balance-effective");

        // API
        Route::get("/api/data",[AccountController::class, "apiData"])
            ->name("api.data");
    });

    // Rotas de Rendimentos
    Route::prefix("incomes")->name("incomes.")->group(function () {
        Route::get("/",[TransactionsController::class, "incomes"])->name("index");
        Route::get("/create",[TransactionsController::class, "createIncome"])->name("create");
        Route::post("/",[TransactionsController::class, "storeIncome"])->name("store");
        Route::get("/{id}",[TransactionsController::class, "showIncome"])->name("show");
        Route::get("/{id}/edit",[TransactionsController::class, "editIncome"])->name("edit");
        Route::put("/{id}",[TransactionsController::class, "updateIncome"])->name("update");
        Route::delete("/{id}",[TransactionsController::class, "destroy"])->name("destroy");
    });

    // Rotas de Despesas
    Route::prefix("expenses")->name("expenses.")->group(function () {
        Route::get("/",[TransactionsController::class, "expenses"])->name("index");
        Route::get("/create",[TransactionsController::class, "createExpense"])->name("create");
        Route::post("/",[TransactionsController::class, "storeExpense"])->name("store");
        Route::get("/{id}",[TransactionsController::class, "showExpense"])->name("show");
        Route::get("/{id}/edit",[TransactionsController::class, "editExpense"])->name("edit");
        Route::put("/{id}",[TransactionsController::class, "updateExpense"])->name("update");
        Route::delete("/{id}",[TransactionsController::class, "destroy"])->name("destroy");
    });

    // Rotas de atalho para acesso direto
    Route::get("/transactions/incomes",[TransactionsController::class, "incomes"])->name("transactions.incomes");
    Route::get("/transactions/expenses",[TransactionsController::class, "expenses"])->name("transactions.expenses");

    // API para dados de transações
    Route::get("/transactions/api/data",[TransactionsController::class, "apiData"])->name("transactions.api.data");
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rota principal que redireciona para categories.index
    Route::get('/', [CategoryController::class, 'index'])->name('dashboard');

    // Rotas de Categorias (Resourceful para CRUD completo)
    Route::resource('categories', CategoryController::class);

    // Rotas de Transações (Resourceful para CRUD completo)
    Route::resource('transactions', TransactionController::class);

    Route::get('categories/{category}/transactions', [TransactionController::class, 'transactionsByCategory'])->name('categories.transactions');
});

/*
|--------------------------------------------------------------------------
| Rotas do Backoffice
|--------------------------------------------------------------------------
*/
require __DIR__.'/backoffice.php';

