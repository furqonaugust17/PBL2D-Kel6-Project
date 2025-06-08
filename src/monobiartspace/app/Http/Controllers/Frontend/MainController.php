<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KegiatanArtSpace;
use App\Models\TemaKid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $datas = DB::select('
            (SELECT id, nama, "artspace" AS jenis FROM art_spaces LIMIT 2)
            UNION ALL
            (SELECT id, nama, "kids" AS jenis FROM kids)
            LIMIT 3
        ');
        return view('landing-page.index', compact('datas'));
    }

    public function getDataClass(String $tipe, String $id)
    {
        if ($tipe == 'artspace') {
            $data = KegiatanArtSpace::where('artspace_id', $id)->get();
        } else {
            $data = TemaKid::with('detailTema')->where('kid_id', $id)->get();
        }

        return response()->json(['success' => true, 'data' => $data]);
    }
}
