<?php

use App\Http\Controllers\Payment\PayUController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GivingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'donaciones');

Route::get('/email', function () {
    return view('emails.thanks');
});

Route::prefix('donaciones')->name('donaciones.')->group(function () {
    Route::get('/', function () {
        return view('givings.index');
    });

    Route::get('/response', function () {
        return view('givings.response');
    });

    Route::get('/{giving}/redirect', [GivingController::class, 'redirect'])
        ->name('redirect');

    Route::get('/payu/response', [PayUController::class, 'response'])
        ->name('payu.response');

    Route::post('/payu/confirmation', [PayUController::class, 'confirmation'])
        ->name('payu.confirmation');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
