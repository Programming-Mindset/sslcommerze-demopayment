<?php

use Illuminate\Support\Facades\Route;
use Xenon\SslCommerz\Client;
use Xenon\SslCommerz\Customer;
use Xenon\SslCommerz\IpnNotification;
use App\Http\Controllers\SslCommerzController;



Route::get('/', [SslCommerzController::class, 'index']);
Route::get('/payment', [SslCommerzController::class,'payment'])->name('payment');
Route::post('/success', [SslCommerzController::class, 'success'])->name('success');
Route::post('/fail', [SslCommerzController::class, 'fail'])->name('fail');
Route::post('/cancel', [SslCommerzController::class, 'cancel'])->name('cancel');
Route::post('/ipn', [SslCommerzController::class, 'ipn']);
Route::get('/pay-status', [SslCommerzController::class, 'payStatus'])->name('payment-status');
