<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderUpdateController;
use App\Http\Controllers\PosCreateOrderController;
use App\Http\Controllers\PosSendOrderUpdateController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pos/orders');

Route::get('register', [RegisterController::class, 'create'])
    ->name('register.create');

Route::post('register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('login', [LoginController::class, 'create'])
    ->name('login');

Route::post('login', [LoginController::class, 'store'])
    ->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/pos/orders', [OrdersController::class, 'create'])
        ->name('pos.orders.create');

    Route::get('/pos/create-order', [PosCreateOrderController::class, 'create'])
        ->name('pos.create-order.create');

    Route::post('/pos/create-order', [PosCreateOrderController::class, 'store'])
        ->name('pos.create-order.store');

    Route::get('/orders/{order}/send-update', [PosSendOrderUpdateController::class, 'create'])
        ->name('orders.send-update.create');

    Route::post('/orders/{order}/send-update', [PosSendOrderUpdateController::class, 'store'])
        ->name('orders.send-update.store');

    Route::get('/order/updates', [OrderUpdateController::class, 'create'])
        ->name('order.updates');
});