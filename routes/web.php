<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GivingTypeController;
use App\Http\Controllers\Payment\ForgingBlockController;
use App\Http\Controllers\Payment\PayUController;
use App\Http\Controllers\Payment\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GivingController;

Route::redirect('/', 'donaciones');

Route::prefix('donaciones')->name('donaciones')->group(function () {
    Route::get('/', function () {
        return view('givings.index');
    });

    Route::get('/old', function () {
        return view('givings.old-index');
    })->name('.new');

    Route::get('/{giving}/error', [GivingController::class, 'error'])
        ->name('.error');

    Route::get('/{giving}/success', [GivingController::class, 'success'])
        ->name('.success');

    Route::get('/{giving}/redirect', [GivingController::class, 'redirect'])
        ->name('.redirect');

    Route::get('/{giving}/crypto', [GivingController::class, 'crypto'])
        ->name('.crypto');

    Route::get('/payu/response', [PayUController::class, 'response'])
        ->name('.payu.response');

    Route::post('/payu/confirmation', [PayUController::class, 'confirmation'])
        ->name('.payu.confirmation');

    Route::get('/stripe/response', [StripeController::class, 'response'])
        ->name('.stripe.response');

    Route::post('/stripe/notify', [StripeController::class, 'notify'])
        ->name('.stripe.notify');

    Route::get('/forging-block/return', [ForgingBlockController::class, 'response'])
        ->name('.forging-block.response');

    Route::post('/forging-block/notify', [ForgingBlockController::class, 'notify'])
        ->name('.forging-block.notify');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('giving-types', GivingTypeController::class)->only(['index']);
});

require __DIR__ . '/auth.php';
