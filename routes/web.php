<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController; // Importe o TransactionController
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rota principal que redireciona para categories.index
    Route::get('/', [CategoryController::class, 'index'])->name('dashboard');

    // Rotas de Categorias (Resourceful para CRUD completo)
    Route::resource('categories', CategoryController::class);

    // Rotas de Transações (Resourceful para CRUD completo)
    Route::resource('transactions', TransactionController::class); // <-- Esta linha cuida disso

});


