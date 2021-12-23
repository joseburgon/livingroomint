<?php

use App\Http\Controllers\GivingTypeController;
use App\Http\Controllers\Payment\PayUController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GivingController;

Route::redirect('/', 'donaciones');

Route::get('/email/test/send', function () {
    $giving = \App\Models\Giving::whereNotNull('transaction_id')->latest()->first();

    \Illuminate\Support\Facades\Mail::to(config('givings.notify_email'))->queue(new \App\Mail\NotifyGiving($giving));

    return response('SENT', 200);
});

Route::prefix('donaciones')->name('donaciones')->group(function () {
    Route::get('/', function () {
        return view('givings.index');
    });

    Route::get('/response', function () {
        return view('givings.response');
    })->name('.response');

    Route::get('/{giving}/redirect', [GivingController::class, 'redirect'])
        ->name('.redirect');

    Route::get('/payu/response', [PayUController::class, 'response'])
        ->name('.payu.response');

    Route::post('/payu/confirmation', [PayUController::class, 'confirmation'])
        ->name('.payu.confirmation');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('giving-types', GivingTypeController::class);

require __DIR__ . '/auth.php';
