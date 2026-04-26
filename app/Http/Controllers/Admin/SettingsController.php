<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()
            ->map(fn($s) => [
                'key' => $s->key,
                'value' => $s->value
            ]);

        return inertia('Admin/Settings/Index', [
            'settings' => $settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return inertia('Admin/Settings/Edit', [
            'settings' => [
                'pimpinan_nama' => Setting::get('pimpinan_nama'),
                'pimpinan_foto' => Setting::get('pimpinan_foto'),
                'pimpinan_sambutan' => Setting::get('pimpinan_sambutan'),
                'kontak_telepon' => Setting::get('kontak_telepon'),
                'kontak_email' => Setting::get('kontak_email'),
                'kontak_alamat' => Setting::get('kontak_alamat'),
                'sosmed_facebook' => Setting::get('sosmed_facebook'),
                'sosmed_instagram' => Setting::get('sosmed_instagram'),
                'sosmed_youtube' => Setting::get('sosmed_youtube'),
                'sosmed_tiktok' => Setting::get('sosmed_tiktok'),
                'jam_kerja_senin_kamis' => Setting::get('jam_kerja_senin_kamis'),
                'jam_kerja_jumat' => Setting::get('jam_kerja_jumat'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pimpinan_nama' => 'required|string|max:255',
            'pimpinan_sambutan' => 'nullable|string',
            'pimpinan_foto' => 'nullable|image|max:2048',
            'remove_foto' => 'nullable|boolean',
        ]);

        /* =========================
        FOTO
        ========================= */
        $oldFoto = Setting::get('pimpinan_foto');

        if ($request->remove_foto) {
            if ($oldFoto && Storage::disk('public')->exists($oldFoto)) {
                Storage::disk('public')->delete($oldFoto);
            }

            Setting::set('pimpinan_foto', null);
        }

        if ($request->hasFile('pimpinan_foto')) {

            if ($oldFoto && Storage::disk('public')->exists($oldFoto)) {
                Storage::disk('public')->delete($oldFoto);
            }

            $path = $request->file('pimpinan_foto')->store('pimpinan', 'public');

            Setting::set('pimpinan_foto', $path);
        }

        /* =========================
        SAVE SEMUA SETTING
        ========================= */
        Setting::set('pimpinan_nama', $request->pimpinan_nama);
        Setting::set('pimpinan_sambutan', $request->pimpinan_sambutan);

        Setting::set('kontak_telepon', $request->kontak_telepon);
        Setting::set('kontak_email', $request->kontak_email);
        Setting::set('kontak_alamat', $request->kontak_alamat);

        Setting::set('sosmed_facebook', $request->sosmed_facebook);
        Setting::set('sosmed_instagram', $request->sosmed_instagram);
        Setting::set('sosmed_youtube', $request->sosmed_youtube);
        Setting::set('sosmed_tiktok', $request->sosmed_tiktok);

        Setting::set('jam_kerja_senin_kamis', $request->jam_kerja_senin_kamis);
        Setting::set('jam_kerja_jumat', $request->jam_kerja_jumat);

        return redirect()->back()->with('success', 'Settings berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
