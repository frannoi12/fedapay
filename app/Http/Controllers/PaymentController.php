<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\FedapayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart');
        }

        return view('checkout');
    }

    public function checkout(Request $request, FedapayService $fedapayService)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'total_amount' => $total,
            'payment_status' => false,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }


        $transaction = $fedapayService->createTransaction($order);

        $order->update([
            'transaction_id' => $transaction->id
        ]);

        session()->forget('cart');

        // dd($transaction);

        return redirect($transaction->payment_url);
    }


    public function success(Request $request)
    {
        return view('payment.success', ['message' => 'Votre paiement a été traité !']);
    }

    public function callback(Request $request)
    {
        // dd($request);
        $transactionId = $request->input('id'); 

        if ($transactionId) {
            $order = Order::firstWhere('transaction_id', $transactionId);

            if ($order) {
                $order->payment_status = true;
                $order->save();

                // return response()->json([
                //     'status' => 'success',
                //     'message' => 'Le statut du paiement a été mis à jour.'
                // ], 200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Commande introuvable pour cette transaction.'
        ], 404);
    }
}
