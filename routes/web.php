<?php

use Illuminate\Support\Facades\Route;
use Xenon\SslCommerz\Client;
use Xenon\SslCommerz\Customer;
use Xenon\SslCommerz\IpnNotification;

Route::get('/', static function () {
    $customer = new Customer(fake()->email(), fake()->email, '0171xxxxx22');
    $resp = Client::initSession($customer, random_int(1, 10)); //29 is the amount
    return redirect($resp->getGatewayUrl());
});


Route::post('/success', static function () {
    \Illuminate\Support\Facades\Log::info('success', ['success', request()->all()]);
    $resp = Client::verifyOrder(request()->all()['val_id']);
    echo 'status: ' . $resp->getStatus();
    echo 'transaction success transaction: ' . $resp->getTransactionId();
});

Route::post('/fail', static function () {
    \Illuminate\Support\Facades\Log::info("failed", ["failed", request()->all()]);
    \Illuminate\Support\Facades\Log::info("headers", ["headers", request()->headers]);
    echo 'status: failed';
    //dd(request()->all());
});
Route::post('/cancel', static function () {
    \Illuminate\Support\Facades\Log::info("cancel", ['inside cancel']);
    echo 'cancel: cancel';
});

Route::post('/ipn', static function () {
    \Illuminate\Support\Facades\Log::info("ipn", ['inside ipn', request()->all()]);
    \Illuminate\Support\Facades\Log::info("headers", ["headers", request()->headers]);

    if (ipn_hash_varify(config('sslcommerz.store_password')) && isset($_POST['status']) && $_POST['status'] == 'VALID') {

        $ipn = new IpnNotification($_POST);
        $val_id = $ipn->getValId();
        $transaction_id = $ipn->getTransactionId();
        $amount = $ipn->getAmount();
        $resp = Client::verifyOrder($val_id);
        // dd(request()->all(),['inside ipn',$resp]);
    }
});
