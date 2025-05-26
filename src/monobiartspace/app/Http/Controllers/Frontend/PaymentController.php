<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\PendaftaranArtSpace;
use App\Mail\PendaftaranKids;
use App\Models\PembayaranBooking;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        if (str_contains($order_id, 'kids')) {
            $mailData = PembayaranService::makeMailDataKids($order_id);
            Mail::to($mailData['email'])->send(new PendaftaranKids($mailData));
        } else {
            $mailData = PembayaranService::makeMailDataArtSpace($order_id);
            Mail::to($mailData['email'])->send(new PendaftaranArtSpace($mailData));
        }

        return response()->json(['message' => 'ok'])->setStatusCode(200);
    }
}
