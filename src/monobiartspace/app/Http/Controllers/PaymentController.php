<?php

namespace App\Http\Controllers;

use App\Models\PembayaranBooking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function callback(Request $request)
    {
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
