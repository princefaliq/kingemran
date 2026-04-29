<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\SpaProgram;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        $programs = SpaProgram::where('is_active', true)
            ->orderBy('nama_paket')
            ->get();

        return view('frontend.pages.testimoni.create', compact('programs'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'spa_program_id' => 'nullable|exists:spa_programs,id',
            'content' => 'required|string',
        ]);

        Testimonial::create([
            'name' => $validated['name'],
            'spa_program_id' => $validated['spa_program_id'] ?? null,
            'content' => $validated['content'],
            'is_active' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Testimoni berhasil dikirim dan akan ditinjau terlebih dahulu.');
    }
}
