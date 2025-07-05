<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\PendaftaranArtSpace;
use App\Mail\PendaftaranKids;
use App\Models\PembayaranBooking;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $payment = PembayaranBooking::with('pendaftaran')->where('order_id', $order_id)->first();
        $pendaftaran = $payment->pendaftaran;
        $pendaftaran->status = 'menunggu kedatangan';
        $pendaftaran->save();
        $payment->update([
            'status' => $transaction,
            'payment_method' => $type
        ]);

        if ($transaction === 'settlement') {
            if (str_contains($order_id, 'kids')) {
                $mailData = PembayaranService::getDataPembayaranKids($order_id);
                Mail::to($mailData['email'])->send(new PendaftaranKids($mailData));
            } else {
                $mailData = PembayaranService::getDataPembayaranArtSpace($order_id);
                Mail::to($mailData['email'])->send(new PendaftaranArtSpace($mailData));
            }
            $payment->update(['payment_date' => now()]);
        }

        return response()->json(['message' => 'ok'])->setStatusCode(200);
    }

    public function status(Request $request)
    {
        $payment = PembayaranBooking::with('pendaftaran')->where('order_id', $request->order_id)->whereHas('pendaftaran', function ($query) {
            $query->where('customer_id', Auth::user()->customer->id);
        })->firstOrFail();
        $type = $payment->pendaftaran->type == 'artspace';
        if ($type) {
            $data = PembayaranService::getDataPembayaranArtSpace($request->order_id);
        } else {
            $data = PembayaranService::getDataPembayaranKids($request->order_id);
        }
        return view('frontend.booking.status', compact('data', 'type'));
    }
}
