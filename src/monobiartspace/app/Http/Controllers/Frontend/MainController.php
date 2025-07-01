<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Mail\ContactMessage;
use App\Models\Galeri;
use App\Models\KegiatanArtSpace;
use App\Models\Partner;
use App\Models\TemaKid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $datas = DB::select('
            (SELECT id, nama, "artspace" AS jenis FROM art_spaces WHERE deleted_at IS NULL LIMIT 2)
            UNION ALL
            (SELECT id, nama, "kids" AS jenis FROM kids WHERE deleted_at IS NULL)
            LIMIT 3
        ');
        $galleries = Galeri::all();
        $partners = Partner::all();
        return view('landing-page.index', compact('datas', 'galleries', 'partners'));
    }

    public function getDataClass(String $tipe, String $id)
    {
        if ($tipe == 'artspace') {
            $data = KegiatanArtSpace::with('images')->where('artspace_id', $id)->get();
        } else {
            $data = TemaKid::with(['detailTema', 'images'])->where('kid_id', $id)->get();
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function sendMail(QuestionRequest  $request)
    {
        $data = $request->validated();
        Mail::to(env('MAIL_USERNAME'))->send(new ContactMessage($data));

        return response()->json(['success' => true, 'message' => 'Pesan Anda Telah Dikirim. Terima Kasih!']);
    }
}
