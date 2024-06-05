<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;

class PagosController extends Controller
{
    public function realizarPago(Request $request)
    {
        SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $payment = new \MercadoPago\Payment();

        $payment->transaction_amount = $request->input('amount');
        $payment->description = $request->input('description');
        $payment->payment_method_id = $request->input('payment_method_id');
        $payment->payer = array(
            "email" => $request->input('email')
        );
        $payment->save();

        return redirect($payment->sandbox_init_point);
    }
}