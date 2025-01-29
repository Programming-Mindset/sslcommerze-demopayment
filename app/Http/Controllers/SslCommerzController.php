<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Xenon\SslCommerz\Client;
use Xenon\SslCommerz\Customer;
use Xenon\SslCommerz\Exceptions\RenderException;
use Xenon\SslCommerz\IpnNotification;


class SslCommerzController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function payment(Request $request)
    {
        $customer = new Customer(fake()->email(), fake()->email, '01733499574');
        $customer->setCity('Dhaka');
        $customer->setState('Dhaka');
        $customer->getPostCode('1205');
        $customer->setCountry('Bangladesh');

        $resp = Client::initSession($customer, $request->amount); //29 is the amount
        return redirect($resp->getGatewayUrl());
    }

    /**
     * @param Request $request
     * @return void
     * @throws RenderException
     * @throws \JsonException
     */
    public function success(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('success', ['success', request()->all(), request()->ip()]);
        $resp = Client::verifyOrder(request()->all()['val_id']);

        $data = [
            'status' => $resp->get('status'),
            'currency' => $resp->get('currency'),
            'amount' => $resp->get('amount'),
            'store_amount' => $resp->get('store_amount'),
            'tran_id' => $resp->get('tran_id'),
            'tran_date' => $resp->get('tran_date'),
            'card_type' => $resp->get('card_type'),
        ];

        Session::put('response',$data);

        return redirect()->route('payment-status');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function fail(Request $request)
    {
        \Illuminate\Support\Facades\Log::info("failed", ["failed", request()->all()]);
        \Illuminate\Support\Facades\Log::info("headers", ["headers", request()->headers]);

        $resp = [
            'status' => $request->status,
            'currency' => $request->currency_type,
            'amount' => $request->amount,
            'store_amount' => null,
            'tran_id' => $request->tran_id,
            'tran_date' => $request->tran_date,
            'card_type' => $request->card_brand,
        ];


        Session::put('response',$resp);
        return redirect()->route('payment-status');

    }

    /**
     * @param Request $request
     * @return void
     */
    public function cancel(Request $request)
    {
        \Illuminate\Support\Facades\Log::info("cancel", ['inside cancel']);
        echo 'cancel: cancel';
    }

    /**
     * @param Request $request
     * @return array
     * @throws RenderException
     * @throws \JsonException
     */
    public function ipn(Request $request)
    {
        \Illuminate\Support\Facades\Log::info("ipn", ['inside ipn', request()->all()]);
        \Illuminate\Support\Facades\Log::info("headers", ["headers", request()->headers]);

        if (ipn_hash_varify(config('sslcommerz.store_password')) && isset($_POST['status']) && $_POST['status'] == 'VALID') {

            $ipn = new IpnNotification($_POST);
            $val_id = $ipn->getValId();
            $transaction_id = $ipn->getTransactionId();
            $amount = $ipn->getAmount();
            $resp = Client::verifyOrder($val_id);
            \Illuminate\Support\Facades\Log::debug('ipn response', [$resp]);
        }
    }

    public function payStatus()
    {
        $resp = Session::all()['response'];

        $data = [
            'paymentData' => [
                'status' => $resp['status'],
                'currency' => $resp['currency'],
                'amount' => $resp['amount'],
                'store_amount' => $resp['store_amount'],
                'tran_id' => $resp['tran_id'],
                'tran_date' => $resp['tran_date'],
                'card_type' => $resp['card_type'],
            ]
        ];

        return view('payment-status')->with($data);
    }

}
