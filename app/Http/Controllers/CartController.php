<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->back();
    }
}
