<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ArtSpace;
use App\Models\KegiatanArtSpace;
use App\Models\Kid;
use App\Models\TemaKid;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $artspaces = ArtSpace::with('kegiatan')->get();
        $kids = Kid::with('temas')->get();
        return view('frontend.kelas.index', compact('artspaces', 'kids'));
    }

    public function detail(String $tipe, String $id)
    {
        if ($tipe == 'artspace') {
            $data = KegiatanArtSpace::find($id);
            return view('frontend.kelas.artspace', compact('data'));
        } else {
            $data = TemaKid::with('detailTema')->find($id);
            return view('frontend.kelas.kid', compact('data'));
        }
    }
}
