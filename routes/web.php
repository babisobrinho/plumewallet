<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role_type:client',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.client.dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role_type:staff',
])->prefix('backoffice')->name('backoffice.')->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.backoffice.dashboard');
    })->name('dashboard');
});
