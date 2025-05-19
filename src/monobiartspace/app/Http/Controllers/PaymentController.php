<?php

namespace App\Http\Controllers;

use App\Models\PembayaranBooking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $payment = PembayaranBooking::where('order_id', $order_id);
        $payment->update([
            'status' => $transaction,
            'payment_method' => $type
        ]);

        return response()->json(['message' => 'ok'])->setStatusCode(200);
    }
}
