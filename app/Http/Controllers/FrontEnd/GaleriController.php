<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Gallerie;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Gallerie::paginate(6);
        return view('frontend.pages.galeri',compact('galeri'));
    }
}
