<?php

namespace App\Http\Controllers;

use App\Models\ArtSpace;
use App\Models\Kid;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $artspaces = ArtSpace::all();
        $kids = Kid::all();
        return view('landing-page.index', compact('artspaces', 'kids'));
    }
}
