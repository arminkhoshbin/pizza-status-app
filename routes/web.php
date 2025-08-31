<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PosSendUpdateController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/pos/send-update');

Route::get('register', [RegisterController::class, 'create'])
    ->name('register.create');

Route::post('register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('login', [LoginController::class, 'create'])
    ->name('login');

Route::post('login', [LoginController::class, 'store'])
    ->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/pos/send-update', [PosSendUpdateController::class, 'create'])
        ->name('pos.send-update.create');

    Route::post('/pos/send-update', [PosSendUpdateController::class, 'store'])
        ->name('pos.send-update.store');

    Route::get('/pos/updates', function () {
        return Inertia::render('Pos/Updates');
    })->name('pos.updates');
});