<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaProgram;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpaProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SpaProgram::query();

        // 🔍 SEARCH (nama paket)
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }

        // 🔃 SORT
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['id', 'nama_paket', 'harga', 'created_at'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $query->orderBy($sort, $direction);

        // 📄 PAGINATION
        $spaPrograms = $query->paginate(10)->withQueryString();

        // 🎯 kirim ke inertia
        return Inertia::render('Admin/SpaPrograms/Index', [
            'spaPrograms' => $spaPrograms,
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/SpaPrograms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('spa', 'public');
        }

        SpaProgram::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambar,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()
            ->route('admin.spa-programs.index')
            ->with('success', 'Program SPA berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpaProgram $spaProgram)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpaProgram $spaProgram)
    {
        return Inertia::render('Admin/SpaPrograms/Edit', [
            'spaProgram' => $spaProgram
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpaProgram $spaProgram)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('gambar')) {

            if ($spaProgram->gambar && \Storage::disk('public')->exists($spaProgram->gambar)) {
                \Storage::disk('public')->delete($spaProgram->gambar);
            }

            $spaProgram->gambar = $request->file('gambar')->store('spa', 'public');
        }

        $spaProgram->update([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()
            ->route('admin.spa-programs.index')
            ->with('success', 'Program SPA berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpaProgram $spaProgram)
    {
        // hapus gambar jika ada
        if ($spaProgram->gambar && \Storage::disk('public')->exists($spaProgram->gambar)) {
            \Storage::disk('public')->delete($spaProgram->gambar);
        }

        // hapus data
        $spaProgram->delete();

        return redirect()
            ->route('admin.spa-programs.index')
            ->with('success', 'Program SPA berhasil dihapus');
    }
}
