<?php

use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('paiement');
});


Route::post('/checkout', [PaiementController::class, 'checkout']);
Route::get('/paiement/callback', [PaiementController::class, 'callback']);

