<?php

namespace App\Http\Controllers;

use Exception;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
     public function __construct()
    {
        FedaPay::setApiKey(env('FEDAPAY_API_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENVIRONMENT', 'sandbox'));
    }

    public function createTransaction($data)
    {
        return Transaction::create([
                'description'  => 'Order ',
                'amount'       => $data['montant'],
                'currency'     => ['iso' => 'XOF'],
                'callback_url' => url('/paiement/callback'),
                'customer'     => [
                    'firstname' => $data['customer_name'],
                    'email'     => $data['customer_email'],
                ]
            ]);
    }

    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'montant' => 'required|numeric',
        ]);


        try {
            $transaction = $this->createTransaction($validatedData);

            return redirect($transaction->payment_url);

        } catch (Exception $e) {
            return back()->withErrors('Erreur FedaPay: ' . $e->getMessage())->withInput();
        }
    }




    public function callback(Request $request)
    {
        // dd($request);
        $transactionId = $request->input('id'); 
        $statut = $request->input("status");

        if ($transactionId) {
            if ($statut=='approved'){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Paiement effectué avec succès.'
                ]);
            }elseif($statut=="declined" or $statut == "pending"){
                return response()->json([
                    'status' => 'declined | pending',
                    'message' => 'Solde insufisant où en attente.'
                ], 404);
            }elseif($statut=="canceled"){
                return response()->json([
                    'status' => 'canceled',
                    'message' => 'Erreur lors du paiement.'
                ], 404);
            }   
        }
        else{
            return redirect("/");
        }     
    }
}
