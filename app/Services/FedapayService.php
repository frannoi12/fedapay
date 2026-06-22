<?php

namespace App\Services;

use FedaPay\FedaPay;
use FedaPay\Transaction;

class FedapayService
{
    public function __construct()
    {
        FedaPay::setApiKey(env('FEDAPAY_API_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENVIRONMENT', 'sandbox'));
    }

    public function createTransaction($order)
    {
        try {
            $transaction = Transaction::create([
                'description'  => 'Order ' . $order->id,
                'amount'       => (int) $order->total_amount,
                'currency'     => ['iso' => 'XOF'],
                'callback_url' => url('/payment/callback'),
                'return_url'   => url('/payment/success'),
                'customer'     => [
                    'firstname' => $order->customer_name,
                    'email'     => $order->customer_email,
                ]
            ]);

            return $transaction;

            // dd($transaction);


        } catch (\Exception $e) {
            dd('Erreur FedaPay: ' . $e->getMessage());
        }
    }
}