<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\SpaProgram;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $spaPrograms = SpaProgram::where('is_active', true)
            ->latest()
            ->get();

        $chunks = $spaPrograms->chunk(
            max(1, ceil($spaPrograms->count() / 2))
        );

        return view('frontend.pages.layanan', [
            'spaPrograms' => $spaPrograms,
            'leftPrograms' => $chunks->get(0) ?? collect(),
            'rightPrograms' => $chunks->get(1) ?? collect(),
        ]);
    }
}
