<?php

namespace App\Http\Controllers;

use App\Models\ArtSpace;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(ArtSpace $artSpace)
    {
        return view('frontend.product.index', compact('artSpace'));
    }
}
